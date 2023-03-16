<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Repositories\productRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\groupProduct;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\hotProduct;
use Flash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Storage;

use  App\Http\Controllers\Frontend\categoryController;

use Illuminate\Support\Facades\Cache;
use App\Models\searchkey;
use Response;
use App\Models\historyPd;

use App\Models\metaSeo ;

class productController extends AppBaseController
{
    /** @var  productRepository */
    private $productRepository;

    public function __construct(productRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $products = product::Orderby('updated_at', 'desc')->paginate(10);
        
        return view('products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create');
    }

    

    /**
     * Store a newly created product in storage.
     *
     * @param CreateproductRequest $request
     *
     * @return Response
     */
    public function store(CreateproductRequest $request)
    {
        $input = $request->all();


        if(empty($input['Link'])){

            $input['Link'] =  str_replace('/', '', convertSlug($input['Name']));
        }

        if(empty($input['Quantily'])){

            $input['Quantily'] = 0;
        }

        if(!empty($input['Price'])){

            $input['Price'] = str_replace(',', '', $input['Price']);
            $input['Price'] = str_replace('.', '', $input['Price']);
        }


        if(!empty($input['InputPrice'])){

            $input['InputPrice'] = str_replace(',', '', $input['InputPrice']);
            $input['InputPrice'] = str_replace('.', '', $input['InputPrice']);
        }

        if(!empty($input['manuPrice'])){

            $input['manuPrice'] = str_replace(',', '', $input['manuPrice']);
            $input['manuPrice'] = str_replace('.', '', $input['manuPrice']);
        }

        if(!empty($input['GiftPrice'])){

            $input['GiftPrice'] = str_replace(',', '', $input['GiftPrice']);
            $input['GiftPrice'] = str_replace('.', '', $input['GiftPrice']);
        }

        if(empty($input['Group_id'])){

            $input['Group_id'] = 0;

        }    

        

        if(!empty($input['Group_id'])){

            $input['Group_id'] = 0;

        }    

        if ($request->hasFile('Image')) {

            $file_upload = $request->file('Image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/product', $name, 'ftp');

            Storage::disk('ftp')->put($filePath, fopen($file_upload, 'r+'));
      
            $input['Image'] = $filePath;
        }

        //add meta seo cho product

        $meta_title = $input['ProductSku'].', '.$input['Name'].' giá rẻ, Trả góp 0%';

        $meta_content = 'Mua '.$input['Name'].' giá rẻ. Miễn phí giao hàng & Lắp đặt. Đổi lỗi trong 7 ngày đầu. Liên hệ hotline 0247.303.6336 để mua hàng và biết thêm thông tin chi tiết'; 

        $meta_model = new metaSeo();

        $meta_model->meta_title =$meta_title;

        $meta_model->meta_content =$meta_content;

        $meta_model->meta_og_content =$meta_content;

        $meta_model->meta_og_title =$meta_title;

        $meta_model->meta_key_words =$meta_title;

        $meta_model->save();

        $input['Meta_id'] = $meta_model['id'];

        $input['user_id'] =  Auth::user()->id;

        

        $product = $this->productRepository->create($input);

        return redirect()->route('group-product-selected', $product['id']);
        
        // return Redirect()->back()->with('id', $product['id']);

    }

