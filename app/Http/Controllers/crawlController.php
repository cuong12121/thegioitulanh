<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Models\product;

use Illuminate\Support\Facades\Cache;

use App\Models\deal;

use App\Models\banners;

use App\Models\post;

use  App\Models\image;

use App\Models\metaSeo;

use App\Models\groupProduct;

use App\Models\filter;
use DB;
use App\products1;

use \Carbon\Carbon;


class crawlController extends Controller
{
    public function addNames()
    {
        $product = product::where('id_group_product', NULL)->get()->pluck('id')->toArray();

        foreach ($product as $key => $value) {

            $products = product::find($value);

            if(!empty($products)){

                $name =  $products->Name;
                

                if(!empty($products->ProductSku)){
                    $cut    =  strstr($name, $products->ProductSku);
                    $names = str_replace($cut, '', $name);

                    if(!empty($names)){

                        $products->Names = $names;
                        $products->save();

                    }
                }
            }
        }
        echo "thanh cong";

    }
    public function sosanh()
    {

        $ids = [13,16,12,14,15,41,36,40,287,37,38,39,57,58,59,60,61,77,82,80,79,84,78,83,81,117,116,324,130];
        
        foreach ($ids as  $id) {
            
            $groupProduct =  groupProduct::find($id);

            $product = json_decode($groupProduct->product_id);

            
            foreach ($product as $value) {

                if( intval($value)>425){
                    $products = product::find($value);

                    if(!empty($products)){
                        $products->id_group_product = $id;
                        $products->save();

                    }
                   
                }
            
            }
        }
       
        echo "thanh cong";
    }

    public function strip_tags_content($string) { 
        // ----- remove HTML TAGs ----- 
        $string = preg_replace ('/<[^>]*>/', ' ', $string); 
        // ----- remove control characters ----- 
        $string = str_replace("\r", '', $string);
        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\t", ' ', $string);
        // ----- remove multiple spaces ----- 
        $string = trim(preg_replace('/ {2,}/', ' ', $string));
        return $string; 

    }

   
    public function checkProductSku()
    {
        $data  = product::find(2226);

        $data_id = 4;

        $html = $data->Specifications;

        $dom = new \DOMDocument();

        $html = mb_convert_encoding($html , 'HTML-ENTITIES', 'UTF-8'); //convert sang tiếng việt cho dom

        $dom->loadHTML($html);

        $ar_gr[1] = ['Kích cỡ màn hình', 'Độ phân giải', 'Nơi sản xuất', 'Cổng HDMI', 'Công nghệ xử lý hình ảnh', 'Kích thước có chân, đặt bàn', 'Kích thước không chân, treo tường'];
        $ar_gr[2] = ['Khối lượng giặt', 'Khối lượng sấy', 'Tốc độ quay vắt', 'Kiểu động cơ', 'Lồng giặt', 'Công nghệ giặt', 'Kích thước - Khối lượng', 'Nơi sản xuất'];
        $ar_gr[3] = ['Dung tích sử dụng', 'Dung tích ngăn đá', 'Dung tích ngăn lạnh', 'Công nghệ Inverter', 'Kiểu tủ', 'Kích thước - Khối lượng', 'Nơi sản xuất'];
        $ar_gr[4] = ['Loại máy', 'Công suất làm lạnh', 'Công suất sưởi ấm', 'Phạm vi làm lạnh hiệu quả', 'Chế độ tiết kiệm điện', 'Loại Gas sử dụng', 'Nơi sản xuất', 'Năm ra mắt'];

        $ar = $ar_gr[$data_id];



        foreach($dom->getElementsByTagName('td') as $td) {

            foreach ($ar as $key => $value) {

                if(strpos($td->nodeValue, $value)>-1){
                    print_r($td->nodeValue . '<br/>');
                }
            }
           
        }


        // $dom = new \DOMDocument();
        // $dom->loadHtml($html);
        // $x = new \DOMXpath($dom);
        // foreach($x->query('//td') as $td){
        //     echo strip_tags($td->textContent).'<br>';
        //     //if just need the text use:
        //     //echo $td->textContent;
        // }

    }

    public function editKeywordsProduct()
    {
        $Group_products = groupProduct::find(1);

        $id_product =  json_decode($Group_products->product_id);


        foreach ($id_product as $key => $value) {

            $product = product::find($value);

            // tìm chuỗi từ vị trí inch để xóa 

            if(!empty($product->Name)){

                $name = preg_replace('/[0-9]{1,4} inch /', 'remove ', $product->Name);

                $name = str_replace(strstr($name, 'remove'), '', $name);
              
                DB::table('checkname')->insert(['name'=> $product->Name, 'model'=>$product->ProductSku, 'name1'=>$name, 'id_product'=>$value]);

            }
            
        }

      
        echo 'thanh cong';
      
    }
    public function editMetaSeoDB()
    {
        $product = product::select('Meta_id', 'Name', 'Price', 'id')->get();

        // foreach ($product as $key => $value) {

        //     $metaseo =  metaSeo::find($value->Meta_id);

        //     $metaseo->title = $value->Name.
           
        // }

        foreach ($product as $key => $value) {

            $product = product::find($value->id);

            $metaseo =  metaSeo::find($product->Meta_id);

            if(!isset($product->Price)){
                dd($value->id);
                
            }

            $Price = $product->Price;



            //check id trong gia dụng 

            $groupProduct = groupProduct::find(8);

            $giadung = json_decode($groupProduct->product_id);

            $tragop = '';

            if($Price>=3000000 && !in_array($product->id, $giadung)){

                $tragop = ', Trả góp 0%';

            }

            $metaseo->meta_title = $product->Name.' giá rẻ'.$tragop;

            $metaseo->save();

            echo "<pre>";

            echo $value->id;

            echo "</pre>";

        }

        echo'thành công';

    }
    public function deleteCache()
    {
        Cache::flush();
        echo "thanh cong";
    }
    
    public function echo1(){
         $value = Cache::get('cron');

         print_r($value);
       
    }

    public function echo(){
         $banners = banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();

        $deal = deal::OrderBy('order', 'desc')->get();

        $product_sale = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->get();

        $groups = groupProduct::select('id','name', 'link')->where('parent_id', 0)->get();

        $deal_start = $deal->first()->start;

        cache::put('deal_start', $deal_start,10000);

    
        Cache::put('groups', $groups,10000);

        Cache::put('product_sale', $product_sale,10000);
        
        Cache::put('baners',$banners,10000);

        Cache::put('deals',$deal,10000);

       
    }
    public function updateProductQua()
    {
      $code = 'NF-N15SRA
        NF-N30ASRA
        NF-N50ASRA
        SD-P104WRA
        MK-5076MWRA
        MK-K51PKRA
        MX-AC400WRA
        MJ-DJ31SRA
        MJ-M176PWRA
        MJ-L500SRA
        MJ-DJ01SRA
        MJ-SJ01WRA
        MJ-H100WRA
        MJ-68MWRA
        MX-SS1BRA
        MX-GS1WRA
        MX-V310KRA
        MX-V300KRA
        MX-900MWRA
        MX-GX1561WRA
        MX-GX1511WRA
        MX-EX1511WRA
        MX-EX1561WRA
        MX-MG5351WRA 
        MX-MP5151WRA 
        MX-MG53C1CRA 
        MX-M300SRA
        MX-M210SRA
        MX-M200WRA
        MX-M200GRA
        MX-M100WRA
        MX-M100GRA
        NC-HU301PZSY
        NC-BG3000CSY
        NC-EG4000CSY
        NC-EG3000CSY
        NC-EG2200CSY
        NC-HKD121WRA
        NC-SK1BRA
        NC-GK1WRA
        MK-GB3WRA
        MK-GH3WRA
        NB-H3801KRA
        NB-H3203KRA
        NT-H900KRA
        SR-PX184KRA
        SR-HB184KRA
        SR-AFM181WRA
        SR-AFY181WRA
        SR-CX188SRA
        SR-CP188NRA
        SR-CP108NRA
        SR-CL188WRA
        SR-CL108WRA
        SR-MVN187HRA
        SR-MVN187LRA
        SR-MVN107HRA
        SR-MVN107LRA
        SR-MVP187HRA
        SR-MVP187NRA
        SR-MVQ187SRA
        SR-MVQ187VRA
        NU-SC100WYUE
        NU-SC180BYUE
        NN-DS596BYUE
        NN-CT655MYUE
        NN-CT36HBYUE
        NN-GT65JBYUE
        NN-GD37HBYUE
        NN-GF574MYUE
        NN-GT35HMYUE
        NN-GM34JMYUE
        NN-GM24JBYUE
        NN-ST65JBYUE
        NN-ST34HMYUE
        NN-SM33HMYUE
        NN-ST25JWYUE
        MC-CG370GN46
        MC-CG371AN46
        MC-CG373RN46
        MC-CG525RN49
        MC-CJ911RN49
        MC-CL305BN46
        MC-CL431AN46
        MC-CL561AN46
        MC-CL563RN46
        MC-CL565KN46
        MC-CL777HN49
        MC-CL779RN49
        MC-SB30JW049
        MC-CL789RN49
        MC-CL787TN49
        MC-CL575KN49
        MC-CL573AN49
        MC-CL571GN49
        MC-YL631RN46
        MC-YL669GN49
        MC-YL635TN46
        MC-YL637SN49
        AMC-CT1
        NI-GSE050ARA
        NI-GWE080WRA
        NI-GSD071PRA
        NI-GSD051GRA
        NI-WT980RRA
        NI-L700SSGRA
        NI-WL30VRA
        NI-U600CARA
        NI-U400CPRA
        NI-W650CSLRA
        NI-W410TSRRA
        NI-E510TDRA
        NI-E410TMRA
        NI-M300TARA
        NI-M300TVRA
        NI-M250TPRA
        NI-317TVRA
        NI-317TXRA
        EH-NA98RP645
        EH-NA98-K645
        EH-NA65-K645
        EH-NA45RP645
        EH-NA27PN645
        EH-NE81-K645
        EH-NE71-P645
        EH-NE65-K645
        EH-NE20-K645
        EH-ND57-P645
        EH-ND57-H645
        EH-ND64-P645
        EH-NE11-V645
        EH-ND30-K645
        EH-ND30-P645
        EH-ND21-P645
        EH-ND13-V645
        EH-ND12-P645
        EH-ND11-W645
        EH-ND11-A645
        EH-HE10VP421';

        $model = explode(PHP_EOL, $code);
        $now   = Carbon::now();
       
        foreach ($model as $key => $value) {
             $product = DB::table('products')->where('ProductSku', trim($value));

             if(!empty($product)){
                $product->update(['active'=>1, 'updated_at'=>$now]);

             }
             else{
                print_r($value);
             }
        }
        echo "thanh cong";

    }

    public function updateQuatityByTable()
    {
        $data = DB::table('qualtity1')->get();
        foreach ($data as $key => $value) {

            $product = product::find($value->product_id);

            $product->Quantily = $value->qty;

            $product->save();
           

        }
        echo "thanh cong";
    }