    /**
     * Display the specified product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified product in storage.
     *
     * @param int $id
     * @param UpdateproductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproductRequest $request)
    {
        $product = $this->productRepository->find($id);

        $input  = $request->all();


        if(empty($product->Link)){

            $input['Link'] = convertSlug($input['Name']);
        }

    
        if(empty($input['Quantily'])){

            $input['Quantily'] = 0;
        }


        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        if(!empty($input['Price'])){

            $input['Price'] = str_replace(',', '', $request->Price);
            $input['Price'] = str_replace('.', '', $input['Price']);
        }


        if(Auth::user()->id==4 || Auth::user()->id==6){
            if(!empty($input['InputPrice'])){

                $input['InputPrice'] = str_replace(',', '', $input['InputPrice']);
                $input['InputPrice'] = str_replace('.', '', $input['InputPrice']);
            }
        }
        if(!empty($input['manuPrice'])){

            $input['manuPrice'] = str_replace(',', '', $input['manuPrice']);
            $input['manuPrice'] = str_replace('.', '', $input['manuPrice']);
        }

        if(!empty($input['GiftPrice'])){

            $input['GiftPrice'] = str_replace(',', '', $input['GiftPrice']);
            $input['GiftPrice'] = str_replace('.', '', $input['GiftPrice']);
        }
            

        if(!empty($input['Group_id'])){

            $input['Group_id'] = 0;

        }    


        if ($request->hasFile('Image')) {

            $file_upload = $request->file('Image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/product', $name, 'ftp');

            $input['Image'] = $filePath;
        }

        $input['user_id'] =  Auth::user()->id;

        if(!empty($input['Price'])){
             if($product->Price != $input['Price']){

                $products_history   = new historyPd();
                $products_history->product_id = $product->id;
                $products_history->user_id = Auth::user()->id;

                $products_history->price_old =  $product->Price;

                $products_history->save();

            }
        }

       

         
        $product = $this->productRepository->update($input, $id);

        Flash::success('Product updated successfully.');

        return redirect()->back();
    }

    /**
     * Remove the specified product from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }

    public function FindbyNameOrModel(Request $request)
    {
        $clearData = trim($request->search);

        $data      = strip_tags($clearData);

        $data = strtoupper($data);

        $resultProduct = [];

        $find_first = Product::select('id')->where('Name','LIKE', '%'. $data .'%')->OrWhere('ProductSku', 'LIKE', '%' . $data . '%')->OrderBy('id', 'desc')->take(50)->get()->pluck('id');

    
        if(isset($find_first)){

            foreach ($find_first as  $value) {

                array_push($resultProduct, $find_first);
            }


        }

        
        if(isset($resultProduct)){

            $products = Product::whereIn('id', $resultProduct)->paginate(50);

            return view('products.index')
            ->with('products', $products);

        }
        else{
           Flash::error('Không tìm thấy sản phẩm, vui lòng tìm kiếm lại"');

            return redirect(route('products.index'));
        }
            
        
    }

    public function selectProductByCategory($cate_id)
    {
       // $products = Product::where('Group_id', $cate_id)->orderBy('id', 'desc')->paginate(10);

        $Group_product = groupProduct::find($cate_id);


        $Group_product = json_decode($Group_product->product_id);


        $products = Product::whereIn('id', $Group_product)->orderBy('id', 'desc')->paginate(10);


        return view('products.index')
            ->with('products', $products);

        if (empty($product)) {

            Flash::error('Product not found');

            return redirect(route('products.index'));
        }


    }

    public function editFastPrice(Request $request)
    {
        $price = $request->price;

        $price = str_replace(',', '', $price);

        $price = str_replace('.', '', $price);

        $product_id = $request->product_id;

        $product = product::find($product_id);

        $price_old = $product->Price;


        $product->Price = $price;
        $product->user_id = Auth::user()->id;

        $products_history   = new historyPd();
        $products_history->product_id = $product_id;
        $products_history->user_id = Auth::user()->id;

        $products_history->price_old =  $price_old;

        $products_history->save();

    

        $product->save();
        return response('thanh cong');

    }

    public function getPDviewer(Request $request)
    {
        $datas = json_decode($request->viewerPD);

        

        if(count($datas)>0){

           

            $product_data = product::select('Image', 'Name', 'id', 'Link')->whereIn('id',$datas)->take(3)->get();

            return view('frontend.ajax.viewer-compare-product',compact('product_data'));

        }

    }

     public function editFastQualtity(Request $request)
    {

        $qualtity = $request->qualtity;
        $product_id = $request->product_id;
        $product = product::find($product_id);
        $product->Quantily = $qualtity;
        $product->user_id = Auth::user()->id;

        $product->save();
        return response('thanh cong');

    }

    public function FindbyNameOrModelOfFrontend(Request $request)
    {
        $clearData = trim($request->key);

        $clearData = strip_tags($clearData);

        $search = $clearData;

        if($search === 'oled'){
            $search = 'tivi oled';
        }

        if(!empty($search)){

            $search = str_replace('dieu hoa', 'Điều hòa', $search);

            $search = str_replace('tu dong', 'Tủ đông', $search);

            $search = ucfirst($search);


            if(!Cache::has('product_search')){

                $productss = product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku')->where('active', 1)->get();

                Cache::forever('product_search',$productss);

            }

            $data =  Cache::get('product_search');


            $resultProduct = [];

            $numberdata = 0;

            $product = collect($data)->filter(function ($item) use ($search) {
                //check loi empty ProductSku
                if(empty($search)){
                   return false;
                }
                return false !== strpos($item->ProductSku, $search);
            });

            if($product->count()==0){

                $product = collect($data)->filter(function ($item) use ($search) {

                    if(empty($search)){

                       return false;
                    }
                    return false !== strpos($item->Name, $search);
                   
                });

                // search khi tên có viết hoa

                if($product->count()==0){

                    if(empty($search)){

                       return false;
                    }

                    $product = collect($data)->filter(function ($item) use ($search) {
                        return false !== stristr($item->Name, $search);
                    });


                    if($product->count()==0){

                        // nếu không có thì search bằng thư viện FullTextSearch

                        if($product->count()==0){
                            // search bằng thư viện FullTextSearch
                            $product = product::FullTextSearch('Name', $search)->select('id', 'Name', 'Price', 'Link', 'Image')->get();
                            
                            if($product->count()==0){
                                $product = product::where('Name', 'like', '%'.$search.'%')->get();
                            }
                        } 
                       
                    }
                }
            }

            $find_first = $product->take(50)->sortByDesc('id')->pluck('id');

            if(isset($find_first)){

                 $numberdata = count($find_first);

                foreach ($find_first as  $value) {

                    array_push($resultProduct, $find_first);
                }

            }

            $page_search = 'filterFe';

           
            if(isset($resultProduct) && !empty($resultProduct[0])){

                $resultProduct = $resultProduct[0]->toArray();

                $data = Cache::get('product_search')->whereIn('id', $resultProduct)->forPage(1, 20);

                return view('frontend.category',compact('data','numberdata','page_search'));
               

            }
            else{
                $data = [];
                return view('frontend.category', compact('data', 'numberdata', 'page_search'));
                // Flash::error('Không tìm thấy sản phẩm, vui lòng tìm kiếm lại"');
            }

        }


    }

    public function searchPdCompare(Request $request)
    {


        $clearData = trim($request->search);

        $clearData = strip_tags($clearData);

        $search = $clearData;

        $product = product::where('Name', 'like', '%'.$search.'%')->Orwhere('ProductSku', $search)->first();

        return  $product;
    }

    public function filterProduct(Request $request)
    {
        $ar_pd = json_decode($request->ar_product_id);

        // $ar_pd = [4573,4673,4636];

        $ar_gr = [];

        if(isset($ar_pd)){

            foreach ($ar_pd as $key => $value) {
               $gr =  new categoryController();
               $gr_id = $gr->get_Group_Product($value);

               array_push($ar_gr, $gr_id[0]);
            }
        }
        $unique = array_unique($ar_gr);

       
        if(count($unique)==1){
            return $unique[0];
        }
        return 0;
    }

    public function imagecontent($id)
    {
        return view('products.image', compact('id'));
    }

    public function sosanh()
    {
        $data = $_GET['list'];
       

        if(empty($data)){
            return abort('404');
        }
        else{
            $data = explode(',', $data);
            if(!isset($data)||count($data)>4){
                return abort('404');
            }
        }
        return view('frontend.sosanh', compact('data'));
        
    }


    public function search()
    {
        $array['ProductSku'] = 'UA50AU9000KXXVS';

        $array['Price'] = '500';
        $search = product::where($array)->get();
        print_r($search);
    }

    public function viewHistoryPD($id)
    {
        $data = historyPd::where('product_id', $id)->OrderBy('id', 'desc')->take(6)->get();

        if($data->count()>0){
            return  view('products.history', compact('data'));
        }
        else{
            return abort('404');
        }

    }

    
}