    public function updateQuatity()
    {
        $data = DB::table('qualtity')->get();
        foreach ($data as $key => $value) {

           $product = product::where('ProductSku', trim($value->name))->first();

            if(!empty($product)){
                $updateProduct = product::find($product->id);
                $updateProduct->Quantily = $value->qty;
                $updateProduct->save();
                DB::table('qualtity1')->insert(['name'=>$value->name, 'qty'=>$value->qty, 'product_id'=>$product->id]);

            }

        }
        echo "thanh cong";
    }
    public function getMetaNUll()
    {
        $meta = metaSeo::where('meta_title', 'like', '%Nội dung không tồn tại%')->get();
        foreach ( $meta as $key => $value) {
             $post = post::where('Meta_id', $value->id)->first();
             if(!empty($post)&&!empty($post->link)){
                $pp = post::find($post->id);
                $ppl=$pp->link;
                $urls = 'https://dienmaynguoiviet.vn/'.$ppl;
                $file_headers = @get_headers($urls);
                if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found'){

                    echo '<pre>';
                    print_r($urls);
                }
                else{

                    $html = file_get_html(trim($urls));


                    $keyword = htmlspecialchars($html->find("meta[name=keywords]",0)->getAttribute('content'));
                    $content = $html->find("meta[name=description]",0) ->getAttribute('content');
                    $title   = $html-> find("title",0)-> plaintext;
                
                    $metas   =  metaSeo::find($value['id']);

                    
                    $metas->meta_title =$title; 
                    $metas->meta_content =$content; 
                    $metas->meta_key_words = strip_tags($keyword); 
                    $metas->meta_og_title =$title; 
                    $metas->meta_og_content =$content; 

                    $metas->save();


                }
             }
        }
        echo "thanh cong";
       

    }
    public function CrawlNameMeta()
    {
        $post = post::select('id', 'Meta_id', 'link')->get();

        foreach ($post as $key => $value) {
            $urls = 'http://dienmaynguoiviet.com/'.$value->link.'/';
            $file_headers =@get_headers($urls);

            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found'){

                echo '<pre>';
                print_r($urls);
            }
            else{
                $html = file_get_html(trim($urls));
                $keyword = htmlspecialchars($html->find("meta[name=keywords]",0)->getAttribute('content'));
                $content = $html->find("meta[name=description]",0) ->getAttribute('content');
                $title   = $html-> find("title",0)-> plaintext;
            
                $meta   =  metaSeo::find($value->Meta_id);

                $meta->meta_title =$title; 
                $meta->meta_content =$content; 
                $meta->meta_key_words = strip_tags($keyword); 
                $meta->meta_og_title =$title; 
                $meta->meta_og_content =$content; 

                $meta->save();
            }
        
            
        }

       
    }
    public function allproduct(){
        $link = $_GET['link'];

        $sp  = groupProduct::where('link', trim($link))->first();
        if(!empty($sp)){
            $sps = groupProduct::find($sp->id);

            $product = json_decode($sps->product_id);


            $link = [];

            if(!empty($product)){
                foreach ($product as $key => $value) {
                    $products = product::find($value);

                    $links = $products->Link??'';
                    if($links !=''){
                         array_push($link, 'https://dienmaynguoiviet.vn/'.$links);
                    }
                   
                }
            }

            foreach ($link as  $values) {
                echo $values.'<br>';
            }
        }
        else{
            echo "không tìm thấy nhóm sản phẩm này";
        }

    }
    public function checkempty()
    {
        $code = product::select('ProductSku', 'Detail')->get();

        foreach ($code as $key => $value) {
            
            if(empty($value->Detail)){
                echo "<pre>";
                print_r($value->ProductSku);
            }
        }
    }
    public function changeQualtity()
    {
        $data = DB::table('qualtity')->select('name', 'qty')->get();

        foreach ($data as $key => $value) {
          
            $product = product::where('ProductSku', trim($value->name))->select('id')->first();

            if(!empty($product)){
                $productId = product::find($product->id);
                $productId->Quantily = $value->qty;
                $productId->save();
                DB::table('product_update1')->insert(['product_id'=>$product->id, 'qty'=>$value->qty]);
            }  

        }
        echo "thanh cong";
    }
   public function emptyContent()
   {
        $products = product::select('id', 'Link')->OrderBy('id', 'asc')->where('Detail', '')->get();

        foreach ($products as $key => $value) {
             print_r($value->Link.'     ');
        }

   }

   public function randomOrderDeal()
   {
        $deal = deal::get();

        if($deal->count()>0){
            foreach ($deal as $key => $value) {
          
                $deals = deal::find($value->id);

                $deals->order = mt_rand(1, 10000);

                $deals->save();

           }
        }

       
       echo "thanh cong";
   }
    public function findimage()
    {
        $image = DB::table('imagecrawl')->select('image', 'id', 'active')->where('image', 'like', '%/media/%')->get();

        foreach ($image as $key => $value) {

            print_r($value);

            // if(strpos($value->image,'https://dienmaynguoiviet.vn/')===false){


            //     $images  = 'https://dienmaynguoiviet.vn'.$value->image;
            //     $img  = str_replace('https://dienmaynguoiviet.vn/media', '/media', $images);
            //     DB::table('imagecrawl')->where('id', $value->id)->update(['active' => 1]);

            //     file_put_contents(public_path().$img, file_get_contents(trim($images)));
            // }
            
        }

    }
    public function runCrawl()
    {
        $image = DB::table('imagecrawl')->select('image', 'id', 'active')->where('active', 0)->get();

        foreach ($image as $key => $value) {
            $pos = strpos($value->image, "/media/product/");

            if($pos != false){

               
                $file_headers = @get_headers($value->image);
                if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found'){

                   
                    print_r($value->image.' ');
                }
                else{
                         
                     DB::table('imagecrawl')->where('id', $value->id)->update(['active' => 1]);

                    DB::table('imagerun')->insert(['image'=>$value->image]);

                    $img  = str_replace('https://dienmaynguoiviet.vn/media', '/media', $value->image);

                    file_put_contents(public_path().$img, file_get_contents(trim($value->image)));

                    
                }

                
            }    

        }
        echo "thanh cong";

    }
    public function getAllimageContent()
    {

    
        $products = product::select('id')->OrderBy('id', 'asc')->get();

        foreach ($products as $key => $value) {

            $product = product::find($value->id);
            if($product->id<4176){

                if(!empty($product->Detail)){

                    preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $product->Detail, $matches);
                
                    if(isset($matches[1])){
                        foreach ($matches[1] as $key => $images) {

                             DB::table('imagecrawl')->insert(['image'=>$images]);
        
                            // $pos = strpos($images, "/media/lib/");

                            // if($pos != false){
                               
                            //     $img  = str_replace('https://dienmaynguoiviet.vn/media', '/media', $images);
                            //     file_put_contents(public_path().$img, file_get_contents(trim($images)));

                            //     DB::table('imagerun')->insert(['image'=>$images]);
                            // }

                            // $file_headers = @get_headers($images);

                            // if(is_array($file_headers)){

                            //     if(array_key_exists(0, $file_headers) && $file_headers[0] == 'HTTP/1.1 200 OK'){
                            //         $img  = str_replace('https://dienmaynguoiviet.vn/media', '/media', $images);

                            //         file_put_contents(public_path().$img, file_get_contents($images));
                            //     }
                               

                            // }

                           
                        }

                    }    

                }
            }

            
        } 

        echo "thanh cong";   

    }
    public function checkContennull($value='')
    {
         $products = product::select('id')->OrderBy('id', 'asc')->get();

        foreach ($products as $key => $value) {
            $product = product::find($value->id);

            if(empty($product->Detail)){

                $url = 'https://dienmaynguoiviet.vn/'.trim($product->Link).'/';

                $html = file_get_html(trim($url));
                $content  = html_entity_decode($html->find('.emty-content',0));

                if(!empty($content)){
                    $product->Detail = $content;

                    $product->save();
                }
                else{
                    print_r($url.'<br>');
                }
                
            }
            
        }  
        echo "thanh cong";  
    }





    public function removedot()
    {
        
        $products = product::select('id')->OrderBy('id', 'asc')->get();

        foreach ($products as $key => $value) {
            $product = product::find($value->id);
            $product->Detail = str_replace('..https://dienmaynguoiviet.vn/media/', 'https://dienmaynguoiviet.vn/media/', $product->Detail);
            $product->save();
        }    
        echo "thanh cong";

    }
    public function crawlProductEdit()
    {

        $products = product::select('id')->OrderBy('id', 'asc')->get();
        foreach ($products as $key => $value) {

            $product = product::find($value->id);

            if(!empty($product->Link)){
                 $url = 'https://dienmaynguoiviet.vn/'.$product->Link.'/';

                $html = file_get_html(trim($url));
               
                $content  = html_entity_decode($html->find('.emty-content .Description',0));

                $contents = str_replace('https://dienmaynguoiviet.vn/media', '/media', $content);

                $contents = str_replace('/media', 'https://dienmaynguoiviet.vn/media', $content);

                $product->Detail = $contents;

                $product->save();

            }
            else{
                print_r($value->id.' ');
            }

            if($value->id>4175){
                break;
            }    
             
        } 
   
        echo "thanh cong";
           
    }
    public function removeSpaceProductsku()
    {
        $product = product::select('ProductSku', 'id')->get();
        foreach ($product as $key => $value) {
            $products = product::find($value->id);
            $products->ProductSku =  trim($products->ProductSku);

            $products->save();
            
        }
        echo "thanh cong";

    }



   
    public function checkbtu()
    {
        $name = "Điều hòa Mitsubishi MSZ-HL25VA 2 chiều 9000BTU Inverter Gas R410A";

        $strpos = strpos($name, 'BTU');

        print_r($name[$strpos]);
    }


    public function checkss()
    {
            $name = "Điều hòa Mitsubishi MSZ-HL25VA 2 chiều 9000BTU Inverter Gas R410A";

            $strpos = strpos($name, 'BTU');

            print_r($name[$strpos]);


    }

    public function checkPD()
    {
       
        $product = groupProduct::find(4)->product_id;

        $product = json_decode($product);

        $arFalse = [];

        foreach ($product as $key => $value) {

            $name_product = product::find($value)->Name;

            $pos = strpos(strtolower($name_product), 'inverter');

            if ($pos == true) {

                if(strpos(strtolower($name_product), 'invert')==true) {

                    array_push($arFalse, $value);

                }
                
            }
           
        }

        $group = groupProduct::find(88);

        $group->product_id = json_encode($arFalse);

        $group->save();

        echo "thanh cong";

    }
    public function getFileAr()
    {
        $ar_image = $this->getImageFalse();
        $ar_false = [];
        foreach ($ar_image as $key => $value) {

            $images = 'https://dienmaynguoiviet.vn/media/news/'.basename($value);
            $file_headers = @get_headers($images);

            if($file_headers[0] == 'HTTP/1.1 200 OK'){
                $images = 'https://dienmaynguoiviet.vn/media/news/'.basename($value);
            }  
            else{

                $images = 'https://dienmaynguoiviet.vn/media/lib/'.basename($value);
                $file_headers = @get_headers($images);
                if($file_headers[0]== 'HTTP/1.1 200 OK'){
                    $images = $images;
                }
                else{
                    $images = 'https://dienmaynguoiviet.vn/media/product/'.basename($value);
                    $file_headers = @get_headers($images);
                    if($file_headers[0]== 'HTTP/1.1 200 OK'){
                        $images = $images;
                    }
                    else{
                        $images = '';
                        array_push($ar_false, $value);
                    }
                }
                
            } 
            if(!empty($images)) {
                $img  = '/images/posts/crawl/'.basename($images);
                file_put_contents(public_path().$img, file_get_contents($images));    
            }
            

           
        }
        print_r($ar_false);
        echo "thanh cong";
    
    }
    public function getImageFalse()
    {
        $post = post::select('content', 'id', 'category')->get();
        $ar_image_false = [];

        foreach($post as $val){
            if($val->category!=5){
                preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $val->content, $matches);
                if(isset($matches[1])){
                    foreach($matches[1] as $value){
                        if($value!=null){
                           
                                $value = 'http://localhost/pj5/'.$value;

                                $file_headers = @get_headers($value);

                                try {

                                   if(is_array($file_headers) && $file_headers[0] != 'HTTP/1.1 200 OK'){

                                        $images = 'https://dienmaynguoiviet.vn/media/product/'.basename($value);

                                        array_push($ar_image_false, $value);
                                        
                                   } 
                                    
                                } catch (Exception $e) {
                                    echo "Message: " . $e->getMessage();
                                }
                           
                           
                        }        
                    } 
                        
                }    
            }    

        }
        return(array_unique($ar_image_false));
        
    }

     public function getImageAll()
    {
       
        $post = post::select('content', 'id', 'category')->get();

        foreach($post as $val){

            if($val->category!=5){
                preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $val->content, $matches);
            
                if(isset($matches[1])){

                    foreach($matches[1] as $value){

                        if($value !=null){

                            $images = 'https://dienmaynguoiviet.vn/media/news/'.basename($value);

                            $file_headers = @get_headers($images);

                            if($file_headers[0] == 'HTTP/1.1 200 OK'){

                                $images = 'https://dienmaynguoiviet.vn/media/news/'.basename($value);

                            }  
                            else{
                                $images = 'https://dienmaynguoiviet.vn/media/lib/'.basename($value);
                            } 
                            $img  = '/images/posts/crawl/'.basename($images);

                            file_put_contents(public_path().$img, file_get_contents($images));  

                           
                        }    
                    }
                }
            }

        
        }
        echo "thanh cong";
       
    }
    public function crawlImageAgain()
    {
        $post = post::select('link', 'id')->orderBy('date_post','desc')->take(120)->get();
        $i =0;
        foreach($post as $val){
            $i++;
            if($i>81 && $i<91){
                $links = 'https://dienmaynguoiviet.vn/'.$val->link.'/';
                $html = file_get_html(trim($links));
                $imagess = strip_tags($html->find('#image-page', 0));
                $images = 'https://dienmaynguoiviet.vn'.$imagess;

                $img  = '/uploads/posts/crawl/'.basename($images);
                file_put_contents(public_path().$img, file_get_contents($images));
                $linkss = post::find($val->id);
                $linkss->image = $img;

                $linkss->save();
            }

        }
        echo "thanh cong";

    }
    public function getDatePost()
    {
        $post_link = post::select('link', 'category', 'id')->get();
        foreach($post_link as $value){
            if($value->category!=5){
                $link = 'https://dienmaynguoiviet.vn/'.$value->link.'/';

                $html = file_get_html(trim($link));
                $time = strip_tags($html->find('.detail-head time', 0));
                $post = post::find($value->id);
                $post->date_post = Carbon::parse($time);
                $post->save();

            }
            

        }
        echo "thanh cong";

    }


    public function filterTech()
    {
        $maygiat = groupProduct::find(2)->product_id;
        $info = product::select('Specifications', 'id')->whereIn('id', json_decode($maygiat))->get();
       
        $longdung = [];
        foreach($info as $val){
            $pos = strpos(strtolower($val->Specifications), 'lồng đứng');
            if($pos === false){
                array_push($longdung, $val->id);
            }

        }

        $filter = filter::find(17);

         if(!empty($filter->value)){

            $ar_kqs = json_decode($filter->value, true);

        }
        else{
            $ar_kqs = [];
        }
        $ar_kqs[30] =  $longdung;

        $filter->value = json_encode($ar_kqs);

        $filter->save();
        echo "thanh cong";



    }

    public function filterPrice()
    {
        $maygiat = groupProduct::find(2)->product_id;

        // $price   = product::select('id')->whereIn('id', json_decode($maygiat))->whereBetween('Price', [12000000, 15000000])->get()->pluck('id')->toArray();
        $price   = product::select('id')->whereIn('id', json_decode($maygiat))->where('Price', '>', 15000000)->get()->pluck('id')->toArray();

        $filter = filter::find(16);

        if(!empty($filter->value)){

            $ar_kqs = json_decode($filter->value, true);

        }
        else{
            $ar_kqs = [];
        }
        $ar_kqs[27] =  $price;

        $filter->value = json_encode($ar_kqs);

        $filter->save();
        echo "thanh cong";




    }
    public function addFilterProduct(Request $request)
    {

        $link =  $request->link;
        $property   = $request->property;

        $ar   = $request->ar;


         
        $search = $link;

        $query  = product::where('Link', 'like','%'.$search.'%')->get();

        $ar_kq = [];

        foreach ($query as $key => $value) {
          
            array_push($ar_kq, $value->id);
        }

        $filter = filter::find($property);

         
        if(!empty($filter->value)){

            $ar_kqs = json_decode($filter->value, true);

        }
        else{
            $ar_kqs = [];
        }
        $ar_kqs[$ar] = $ar_kq;


        $filter->value = json_encode($ar_kqs);

        $filter->save();
        echo "thanh cong";

    }

    public function getMetaToFails()
    {
        $link = metaSeo::where('meta_content', 'Đường link cần xem không có trên website hoặc đã bị xóa')->get();

        foreach ($link as $key => $value) {


            $product = product::where('Meta_id', $value->id)->first();


            if(!empty($product)){


                $url = $product->Link;

                $urls = 'https://dienmaynguoiviet.vn/'.$url.'/';

        
                $html = file_get_html(trim($urls));

                $keyword = htmlspecialchars($html->find("meta[name=keywords]",0)->getAttribute('content'));
                $content = $html->find("meta[name=description]",0) ->getAttribute('content');
                $title   = $html-> find("title",0)-> plaintext;
            
                $meta   =  metaSeo::find($value->id);

                $meta->meta_title =$title; 
                $meta->meta_content =$content; 
                $meta->meta_key_words = strip_tags($keyword); 
                $meta->meta_og_title =$title; 
                $meta->meta_og_content =$content; 

                $meta->save();

            }


        }   
        echo "thanh cong";

       
    }


    public function addMEtaserForG(){
        for($i= 1; $i<2; $i++){

            $meta = new metaSeo();

            $meta->meta_content = '';

            $meta->meta_title = '';
            $meta->meta_key_words = '';
            $meta->meta_og_title = '';
            $meta->meta_og_content = '';

            $meta->save();

        }
        echo "thanh cong";

    }

    public function checklinkss()
    {
      
        $post = image::select('image','product_id')->get();

        foreach ($post as $key => $images) {
            $file_headers = @get_headers('http://localhost/'.$images->images);

            if($file_headers[0] != 'HTTP/1.1 200 OK'){

                $product = product::find($images->product_id);

                $products = $product->Link;

                print_r($products);

            }
        }   

    }

    public function addMetaSeoForGroup()
    {
        $groupProduct = groupProduct::select('id')->get();

        $i = 5688;

        foreach ($groupProduct as $key => $value) {

           
            $group = groupProduct::find($value->id);
            $group->Meta_id = $i;
            $group->save();
            $i++;


        }

        echo "thanh cong";
    }

    public function fill_name(){

        $ar_info[1] ='tivi';
        $ar_info[2] ='may-giat';
        $ar_info[3] ='tu-lanh';
        $ar_info[4] ='dieu-hoa';
        $ar_info[6] ='tu-dong';
        $ar_info[7] ='tu-mat';
       
        $ar_info[9] ='may-loc-nuoc';

        $ar_info[71] ='may-say';

    
        foreach ($ar_info as $key => $value) {


            $productname = product::select('id')->whereBetween('id', [3995, 4171])->where('Link', 'like', '%'.$value.'%')->get()->pluck('id')->toArray();

            $groupProduct = groupProduct::find($key);

            $groupProduct->product_id = json_encode($productname);

            $groupProduct->save();

        }
      

        echo "thanh cong";


       
       
    
        foreach ($ar_info as $key => $value) {


            $productname = product::select('id')->where('Link', 'like', '%'.$value.'%')->get()->pluck('id')->toArray();

            $groupProduct = groupProduct::find($key);

            $groupProduct->product_id = json_encode($productname);

            $groupProduct->save();

        }
      

        echo "thanh cong";
        
    }

    public function getContentDienmayxanh()
    {

        $link = 'https://www.dienmayxanh.com/tivi/smart-man-hinh-xoay-the-sero-qled-samsung-4k-43-inch-qa43ls05b
        https://www.dienmayxanh.com/tivi/smart-kieu-chu-i-co-chan-the-serif-qled-samsung-4k-50-inch-qa50ls01ba
        https://www.dienmayxanh.com/tivi/smart-tivi-kieu-chu-i-co-chan-the-serif-qled-samsung-4k-55-inch-qa55ls01ba
        https://www.dienmayxanh.com/tivi/smart-kieu-chu-i-co-chan-the-serif-qled-samsung-4k-65-inch-qa65ls01b
        https://www.dienmayxanh.com/tivi/smart-tivi-khung-tranh-the-frame-qled-samsung-full-hd-32-inch-qa32ls03b
        https://www.dienmayxanh.com/tivi/smart-khung-tranh-the-frame-qled-samsung-4k-50-inch-qa50ls03b
        https://www.dienmayxanh.com/tivi/smart-khung-tranh-the-frame-qled-samsung-4k-55-inch-qa55ls03b
        https://www.dienmayxanh.com/tivi/smart-khung-tranh-the-frame-qled-samsung-4k-65-inch-qa65ls03b
        https://www.dienmayxanh.com/tivi/smart-khung-tranh-the-frame-qled-samsung-4k-75-inch-qa75ls03b
        https://www.dienmayxanh.com/tivi/smart-tivi-oled-samsung-4k-55-inch-qa55s95b
        https://www.dienmayxanh.com/tivi/smart-tivi-oled-samsung-4k-65-inch-qa65s95b
        https://www.dienmayxanh.com/tivi/smart-tivi-qled-4k-50-inch-samsung-qa50q80c
        https://www.dienmayxanh.com/tivi/smart-tivi-qled-4k-55-inch-samsung-qa55q80c
        https://www.dienmayxanh.com/tivi/smart-tivi-qled-4k-65-inch-samsung-qa65q80c
        https://www.dienmayxanh.com/tivi/smart-tivi-qled-4k-75-inch-samsung-qa75q80c
        https://www.dienmayxanh.com/tivi/smart-tivi-qled-4k-85-inch-samsung-qa85q80c
        https://www.dienmayxanh.com/tivi/smart-tivi-oled-samsung-4k-55-inch-qa55s95ca
        https://www.dienmayxanh.com/tivi/smart-tivi-oled-samsung-4k-65-inch-qa65s90ca
        https://www.dienmayxanh.com/tivi/smart-tivi-oled-samsung-4k-65-inch-qa65s95ca
        https://www.dienmayxanh.com/tivi/smart-tivi-oled-samsung-4k-77-inch-qa77s95ca
        https://www.dienmayxanh.com/tu-lanh/tu-lanh-lg-inverter-655-lit-gr-q257mc
        https://www.dienmayxanh.com/tu-lanh/tu-lanh-lg-gr-b53mb
        https://www.dienmayxanh.com/tu-lanh/tu-lanh-lg-inverter-530-lit-gr-b53ps
        https://www.dienmayxanh.com/tu-lanh/samsung-inverter-307-lit-rb30n4190by-sv
        https://www.dienmayxanh.com/tu-lanh/tu-lanh-hitachi-390-lit-r-fvy510pgv0-gmg
        https://www.dienmayxanh.com/tu-lanh/hitachi-inverter-509-lit-r-fw650pgv8
        https://www.dienmayxanh.com/tu-lanh/hitachi-inverter-569-lit-r-wb640pgv1
        https://www.dienmayxanh.com/tu-lanh/hitachi-inverter-573-lit-r-sx800gpgv0
        https://www.dienmayxanh.com/tu-lanh/tu-lanh-hitachi-r-zx740kv-x
        https://www.dienmayxanh.com/tu-lanh/hitachi-r-fw690pgv7-gbw
        https://www.dienmayxanh.com/tu-lanh/tu-lanh-hitachi-inverter-540-lit-r-hw540rv-x
        https://www.dienmayxanh.com/may-giat/tu-cham-soc-quan-ao-thong-minh-lg-s5goc
        https://www.dienmayxanh.com/may-giat/tu-cham-soc-quan-ao-thong-minh-lg-s5boc
        https://www.dienmayxanh.com/may-giat/may-giat-say-lg-inverter-14-kg-wt1410nhb
        https://www.dienmayxanh.com/may-giat/may-giat-say-lg-inverter-21-kg-f2721hvrb
        https://www.dienmayxanh.com/may-giat/may-giat-lg-fv1414s3ba
        https://www.dienmayxanh.com/may-giat/may-giat-lg-inverter-14-kg-fv1414s3p
        https://www.dienmayxanh.com/may-giat/may-giat-lg-fv1413s4w
        https://www.dienmayxanh.com/may-giat/may-giat-lg-fv1412s3ba
        https://www.dienmayxanh.com/may-giat/may-giat-lg-fv1412s3pa
        https://www.dienmayxanh.com/may-giat/may-giat-lg-fv1411s4wa
        https://www.dienmayxanh.com/may-giat/samsung-inverter-23-kg-wa23a8377gv-sv
        https://www.dienmayxanh.com/may-giat/samsung-wa22r8870gv-sv
        https://www.dienmayxanh.com/may-giat/samsung-wa12t5360by-sv
        https://www.dienmayxanh.com/may-giat/may-giat-samsung-14kg-wa14cg5886bvsv
        https://www.dienmayxanh.com/may-giat/may-giat-samsung-14kg-wa14cg5745bvsv
        https://www.dienmayxanh.com/may-giat/may-giat-samsung-12kg-wa12cg5886bvsv
        https://www.dienmayxanh.com/may-giat/may-giat-samsung-12kg-wa12cg5745bvsv
        https://www.dienmayxanh.com/ban-ui/hoi-nuoc-panasonic-ni-s630vra
        https://www.dienmayxanh.com/ban-ui/hoi-nuoc-panasonic-ni-s530ara
        https://www.dienmayxanh.com/ban-ui/hoi-nuoc-panasonic-ni-s430gra
        https://www.dienmayxanh.com/lo-vi-song/lo-vi-song-panasonic-nn-gt35nbyue-24-lit
        https://www.dienmayxanh.com/lo-vi-song/lo-vi-song-panasonic-nn-st34nbyue-25-lit
        https://www.dienmayxanh.com/may-hut-bui/may-hut-bui-dang-hop-panasonic-mc-cl609hn49
        https://www.dienmayxanh.com/may-hut-bui/may-hut-bui-dang-hop-panasonic-mc-cl607rn49
        https://www.dienmayxanh.com/noi-com-dien/noi-com-nap-roi-panasonic-72-lit-sr-ga721wra
        https://www.dienmayxanh.com/may-say-toc/panasonic-eh-na98rp645
        https://www.dienmayxanh.com/may-say-toc/panasonic-eh-na98-k645
        https://www.dienmayxanh.com/may-say-toc/may-say-toc-1800w-panasonic-eh-ne27-k645
        https://www.dienmayxanh.com/may-say-toc/panasonic-eh-nd57-h645
        https://www.dienmayxanh.com/may-say-toc/panasonic-eh-nd57-h645
        https://www.dienmayxanh.com/may-say-toc/1800w-panasonic-eh-nd37-k645
        https://www.dienmayxanh.com/may-say-toc/may-say-toc-1800w-panasonic-eh-nd37-p645
        https://www.dienmayxanh.com/lo-vi-song/sharp-r-205vn-s-20-lit#2-gia
        https://www.dienmayxanh.com/lo-vi-song/sharp-r-g272vn-s-20-lit
        https://www.dienmayxanh.com/lo-vi-song/sharp-r-g302vn-s#2-gia
        https://www.dienmayxanh.com/lo-vi-song/sharp-r-g371vn-w#2-gia
        https://www.dienmayxanh.com/lo-vi-song/sharp-r-c825vn-st
        https://www.dienmayxanh.com/lo-vi-song/sharp-r-c932vn-st
        https://www.dienmayxanh.com/lo-vi-song/lo-vi-song-sharp-r-g728xvn-bst
        https://www.dienmayxanh.com/lo-vi-song/lo-vi-song-sharp-r-c932xvn-bst
        https://www.dienmayxanh.com/lo-vi-song/r-32a2vn-s-23-lit
        https://www.dienmayxanh.com/lo-vi-song/r-370vn-s-23-lit
        https://www.dienmayxanh.com/lo-vi-song/sharp-r-289vn-w
        https://www.dienmayxanh.com/noi-com-dien/sharp-18-lit-ks-ih191v-bk
        https://www.dienmayxanh.com/noi-com-dien/sharp-18-lit-ks-ih191v-gl
        https://www.dienmayxanh.com/noi-com-dien/sharp-ks-ih191v-rd-18-lit
        https://www.dienmayxanh.com/noi-com-dien/sharp-ks-com08v-sl-072-lit
        https://www.dienmayxanh.com/noi-com-dien/noi-com-dien-tu-sharp-11-lit-ks-com110dv-wh
        https://www.dienmayxanh.com/noi-com-dien/sharp-ksh-218snv-sf-18-lit
        https://www.dienmayxanh.com/noi-com-dien/sharp-ksh-228snv-sf-22-lit
        https://www.dienmayxanh.com/noi-com-dien/sharp-18l-kn-tc50vn-sl-bac
        https://www.dienmayxanh.com/noi-com-dien/sharp-18l-kn-tc50vn-wh
        https://www.dienmayxanh.com/noi-com-dien/sharp-5-lit-ksh-d55v
        https://www.dienmayxanh.com/noi-com-dien/sharp-7-lit-ksh-d77v
        https://www.dienmayxanh.com/noi-com-dien/sharp-10-lit-ksh-d1010v
        https://www.dienmayxanh.com/noi-com-dien/sharp-ks-n191etv
        https://www.dienmayxanh.com/noi-com-dien/dien-tu-sharp-ks-com18v
        https://www.dienmayxanh.com/binh-thuy-dien/binh-thuy-dien-sharp-kp-30stv
        https://www.dienmayxanh.com/binh-thuy-dien/dien-sharp-kp-20btv
        https://www.dienmayxanh.com/binh-thuy-dien/sharp-kp-31btv-cu
        https://www.dienmayxanh.com/binh-thuy-dien/sharp-kp-y32pv-cu
        https://www.dienmayxanh.com/binh-thuy-dien/sharp-kp-y40pv-cu
        https://www.dienmayxanh.com/binh-thuy-dien/binh-thuy-dien-sharp-kp-40ebv-bk-4-lit
        https://www.dienmayxanh.com/binh-thuy-dien/binh-thuy-dien-sharp-kp-40ebv-wh-4-lit
        https://www.dienmayxanh.com/binh-thuy-dien/binh-thuy-dien-sharp-kp-40ebv-st-4-lit
        https://www.dienmayxanh.com/noi-chien-khong-dau/sharp-kf-af70ev-st
        https://www.dienmayxanh.com/may-xay-sinh-to/sharp-em-s154pv-wh
        https://www.dienmayxanh.com/may-xay-sinh-to/sharp-em-s155pv-wh
        https://www.dienmayxanh.com/binh-dun-sieu-toc/sharp-ekj-10dvps-rd
        https://www.dienmayxanh.com/binh-dun-sieu-toc/binh-dun-sieu-toc-sharp-ekj-17evps-bk
        https://www.dienmayxanh.com/binh-dun-sieu-toc/binh-dun-sieu-toc-sharp-ekj-17evsd-wd
        https://www.dienmayxanh.com/binh-dun-sieu-toc/binh-dun-sieu-toc-sharp-ekj-15evs-st
        https://www.dienmayxanh.com/lo-nuong/sharp-eo-a323rcsv-st
        https://www.dienmayxanh.com/lo-nuong/sharp-eo-a384rcsv-st
        https://www.dienmayxanh.com/lo-nuong/lo-nuong-sharp-eo-b46rcsv-bk
        https://www.dienmayxanh.com/may-vat-cam/may-vat-cam-sharp-ej-j256-wh
        https://www.dienmayxanh.com/may-vat-cam/may-vat-cam-sharp-ej-j415-wh
        https://www.dienmayxanh.com/may-vat-cam/may-vat-cam-sharp-ej-j407-bk
        https://www.dienmayxanh.com/may-vat-cam/may-vat-cam-sharp-ej-j407-wh
        https://www.dienmayxanh.com/may-vat-cam/may-vat-cam-sharp-ej-j130-st
        https://www.dienmayxanh.com/quat/dung-sharp-pj-s40rv-lg
        https://www.dienmayxanh.com/may-loc-khong-khi/may-loc-khong-khi-sharp-fp-j80ev-h
        https://www.dienmayxanh.com/may-loc-khong-khi/may-loc-khong-khi-sharp-fp-jm40v-b
        https://www.dienmayxanh.com/may-loc-khong-khi/sharp-fp-gm50e-b
        https://www.dienmayxanh.com/may-hut-am/may-hut-am-sharp-dw-d12a-w
        https://www.dienmayxanh.com/may-hut-am/may-hut-am-sharp-dw-d12a-w
        https://www.dienmayxanh.com/may-hut-am/may-hut-am-sharp-dw-d20a-w
        https://www.dienmayxanh.com/may-say-quan-ao/may-say-thong-hoi-whirlpool-15-kg-3lwed4815fw
        https://www.dienmayxanh.com/may-say-quan-ao/may-say-ngung-tu-whirlpool-8-kg-fftcm118xb-ee
        https://www.dienmayxanh.com/may-say-quan-ao/may-say-thong-hoi-whirlpool-7-kg-awd712s2
        https://www.dienmayxanh.com/may-rua-chen/whirlpool-wfe-2b19
        https://www.dienmayxanh.com/may-rua-chen/whirlpool-wfc-3c26p
        https://www.dienmayxanh.com/may-rua-chen/whirlpool-wio-3t133p';

        $codess = explode(PHP_EOL, $link);

        foreach ($codess as $key => $val) {

            $file_headers = @get_headers(trim($val));

            if($file_headers[0] == 'HTTP/1.1 200 OK') 
            {
            
                $html = file_get_html(trim($val));


            
                $content  = html_entity_decode($html->find('.article ',0));

                $tskt  = html_entity_decode($html->find('.parameter',0));

                preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i',$content, $matches);

                foreach ($matches[1] as $key => $value) {

                    $inputs = [];

                    $inputs['link'] = $val;

                    $inputs['image'] = $value;

                    DB::table('imagecrawl')->insert($inputs);

                    // $img = '/images/crawl_img/'.basename($value);

                    // $file_headers = @get_headers(trim($value));

                    // if($file_headers[0] == 'HTTP/1.1 200 OK'){

                    //     //phần lưu ảnh vào folder ảnh

                    //     file_put_contents(public_path().$img, file_get_contents($value));

                    //     // viết lại ảnh đã lưu

                    //     $content = str_replace($value, $img, $content);
                    // }
                    // else{

                    //     echo $value;

                    // }

                   
                }

                $input = [];

                $input['Specifications'] = $tskt;

                $input['Detail'] = $content;

                $input['Link'] = $val;

                DB::table('product1')->insert($input);
            }  

            else{
                echo $val;
            }   

        }

        echo "thành công";
    }

    public function convertImgToContent()
    {

        $data           = DB::table('product1')->get();

        $html           = file_get_html('https://www.dienmayxanh.com/may-rua-chen/whirlpool-wio-3t133p');

        $content_img    = html_entity_decode($html->find('.article ',0));

        preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i',$content_img, $matches);

        foreach ($matches[1] as $key => $value) {

            $img = 'images/crawl_img/'.basename($value);

            //phần lưu ảnh vào folder ảnh

            file_put_contents(public_path().$img, file_get_contents($value));

            // viết lại ảnh đã lưu

            $content = str_replace($value, $img, $details);
        }
    
    }


    public function getAvaProduct()
    {
        $ava = 'QA43LS05BA
                QA50LS01BA
                QA55LS01BA
                QA65LS01BA
                QA32LS03BB
                QA50LS03BA
                QA55LS03BA
                QA65LS03BA
                QA75LS03BA
                QA55S95BA
                QA65S95BA
                QA50Q80C
                QA55Q80C
                QA65Q80C
                QA75Q80C
                QA85Q80C
                QA55S95C
                QA65S90C
                QA65S95C
                QA77S95C
                GR-Q257MC
                GR-B53MB
                GR-B53PS
                RB30N4190BY/SV
                R-FVY510PGV0(GMG)
                R-FW650PGV8(GBK)
                R-WB640PGV1(GMG)
                R-SX800GPGV0(GBK)
                R-ZX740KV(X)
                R-FW690PGV7(GBW)
                R-HW540RV(X)
                S5GOC
                S5BOC
                WT1410NHB
                F2721HVRB
                FV1414S3BA
                FV1414S3P
                FV1413S4W
                FV1412S3BA
                FV1412S3PA
                FV1411S4WA
                WA23A8377GV/SV
                WA22R8870GV/SV
                WA12T5360BY/SV
                WA14CG5886BVSV
                WA14CG5745BVSV
                WA12CG5886BVSV
                WA12CG5745BVSV
                NI-S630VRA
                NI-S530ARA
                NI-S430GRA
                NN-GT35NBYUE
                NN-ST34NBYUE
                MC-CL609HN49
                MC-CL607RN49
                SR-GA721WRA
                EH-NA98RP645
                EH-NA98-K645
                EH-NE27-K645
                EH-ND57-P645
                EH-ND57-H645
                EH-ND37-K645
                EH-ND37-P645
                R-205VN-S
                R-G272VN-S
                R-G302VN-S
                R-G371VN-W
                R-C825VN (ST)
                R-C932VN (ST)
                R-G728XVN-BST
                R-C932XVN-BST
                R-32A2VN-S
                R-370VN-S
                R-289VN(W)
                KS-IH191V-BK
                KS-IH191V-GL
                KS-IH191V-RD
                KS-COM08V-SL
                KS-COM110DV-WH
                KSH-218SNV-SF
                KSH-228SNV-SF
                KN-TC50VN-SL
                KN-TC50VN-WH
                KSH-D55V
                KSH-D77V
                KSH-D1010V
                KS-N191ETV-CU
                KS-COM18V
                KP-30STV
                KP-20BTV
                KP-31BTV-CU
                KP-Y32PV-CU
                KP-Y40PV-CU
                KP-40EBV-BK
                KP-40EBV-WH
                KP-40EBV-ST
                KF-AF70EV-ST
                EM-S154PV-WH
                EM-S155PV-WH
                EKJ-10DVPS-RD
                EKJ-17EVPS-BK
                EKJ-17EVSD-WD
                EKJ-15EVS-ST
                EO-A323RCSV-ST
                EO-A384RCSV-ST
                EO-B46RCSV-BK
                EJ-J256-WH
                EJ-J415-WH
                EJ-J407-BK
                EJ-J407-WH
                EJ-J130-ST
                PJ-S40RV-LG
                FP-J80EV-H
                FP-JM40V-B
                FP-GM50E-B
                DW-D12A-W
                DW-D12A-W
                DW-D20A-W
                3LWED4815FW 
                FFTCM118XBEE
                AWD712S2
                WFE2B19
                WFC3C26P
                WIO3T133P';
    }


   


    public function crawl()
    {
        $dif = $this->cralwss();

        if(isset($dif)){
            foreach ($dif as $url) {
                
                $html = file_get_html(trim($url));
                $title = strip_tags($html->find('.emty-title h1', 0));
                
                $specialDetail = html_entity_decode($html->find('.special-detail', 0));
                $content  = html_entity_decode($html->find('.emty-content .Description',0));

               

                preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $content, $matches);

                $arr_change = [];

                $time = time();

                $regexp = '/^[a-zA-Z0-9][a-zA-Z0-9\-\_]+[a-zA-Z0-9]$/';

                if(isset($matches[1])){
                    foreach($matches[1] as $value){
                       
                        $value = 'http://dienmaynguoiviet.com/'.str_replace('..', '', $value);

                        $arr_image = explode('/', $value);

                        if($arr_image[0] != env('APP_URL')){

                            $file_headers = @get_headers($value);


                            if($file_headers[0] == 'HTTP/1.1 200 OK') 
                            {

                                $infoFile = pathinfo($value, PATHINFO_EXTENSION);

                               if(!empty($infoFile)){

                                    if($infoFile=='png'||$infoFile=='jpg'||$infoFile=='web'){

                                        $img = '/images/product/crawl/'.basename($value);

                                        file_put_contents(public_path().$img, file_get_contents($value));

                                     
                                        array_push($arr_change, 'images/product/crawl/'.basename($value));
                                    }   
                                }

                                
                            }
                           
                        }
                        
                    }
                }



                $content = str_replace($matches[1], $arr_change, $content);

                $price = strip_tags($html->find(".p-price", 0));

                $info  = html_entity_decode($html->find('.emty-info table', 0));
                // $arElements = $html->find( "meta[name=keywords]" );
                $price = trim(str_replace('Liên hệ', '0', $price));
                $price =  trim(str_replace(["Giá:","VNĐ",".", "Giá khuyến mại:"],"",$price));
                $images =  html_entity_decode($html->find('#owl1 img',0));
                
                if(!empty($images) ){
                    $image = $html->find('#owl1 img',0)->src;
                    if(!empty($image)){

                        $urlImage = 'http://dienmaynguoiviet.com/'.$image;

                        $contents = file_get_contents($urlImage);
                        $name = basename($urlImage);
                        
                        $name = '/uploads/product/crawl/'.time().'_'.$name;

                        Storage::disk('public')->put($name, $contents);

                        $image = $name;

                    }
                    else{
                        $image = '/images/product/noimage.png';
                    }

                    $model = strip_tags($html->find('#model', 0));

                    $qualtily = -1;

                    $maker = 12;

                    $meta_id = 0;

                    $group_id = 2;

                    $active = 0;

                    $link =  str_replace('/', '', trim(str_replace('http://dienmaynguoiviet.com/', '', $url)));

                    $inputs = ["Link"=>$link, "Price"=>$price, "Name"=>$title, "ProductSku"=>$model, "Image"=>$image, "Quantily"=>$qualtily, "Maker"=>$maker, "Meta_id"=>$meta_id,"Group_id"=>$group_id, "active"=>0, "Specifications"=>$info, "Salient_Features"=>$specialDetail, "Detail"=>$content];

                    product::Create($inputs);
                    DB::table('product_crawl')->insert(['link'=>$url]);
                }
                else{
                    print_r($url);
                } 
               
               
            }    
        }

        echo "thanh cong";

    } 


    public function cralwss()
    {
        $code  = "http://dienmaynguoiviet.com/dieu-hoa-daikin-ftxd35dvmarxd35dvma/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-205pg/
http://dienmaynguoiviet.com/tu-lanh-sanyo-aqr95arss-1-cua-95l/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt25har4dsasv-255-lit/
http://dienmaynguoiviet.com/loa-dalton-lx-900/
http://dienmaynguoiviet.com/tivi-tcl-24d2720-led-24-inches-hd/
http://dienmaynguoiviet.com/dan-am-thanh-samsung-ht-h7750wmxv-3d-bluray-51/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-16vf2-bs-2-canh-165-lit/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bk346msvn-333-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/binh-thuy-dien-panasonic-22-lit-nc-eg2200csy/
http://dienmaynguoiviet.com/smart-tivi-sony-55-inch-kd-55x8000es-4k/
http://dienmaynguoiviet.com/may-giat-lg-wf-d1517hd-long-dung-15kg/
http://dienmaynguoiviet.com/android-tivi-sony-kd-65x80js-65-inch-4k/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-185mg-185-lit/
http://dienmaynguoiviet.com/smart-tivi-tcl-l50e5900-50-inch-4k/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt-38k5982slsv-380-lit-inverter-ngan-da-tren/
http://dienmaynguoiviet.com/dieu-hoa-samsung-as09twqnxea-1-chieu-9000btu/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt32farcdp1-sv/
http://dienmaynguoiviet.com/smart-tivi-led-lg-49-inch-49lk5700pta/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ft25jv1vr25jv1v-1-chieu-9000btu/
http://dienmaynguoiviet.com/tivi-sony-kdl-40r350d-40-inch-full-hd/
http://dienmaynguoiviet.com/may-giat-lg-wf-d8525dd-long-dung-85kg/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-c12sk-1-chieu-12000btu-dao-gio-tu-dong/
http://dienmaynguoiviet.com/tivi-panasonic-th-32ds500v-32-inch-hd-400hz/
http://dienmaynguoiviet.com/dieu-hoa-tcl-rvsc09kei-1-chieu-9000btu/
http://dienmaynguoiviet.com/dieu-hoa-daikin-1-chieu-inverter-9000btu-ftks25gvmvrks25gvmv/
http://dienmaynguoiviet.com/dau-dia-dvd-lg-dp132-usb/
http://dienmaynguoiviet.com/smart-tivi-tcl-49-inch-49p3-cf-full-hd/
http://dienmaynguoiviet.com/tivi-tcl-l48d2720-48-inches-full-hd-tan-so-60-hz/
http://dienmaynguoiviet.com/may-giat-samsung-inverter-7.5-kg-ww75j42g0kw/sv/
http://dienmaynguoiviet.com/amply-karaoke-paramax-sa333/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-a12sk-2-chieu-12000btu-quat-gio-3-che-do-hien-thi-da-mau/
http://dienmaynguoiviet.com/tivi-sony-kdl-43w800c-43-inches-full-hd-3d/
http://dienmaynguoiviet.com/tu-lanh-hitachi-rz470eg9/
http://dienmaynguoiviet.com/dieu-hoa-tcl-tac-12csby-12000btu/
http://dienmaynguoiviet.com/tivi-tcl-l48z1-smart-zing-tv-48-inch/
http://dienmaynguoiviet.com/tu-lanh-aqua-aqr-145an-130-lit-ngan-da-tren/
http://dienmaynguoiviet.com/smart-tivi-tcl-l43z2-43-inch-4k/
http://dienmaynguoiviet.com/smart-tivi-lg-65uh617t-65-inch-4k-100hz/
http://dienmaynguoiviet.com/tu-lanh-toshiba-gr-s19vpp-ds-171-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/dieu-hoa-tu-dung-lg-hp-h246slao-2-chieu-24000btu/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt-32k5532s8sv-320-lit-inverter-ngan-da-tren/
http://dienmaynguoiviet.com/dieu-hoa-samsung-ar09mcftburnsv-9000btu-1-chieu/
http://dienmaynguoiviet.com/tivi-panasonic-th-49d410v-49-inch-full-hd/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-c09sk-1-chieu-9000btu-quat-gio-3-cap-do/
http://dienmaynguoiviet.com/tivi-lg-32lj500d-32-inch-hd/
http://dienmaynguoiviet.com/top-4-smart-tivi-sony-50-inch-gia-tot-thang-42022/
http://dienmaynguoiviet.com/tu-lanh-hitachi-rt350eg1d/
http://dienmaynguoiviet.com/tu-lanh-lg-gr-c362s/
http://dienmaynguoiviet.com/tivi-tcl-32d2700-32-inches-tan-so-60hz/
http://dienmaynguoiviet.com/smart-tivi-lg-65un721c0tf-65-inch-4k/
http://dienmaynguoiviet.com/tu-lanh-lg-gr-c502s-368-lit/
http://dienmaynguoiviet.com/internet-tivi-sony-kd-43x7000e-43-inch-4k/
http://dienmaynguoiviet.com/tivi-tcl-28d2700-28-inches-tan-so-60-hz/
http://dienmaynguoiviet.com/smart-tivi-tcl-55-inch-l55p3-cf-full-hd/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-173e-wh-165l-ngan-da-tren-2-canh/
http://dienmaynguoiviet.com/tu-lanh-samsung-364-lit-rt35k5532s8sv-ngan-da-tren/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-210e-sl-196-lit/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftxs60fvmvrxs60fvmv-2-chieu-inverter-21000btu/
http://dienmaynguoiviet.com/loa-thap-samsung-tw-h5500-22/
http://dienmaynguoiviet.com/micro-khong-day-sm-5000/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-1-chieu-inverter-9000btu-cucs-ts9pkh-8/
http://dienmaynguoiviet.com/tivi-led-samsung-ua32j4303-smart-tv-32-inches-cmr-100hz/
http://dienmaynguoiviet.com/dan-am-thanh-51-samsung-ht-e350k/
http://dienmaynguoiviet.com/dau-karaoke-vitek-vk350/
http://dienmaynguoiviet.com/tu-lanh-toshiba-gr-tg41vpdzzw-2-canh-259-lit/
http://dienmaynguoiviet.com/smart-tivi-lg-55lh575t-55-inch-full-hd-100hz/
http://dienmaynguoiviet.com/dau-dia-dvd-sony-dvp-ns648/
http://dienmaynguoiviet.com/internet-tivi-tcl-32-inch-l32s4900-hd/
http://dienmaynguoiviet.com/tu-lanh-hitachi-rt310eg1sls-2-canh-260-lit/
http://dienmaynguoiviet.com/smart-tivi-tcl-l40e5900-40-inch-4k/
http://dienmaynguoiviet.com/internet-tivi-sony-kdl-49w750d-49-inch-full-hd/
http://dienmaynguoiviet.com/tu-lanh-aqua-aqr-s205bn-205-lit-ngan-da-tren/
http://dienmaynguoiviet.com/quat-lam-mat-honeywell-cl60pm/
http://dienmaynguoiviet.com/may-giat-long-ngang-panasonic-na-129vx6lv2/
http://dienmaynguoiviet.com/smart-tivi-sony-49-inch-kd-49x7000d-android-4k/
http://dienmaynguoiviet.com/tu-lanh-2-canh-lg-gn-l272bs-272-lit/
http://dienmaynguoiviet.com/tivi-tcl-l55h8800-smart-tv-55/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-l272bf-272-lit-inverter/
http://dienmaynguoiviet.com/tivi-lg-49lh600t-49-inch-smart-tv-full-hd/
http://dienmaynguoiviet.com/tu-lanh-sanyo-aqua-aqr-s185an-165-lit-ngan-da-tren/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftks60fvmvrks60fvmv-1-chieu-inverter-21000btu/
http://dienmaynguoiviet.com/may-giat-lg-wf-c7417b-74-kg-long-dung/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-18sakura-pk-181-lit/
http://dienmaynguoiviet.com/smart-tivi-lg-49uh610t-49-inch-4k-100hz/
http://dienmaynguoiviet.com/may-giat-lg-wf-c7417t/
http://dienmaynguoiviet.com/tivi-tcl-l32d3000-32-inch-hd/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftxs35evmvrxs35ebvmv-2-chieu-inverter-12000btu/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt43h5631sl-sv/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftxd50fvmvrxd50fvmv-2-chieu-inverter-18000btu/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-l222ps-225-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/smart-tivi-sony-kd-49x8000es-4k-uhd-49-inch/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-212e-ss-196-lit-2-canh/
http://dienmaynguoiviet.com/dan-am-thanh-51-lg-dh6430p-4-loa/
http://dienmaynguoiviet.com/smart-tivi-tcl-l43s6100-43-inch-hd/
http://dienmaynguoiviet.com/tivi-led-lg-49lh570t-49-inch-full-hd/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftks35evmvrks35ebvmv-1-chieu-inverter-12000btu/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftkd42hvmvrkd42hvmv-1-chieu-inverter-14300btu/
http://dienmaynguoiviet.com/dau-karaoke-vitek-vk400/
http://dienmaynguoiviet.com/smart-tivi-lg-55uh617t-55-inch-4k-100hz/
http://dienmaynguoiviet.com/smart-tivi-tcl-l43p65-uf-43-inch-4k/
http://dienmaynguoiviet.com/tv-lg-49lf540t-49-inch-led-full-hd-50hz/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-bw30dv-bk-290-lit-2-canh-ngan-da-duoi/
http://dienmaynguoiviet.com/may-giat-lg-wf-c7217t-long-dung-72kg/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-c18sk-1-chieu-18000btu-quat-gio-3-cap-do-man-hien-thi-da-mau/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-c24tk-1-chieu-24000btu-quat-gio-3-cap-do-man-hien-thi-da-mau/
http://dienmaynguoiviet.com/may-giat-panasonic-9kg-na-f90v5lmx/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-18sakura-pk-2-canh-180-lit/
http://dienmaynguoiviet.com/tu-lanh-aqua-110-lit-aqr-125bn/
http://dienmaynguoiviet.com/tu-lanh-funiki-fr-182ci-180-lit/
http://dienmaynguoiviet.com/tu-lanh-hitachi-rt350eg1-2-canh-290-lit/
http://dienmaynguoiviet.com/dan-am-thanh-samsung-ht-j5150kxv-51-blu-ray-2d/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt22har4dsa-sv/
http://dienmaynguoiviet.com/tivi-tcl-l65h8800-smart-tv-65/
http://dienmaynguoiviet.com/internet-tivi-panasonic-th-43dx400v-43-inch-4k/
http://dienmaynguoiviet.com/tu-lanh-electrolux-etb2100pc-210-lit-ngan-da-tren-2-cua/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-316s-sc-308-lit/
http://dienmaynguoiviet.com/tivi-tcl-l55d2730-led-55-inch-full-hd/
http://dienmaynguoiviet.com/tivi-led-lg-43lh570t-43-inch-full-hd/
http://dienmaynguoiviet.com/dieu-hoa-tcl-rvsc09kds-1-chieu-9000btu/
http://dienmaynguoiviet.com/dan-am-thanh-lg-dh3130s/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-170s-bl-165-lit-2-canh/
http://dienmaynguoiviet.com/loa-paramax-p-509/
http://dienmaynguoiviet.com/smart-tivi-lg-32-inch-32lh591d-hd/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-189s-ds-2-canh-181-lit/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt29fajbdsa-sv-290-lit-2-canh/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-a09tk-2-chieu-9000btu-quat-gio-3-cap-do-man-hien-thi-da-mau/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-346s-sc-339-lit-2-canh/
http://dienmaynguoiviet.com/smart-tivi-samsung-ua43k5500-43-inches/
http://dienmaynguoiviet.com/tivi-lg-60uh850t-smart-tv-60-inch-4k-3d-200hz/
http://dienmaynguoiviet.com/tu-lanh-electrolux-ete3200se-rvn-2-canh-320l/
http://dienmaynguoiviet.com/android-tivi-sony-kdl-55w800c-55-inch/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-inverter-24000btu-cu/cs-pu24vkh-8/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-l275ps-275l-inverter/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftxd71fvmvrxd71bvmv-2-chieu-inverter-24000btu/
http://dienmaynguoiviet.com/dau-karaoke-6-so-belco-md-279/
http://dienmaynguoiviet.com/tu-lanh-samsung-502-lit-rt50k6631bssv-ngan-da-tren/
http://dienmaynguoiviet.com/tu-lanh-panasonic-152-lit-nr-ba178psvn-ngan-da-duoi/
http://dienmaynguoiviet.com/dan-am-thanh-51-samsung-ht-h5530hk-bluray-3d/
http://dienmaynguoiviet.com/tu-lanh-hitachi-rt190eg1/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bk306msvn-296-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/may-giat-toshiba-aw-c820sv-wu-long-dung-72-kg/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-2-chieu-inverter-cucs-e18pkh-8-18000btu/
http://dienmaynguoiviet.com/tivi-panasonic-th-43d410v-43-inch-full-hd/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-280e-sl-ngan-da-tren-271-lit/
http://dienmaynguoiviet.com/tv-lg-42lf550t-42-inch-led-full-hd-100hz/
http://dienmaynguoiviet.com/tu-lanh-2-canh-hitachi-r-z440eg9-365-lit/
http://dienmaynguoiviet.com/tivi-tcl-32d2720-led-32-inches-hd/
http://dienmaynguoiviet.com/android-tivi-sony-43-inch-kd-43x8000d-4k/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftkd60hvmvrkd60hvmv-1-chieu-inverter-21200btu/
http://dienmaynguoiviet.com/tu-lanh-funiki-fr-136ci-135-lit/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-2-chieu-24000btu-cucs-a24pkh-8/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-1-chieu-inverter-9000btu-cucs-ts9qkh-8/
http://dienmaynguoiviet.com/tu-lanh-aqua-aqr-s185bn-ngan-da-tren-165-lit/
http://dienmaynguoiviet.com/tu-lanh-2-canh-panasonic-nr-bu344snvn-342-lit/
http://dienmaynguoiviet.com/android-tivi-sony-65-inch-kd-65s8500d/
http://dienmaynguoiviet.com/amply-karaoke-dalton-da-5000xg/
http://dienmaynguoiviet.com/dan-am-thanh-52-lg-arx8500-bluray-3d/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-186s-sc-186-lit-2-canh/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-cu/cs-xpu9wkh-8-inverter-9000btu/
http://dienmaynguoiviet.com/tu-lanh-electrolux-etb2300pc-230-lit-ngan-da-tren-2-cua/
http://dienmaynguoiviet.com/dieu-hoa-tcl-rvsch09kds-2-chieu-9000btu/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bj151ssvn-130-lit-2-canh/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-cs-ye9rkh-8-inverter-2-chieu-gas-r410a/
http://dienmaynguoiviet.com/dieu-hoa-daikin-2-chieu-inverter-18000btu-ftxd50hvmvrxd50hvmv/
http://dienmaynguoiviet.com/dieu-hoa-daikin-fte50lv1vre50lv1v-1-chieu-18000btu/
http://dienmaynguoiviet.com/loa-belco-is-4500/
http://dienmaynguoiviet.com/dieu-hoa-daikin-fte20mv1vre20mv1v-1-chieu-7500btu/
http://dienmaynguoiviet.com/dieu-hoa-nagakawans-c12tk-1-chieu-12000btu-dao-gio-tu-dong/
http://dienmaynguoiviet.com/dieu-hoa-daikin-fte35kv1re35kv1/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftxd50fvmvrxd50bvmv-2-chieu-inverter-18000btu/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-185ss/
http://dienmaynguoiviet.com/amly-paramax-sa-333/
http://dienmaynguoiviet.com/internet-tivi-panasonic-49-inch-th-49dx400v-4k/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bj158ssv1-135-lit/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-2-chieu-12000btu-cucs-a12pkh-8/
http://dienmaynguoiviet.com/smart-tivi-tcl-55-inch-l55c1-uc-man-hinh-cong-4k/
http://dienmaynguoiviet.com/smart-tivi-tcl-l32s6100-32-inch-hd/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt-29k5532s8sv-290-lit-inverter-ngan-da-tren/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-c18tl-1-chieu-18000btu/
http://dienmaynguoiviet.com/tu-lanh-toshiba-gr-s25vpb-s-228-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-2-chieu-9000btu-cucs-a9pkh-8/
http://dienmaynguoiviet.com/dieu-hoa-daikin-fte25kv1re25kv1/
http://dienmaynguoiviet.com/tu-lanh-sbs-samsung-rs21hklmr1-xsv-531-lit/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-196s-sc-hai-canh-194-lit/
http://dienmaynguoiviet.com/tu-lanh-hitachi-rt190eg1d-2-canh-185-lit/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-12000btu-cucs-e12pkh-8-2-chieu-inverter/
http://dienmaynguoiviet.com/smart-tivi-panasonic-55-inch-4k-th-55fx800v/
http://dienmaynguoiviet.com/tivi-panasonic-th-49ds630v-smart-tv-49-inch/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-205ss/
http://dienmaynguoiviet.com/tu-lanh-electrolux-etb2102pe-rvn-2-canh-210l/
http://dienmaynguoiviet.com/dieu-hoa-hitachi-ras-10lh2-2-chieu-10000btu/
http://dienmaynguoiviet.com/tu-lanh-2-canh-panasonic-nr-bw415vnvn-407-lit/
http://dienmaynguoiviet.com/tivi-led-panasonic-th-32c300v-32-inches-hd-100hz-bmr/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftks25evmvrks25ebvmv-1-chieu-inverter-9000btu/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-br304msvn-296-lit-2-canh-ngan-da-duoi/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-185pg-185-lit/
http://dienmaynguoiviet.com/amply-dalton-da-7500a/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-168s-sl-165-lit/
http://dienmaynguoiviet.com/smart-tivi-samsung-32-inch-ua32k5500-full-hd-50hz/
http://dienmaynguoiviet.com/amply-paramax-sa-666xp/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftxd35dvmvrxd35dvmv-2-chieu-inverter-12000btu/
http://dienmaynguoiviet.com/tu-lanh-hitachi-r-z400eg9-335-lit/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftkd71gvmvrkd71gvmv-1-chieu-inverter-27000btu/
http://dienmaynguoiviet.com/tivi-led-panasonic-th-43cs600v-43-inch-100hz/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-9000btu-1-chieu-ns-c09sk15/
http://dienmaynguoiviet.com/dieu-hoa-daikin-fte35lv1vre35lv1v-1-chieu-12000btu/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-2-chieu-cucs-a18pkh-8-18000btu/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftkd25gvmvrkd25gvmv-1-chieu-inverter-9000btu/
http://dienmaynguoiviet.com/dieu-hoa-1-chieu-9000btu-lg-s09ena/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-cucs-kc18qkh-8-1-chieu-18000btu/
http://dienmaynguoiviet.com/smart-tivi-lg-43uh617t-43-inch-4k-100hz/
http://dienmaynguoiviet.com/amply-karaoke-dalton-da-9000xg/
http://dienmaynguoiviet.com/may-giat-long-dung-samsung-8kg-wa80h4000sw1sv/
http://dienmaynguoiviet.com/amply-karaoke-dalton-da-4500a/
http://dienmaynguoiviet.com/tu-lanh-funiki-fr-148cd-140-lit-ngan-da-tren/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-170s-sl-165-lit-2-canh/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bj186ssvn-167-lit-2-canh/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftkd35hvmvrkd35hvmv-1-chieu-inverter-12000btu/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-l205ps-2-canh-205-lit/
http://dienmaynguoiviet.com/amply-karaoke-belco-a-868/
http://dienmaynguoiviet.com/tivi-panasonic-smart-75-inch-th-75ex750v-4k-hdr/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt38feakdsl-sv-370-lit/
http://dienmaynguoiviet.com/smart-tivi-samsung-ua55ru7200-55-inch-4k/
http://dienmaynguoiviet.com/dieu-hoa-daikin-1-chieu-inverter-24000btu-ftks71gvmvrks71gvmv/
http://dienmaynguoiviet.com/loa-dalton-ps-3060/
http://dienmaynguoiviet.com/tu-lanh-funiki-fr-125is-125-lit-ngan-da-tren/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bk266snvn-264-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt19m300bgssv-208-lit/
http://dienmaynguoiviet.com/tu-lanh-toshiba-gr-s21vpb-s-186-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/tu-lanh-sanyo-aqr-u185an-165-lit-ngan-da-tren/
http://dienmaynguoiviet.com/tai-nghe-bluetooth-lg-hbs-510/
http://dienmaynguoiviet.com/tivi-lg-32lh512d-32-inch-hd/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-l222bf-225-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/android-tivi-sony-49-inch-kd-49x8000d-4k/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bm229ssvn-188l-2-canh/
http://dienmaynguoiviet.com/dieu-hoa-tcl-rvsc22kds-1-chieu-22000btu/
http://dienmaynguoiviet.com/smart-tivi-sony-55-inch-kd-55x8500d/
http://dienmaynguoiviet.com/smart-tivi-sony-75-inch-kd-75x8500d-android-4k/
http://dienmaynguoiviet.com/tu-lanh-toshiba-gr-t39vubzn-330-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-c09tl-1-chieu-9000btu/
http://dienmaynguoiviet.com/dau-karaoke-acnos-sk19/
http://dienmaynguoiviet.com/dieu-hoa-samsung-ar09hvfsbwknsv-1-chieu-inverter-9000btu/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-cucs-kc18pkh-8-1-chieu-18000btu/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-l275bs-2-canh-205-lit-ngan-da-tren/
http://dienmaynguoiviet.com/may-giat-lg-fc1409s2w-9-kg/
http://dienmaynguoiviet.com/tivi-lg-43lh600t-43-inch-smart-tv-full-hd/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-255pg-253-lit/
http://dienmaynguoiviet.com/smart-tivi-panasonic-th-40fs500v-40-inch-full-hd/
http://dienmaynguoiviet.com/may-giat-electrolux-ewf7525dgwa-inverter-75-kg/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-am-tran-cassette-nt-a1836-2-chieu/
http://dienmaynguoiviet.com/tv-uhd-4k-lg-65uf860t-65-inch-3d-smart-tv-100hz/
http://dienmaynguoiviet.com/smart-tivi-tcl-50-inch-4k-l50p62-uf/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt29farbdutsv-302-lit/
http://dienmaynguoiviet.com/smart-tivi-tcl-l55s6000-55-inch-full-hd/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-270d-sl-271-lit/
http://dienmaynguoiviet.com/dieu-hoa-daikin-2-chieu-inverter-12000btu-ftxs35gvmvrxs35gvmv/
http://dienmaynguoiviet.com/smart-tivi-samsung-32-inch-ua32m5500-full-hd/
http://dienmaynguoiviet.com/smart-tivi-panasonic-th-40ds500v-40-inch-full-hd/
http://dienmaynguoiviet.com/dieu-hoa-samsung-as12twqnxea-1-chieu-12000btu/
http://dienmaynguoiviet.com/smart-tivi-tcl-l49z2-49-inch-4k/
http://dienmaynguoiviet.com/dieu-hoa-tu-dung-nagakawa-2-chieu-28000btu-np-a28dl/
http://dienmaynguoiviet.com/top-4-smart-tivi-tcl-55-inch-gia-tot-thang-32022/
http://dienmaynguoiviet.com/internet-tivi-sony-kdl-49w660e-49-inch/
http://dienmaynguoiviet.com/tivi-led-tcl-l40d2790-40-inch-internet-tv/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-c09it-1-chieu-inverter-9000btu/
http://dienmaynguoiviet.com/tu-lanh-2-canh-panasonic-nr-br344msvn-342-lit/
http://dienmaynguoiviet.com/android-tivi-oled-sony-4k-65-inch-kd-65a1/
http://dienmaynguoiviet.com/tu-lanh-aqua-aqr-145bn-130-lit/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bl267vsv1-234-lit/
http://dienmaynguoiviet.com/internet-tivi-sony-kd-49x7000e-49-inch-4k/
http://dienmaynguoiviet.com/smart-tivi-sony-65-inch-kd-65x8500e-4k/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-l205bs-2-canh-205l/
http://dienmaynguoiviet.com/tivi-lg-32lh570d-32-inch-hd/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-225bf-225-lit-2-canh-inverter/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftyn50jxv1vryn50cjxv1v-2-chieu-r410-18000btu/
http://dienmaynguoiviet.com/tivi-led-lg-43uh650t-43-inch-smart-tv-4k/
http://dienmaynguoiviet.com/tai-nghe-bluetooth-lg-hbs-1120/
http://dienmaynguoiviet.com/smart-tivi-lg-70uh635t-70-inch-4k-100hz/
http://dienmaynguoiviet.com/tu-lanh-lg-gn-155pg-2-canh-155-lit/
http://dienmaynguoiviet.com/quat-lam-mat-honeywell-tc10pe/
http://dienmaynguoiviet.com/dieu-hoa-funiki-sbc12spc12-1-chieu-12000btu/
http://dienmaynguoiviet.com/internet-tivi-sony-kdl-43w750d-43-inch-full-hd/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-270e-pk-2-canh-271-lit/
http://dienmaynguoiviet.com/smart-tivi-samsung-ua55ru8000-55-inch-4k/
http://dienmaynguoiviet.com/dieu-hoa-tu-dung-nagakawa-np-c50dl-1-chieu-50000btu/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-193e-wh-2-canh-180l-ngan-da-tren/
http://dienmaynguoiviet.com/tu-lanh-samsung-451-lit-rt46k6836slsv-ngan-da-tren/
http://dienmaynguoiviet.com/tv-lg-24lf450d-24-inch-led-hd-ready-50hz/
http://dienmaynguoiviet.com/may-giat-samsung-addwash-ww85k54e0uw/sv-8.5kg-inverter/
http://dienmaynguoiviet.com/smart-tivi-sony-kd-75x9000e-75-inch-4k/
http://dienmaynguoiviet.com/tivi-led-lg-55uh650t-smart-tv-4k/
http://dienmaynguoiviet.com/tivi-led-panasonic-th-32c500v-32-inches-hd-100hz/
http://dienmaynguoiviet.com/tu-lanh-electrolux-etb3500pe-rvn-2-canh-350-lit/
http://dienmaynguoiviet.com/dieu-hoa-tu-dung-nagakawa-2-chieu-100000btu-np-a100dl/
http://dienmaynguoiviet.com/tu-lanh-hitachi-r-v400pgv3dsls-inverter-335-lit/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bk306gsvn-296-lit/
http://dienmaynguoiviet.com/may-giat-samsung-digital-inverter-cua-truoc-ww80j54e0bw/sv-8kg/
http://dienmaynguoiviet.com/may-giat-long-dung-lg-wf-d1417dd-14kg/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-227p-hs-222-lit/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-211e-sl-2-canh-196-lit/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt22m4033s8sv-236-lit/
http://dienmaynguoiviet.com/tu-lanh-toshiba-gr-s21vpb-ds-186-lit-2-canh-ngan-da-tren/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-175e-dss-ngan-da-tren-165-lit/
http://dienmaynguoiviet.com/smart-tivi-lg-55uh770t-55-inch-4k/
http://dienmaynguoiviet.com/dieu-hoa-daikin-2-chieu-inverter-9000btu-ftxs25gvmvrxs25gvmv/
http://dienmaynguoiviet.com/tu-lanh-toshiba-gr-tg41vpdzxk-2-canh-359-lit/
http://dienmaynguoiviet.com/may-giat-long-ngang-panasonic-na-128vx6lvt/
http://dienmaynguoiviet.com/may-giat-lg-inverter-fc1475n5w2-75-kg/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-217p-sl-2-canh-196l-ngan-da-tren/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-bm179ssvn-152-lit-2-canh/
http://dienmaynguoiviet.com/dieu-hoa-am-tran-nagakawa-nt-c3636s-36000btu/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-inverter-12000btu-cu/cs-pu12vkh-8/
http://dienmaynguoiviet.com/tu-lanh-hitachi-r-h350pgv4sls-2-canh-290-lit/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-1-chieu-12000btu-cucs-kc12qkh-8/
http://dienmaynguoiviet.com/tivi-sony-kdl-48w650d-internet-48-inch/
http://dienmaynguoiviet.com/tivi-led-tcl-l48d2790-48-inch-internet-tv/
http://dienmaynguoiviet.com/may-giat-samsung-85-kg-wa85j5712sgsv/
http://dienmaynguoiviet.com/may-giat-thong-minh-la-gi/
http://dienmaynguoiviet.com/dieu-hoa-tu-dung-nagakawa-np-c28dl-1-chieu-28000btu/
http://dienmaynguoiviet.com/Smart-Tivi-LG-43UK6340PTF-43-inch-4K/
http://dienmaynguoiviet.com/tu-lanh-electrolux-etb3200pe-rvn-2-canh-320-lit/
http://dienmaynguoiviet.com/internet-tivi-sony-kdl-32w610e-32-inch/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-a12tl-12000btu-2-chieu/
http://dienmaynguoiviet.com/nen-lap-dieu-hoa-nao-cho-phong-co-tre-nho/
http://dienmaynguoiviet.com/dieu-hoa-funiki-fc24m-1-chieu-24000btu/
http://dienmaynguoiviet.com/dieu-hoa-daikin-1-chieu-inverter-12000btu-ftks35gvmvrks35gvmv/
http://dienmaynguoiviet.com/dieu-hoa-funiki-sbc24spc24-1-chieu-24000btu/
http://dienmaynguoiviet.com/loa-karaoke-cao-cap-paramax-p-1000/
http://dienmaynguoiviet.com/tivi-panasonic-th-32d410v-32-inch-hd/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-cu/cs-xpu18wkh-8b-inverter-18000btu/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-cucs-u12rkh-8-1-chieu-inverter-12000btu/
http://dienmaynguoiviet.com/dieu-hoa-electrolux-esm12crf-d3-1-chieu-12000btu/
http://dienmaynguoiviet.com/loa-bluetooth-lg-pk5/
http://dienmaynguoiviet.com/android-tivi-sony-kd-43x7500h-43-inch-4k/
http://dienmaynguoiviet.com/tv-super-uhd-4k-lg-79uf950t-79-inch-smart-tv-200hz/
http://dienmaynguoiviet.com/tivi-lg-43-inch-43lk5000pta-full-hd/
http://dienmaynguoiviet.com/dieu-hoa-panasonic-inverter-18000btu-cu/cs-pu18vkh-8/
http://dienmaynguoiviet.com/smart-tivi-panasonic-th-49es500v-49-inch-full-hd/
http://dienmaynguoiviet.com/may-giat-lg-wf-s8419fs-long-dung-84kg/
http://dienmaynguoiviet.com/smart-tivi-lg-55-inch-oled55b6t-4k-hdr/
http://dienmaynguoiviet.com/tu-lanh-lg-gr-l502sd-438-lit-inverter-2-canh/
http://dienmaynguoiviet.com/smart-tivi-lg-32lm630bptb-32-inch-hd/
http://dienmaynguoiviet.com/android-tivi-tcl-49s6500-49-inch-full-hd/
http://dienmaynguoiviet.com/tu-lanh-panasonic-234-lit-nr-bl267psvn-2-canh/
http://dienmaynguoiviet.com/may-giat-lg-wf-d1219dd-long-dung-12kg/
http://dienmaynguoiviet.com/tv-super-uhd-4k-lg-65uf950t-65-inch-smart-tv-200hz/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-198p-st-180-lit-ngan-da-tren/
http://dienmaynguoiviet.com/smart-tivi-sony-50-inch-kdl-50w660f-full-hd/
http://dienmaynguoiviet.com/tivi-tcl-43-inch-l43s62t/
http://dienmaynguoiviet.com/tu-lanh-panasonic-nr-ba188psvn-167-lit/
http://dienmaynguoiviet.com/smart-tivi-lg-43uh610t-43-inch-4k-100hz/
http://dienmaynguoiviet.com/smart-tivi-tcl-4k-49-inch-49c2l-ap/
http://dienmaynguoiviet.com/smart-tivi-sony-49-inch-kd-49x8000e-4k/
http://dienmaynguoiviet.com/smart-tivi-samsung-ua55k5500-55-inches-100hz/
http://dienmaynguoiviet.com/android-tivi-oled-sony-4k-55-inch-kd-55a1/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt29k5012s8sv-299-lit-inverter-ngan-da-tren/
http://dienmaynguoiviet.com/dieu-hoa-nagakawa-ns-a24tk-2-chieu-24000btu-quat-gio-3-cap-do-man-hien-thi-da-mau/
http://dienmaynguoiviet.com/tu-lanh-sharp-sj-197p-ch-2-canh-180l-ngan-da-tren/
http://dienmaynguoiviet.com/loa-thanh-samsung-hw-j551xv-21-ch/
http://dienmaynguoiviet.com/smart-tivi-panasonic-th-43es600v-43-inch-full-hd/
http://dienmaynguoiviet.com/tivi-samsung-ua48j5000-48-inches-full-hd/
http://dienmaynguoiviet.com/dieu-hoa-tcl-rvsc12kds-1-chieu-12000btu/
http://dienmaynguoiviet.com/internet-tivi-sony-kdl-40w650d-40-inch-full-hd/
http://dienmaynguoiviet.com/smart-tivi-sony-kd-55x9000e-55-inch-4k/
http://dienmaynguoiviet.com/tu-lanh-lg-gr-c572mg-449-lit/
http://dienmaynguoiviet.com/android-tivi-panasonic-th-49fx650v-49-inch-4k/
http://dienmaynguoiviet.com/dieu-hoa-daikin-ftkd60gvmvrkd60gvmv-1-chieu-inverter-21200tbu/
http://dienmaynguoiviet.com/tu-lanh-samsung-rt20farwdsasv-203-lit/
http://dienmaynguoiviet.com/dieu-hoa-daikin-2-chieu-inverter-12000btu-ftxd35hvmvrxd35hvmv/
http://dienmaynguoiviet.com/dieu-hoa-electrolux-esm09crf-d4-9000btu/
http://dienmaynguoiviet.com/dieu-hoa-samsung-ar18hcfssurnsv-1-chieu-18000btu/
http://dienmaynguoiviet.com/dieu-hoa-Funiki-SH09MMC-2-chieu-9000BTU/";

        $codess = explode(PHP_EOL, $code);

        return $codess;          

    } 

    public function crawl1()
    {
        $post = Post::orderBy('updated_at', 'desc')->take(40)->get();

        return response()->view('sitemap.index', [
            'post' => $post,
        ])->header('Content-Type', 'text/xml');
    }



   

    public function getLink()
    {

        $codes =  $this->crawls();

        $strings = explode('https', $codes);

        $blog = [];

        foreach ($strings as $key => $value) {

            $link = 'https'.$value;
            
            if($key !=0){

                $html = file_get_html(trim($link));

                if(strip_tags($html->find('#page-view', 0))=='blog'){

                    array_push($blog, $link);

                }
                
            }
        }

        return($blog);

    }

    public function getLinks()
    {
        

        for($i=10; $i<1525; $i++){
            $product = post::find($i);

            $post->link = convertSlug($product->title);

            $post->save();

          
        }

        echo "thanh cong";

    }


    

    public function getMetaProducts()
    {
        for($i=4204; $i<4573; $i++){

            $link = product::find($i);


            if(isset($link)){


                $url = $link->Link;

                $urls = 'http://dienmaynguoiviet.com/'.$url.'/';

        
                $html = file_get_html(trim($urls));

                $keyword = htmlspecialchars($html->find("meta[name=keywords]",0)->getAttribute('content'));
                $content = $html->find("meta[name=description]",0) ->getAttribute('content');
                $title   = $html-> find("title",0)-> plaintext;
            
                $meta   = new metaSeo();

                $meta->meta_title =$title; 
                $meta->meta_content =$content; 
                $meta->meta_key_words = strip_tags($keyword); 
                $meta->meta_og_title =$title; 
                $meta->meta_og_content =$content; 

                $meta->save();

                $link->Meta_id = $meta['id'];

                $link->save();


            }


        }   
        echo "thanh cong";

    }




     public function post()
     {

        for ($i = 3; $i<1514; $i++) {

            $link = post::find($i);

            $links = $link->link;

           

            $html = file_get_html('https://dienmaynguoiviet.vn/'.trim($links).'/');
           
            $content =  str_replace(html_entity_decode($html->find('.emtry_content h2', 0)), '', html_entity_decode($html->find('.emtry_content', 0))) ; 

            // lay anh trong bai viet

             preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $content, $matches);

            $arr_change = [];

            $time = time();

            $regexp = '/^[a-zA-Z0-9][a-zA-Z0-9\-\_]+[a-zA-Z0-9]$/';

            if(isset($matches[1])){
                foreach($matches[1] as $value){
                   
                    $value = 'https://dienmaynguoiviet.vn/'.str_replace('../','', $value);

                    $arr_image = explode('/', $value);

                    if($arr_image[0] != env('APP_URL')){

                        $file_headers = @get_headers($value);

                        if($file_headers[0] == 'HTTP/1.1 200 OK') 
                        {

                            $infoFile = pathinfo($value);

                           if(!empty($infoFile['extension'])){

                                if($infoFile['extension']=='png'||$infoFile['extension']=='jpg'||$infoFile['extension']=='web'){

                                    $img = '/images/posts/crawl/'.basename($value);

                                    file_put_contents(public_path().$img, file_get_contents($value));

                                 
                                    array_push($arr_change, 'images/posts/crawl/'.basename($value));
                                }   
                            }

                            
                        }
                       
                    }
                    
                }
            }

        }    
     

        echo "thanh cong";   
    }

    
    function filter(){

        for ($i=243; $i < 2845; $i++) { 

            $product = product::find($i);

            if(!empty($product->Link) && strpos(trim($product->Link), 'tivi')){


                $groupProduct = groupProduct::find(1);

                if($groupProduct->product_id==''){

                    $datas_ar = [];

                    $groupProduct->product_id=json_encode($datas_ar);
                }
                else{
                    $groupProduct->product_id = $groupProduct->product_id;
                }

                $data_product = json_decode($groupProduct->product_id);



                array_push($data_product, $i);

                array_unique($data_product);

                $data_product = json_encode($data_product);

                $groupProduct->product_id = $data_product;


                $groupProduct->save();

            }
           

            
        }
        echo "thanh cong";
    }

    
    public function getImagePost()
    {

        for($i=4172; $i<4174; $i++){

            $posts = product::find($i);

            if(isset($posts)){

                $link = 'https://dienmaynguoiviet.vn/'.$posts->Link;

                

                $html = file_get_html(trim($link));

                $image = $html->find('.img-detail img');


                

                for($ids = 0; $ids<count($image); $ids++){

                    $images = $html->find('.img-detail img', $ids)->src;

                   
                    $images = 'https://dienmaynguoiviet.vn/'. $images;

                   

                    $file_headers = @get_headers('https://dienmaynguoiviet.vn/'.$images);



                    if($file_headers[0] == 'HTTP/1.1 200 OK'){

                        $img  = '/uploads/product/crawl/child/'.basename($images);


                        file_put_contents(public_path().$img, file_get_contents($images));




                        $input['image'] = $img;

                        $input['link'] = $img;

                        $input['product_id'] = $i;

                        $input['order'] = 0;


                        $images_model = new image();

                        $images_model = $images_model->create($input);

                      

                    }
                }
            }
            else{
                print_r($posts);
            }
        }
        echo "thanh cong";

    }

    public function selectedCode()
    {


       
            $pass =14;

       

            $code = filter::select('value')->where('id', $pass)->get();


            $codes = json_decode($code[0]->value);

            $data = [];


            
            foreach ( $codes  as $key => $values) {

                $numbers = array_filter($values, function($var){
                    return $var>243;
                    
                });

                $ProductSku = array_map(function($n){

                    return(products1::find($n)->ProductSku);

                }, $numbers);

                if(!empty($ProductSku)){
                    $data[$key] =$ProductSku;

                }
            
            }

            dd($data);

            $datasss = [];

            foreach($data as $key => $datas){

              

                $ProductSku = array_map(function($n){

                    $datass = product::where('ProductSku', $n)->first();

                    return($datass->id);

                }, $datas);


                $datasss[$key] = array_values($ProductSku);

             }

             $finter = filter::find($pass);

             $result = json_encode($datasss);

             $finter->value =  $result;

             $finter->save();
          
        echo "thanh cong";


    
    }

   



    public function removelink()
    {
       
            // $arr= product::select('id', 'ProductSku')->get()->pluck('ProductSku')->toArray();

            // $unique = array_unique($arr); 
            // $dupes = array_diff_key( $arr, $unique ); 

            // print_r($dupes);

            
        // echo "thành công";

        $arr = product::select('id', 'ProductSku')->get()->pluck('ProductSku')->toArray();

        $unique = array_unique($arr); 
        $dupes = array_diff_key($arr, $unique); 

        $dupess= array_unique($dupes);

        
     

        foreach($dupess as  $dupesss){

          
            $dataId = product::Where('ProductSku', $dupesss)->first();

            $product = $dataId::find($dataId->id)->delete();

        }

        echo "thanh cong";

    }
   
}
