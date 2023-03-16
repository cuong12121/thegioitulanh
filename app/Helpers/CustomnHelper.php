<?php

if (!function_exists('_substrs')) {
    function _substrs($str, $length, $minword = 3)
    {
        $sub = '';
        $len = 0;
        foreach (explode(' ', $str) as $word)
        {
            $part = (($sub != '') ? ' ' : '') . $word;
            $sub .= $part;
            $len += strlen($part);
            if (strlen($word) > $minword && strlen($sub) >= $length)
            {
              break;
            }
         }
        return $sub . (($len < strlen($str)) ? '...' : '');
    }
}

if (!function_exists('groupGift')) {
    // id truyền vào là id category của sản phẩm
    function groupGift($id){

        $gift_group = Cache::remember('gift_group'.$id,1000,  function() use($id){
            return DB::table('gift_group')->where('group_product', $id)->get();
        });
        $now = Carbon\Carbon::now();
        $gift = [];

        foreach ($gift_group as  $value) {

            $gifts = Cache::remember('gifts'.$value->group_gift, 10000, function() use ($value) {

                $giftss  = DB::table('group_gift')->where('id', $value->group_gift)->first()??'';

                return $giftss;
            
            });

        
            if(!empty($gifts) && !empty($gifts->start)){
                $start    = new Carbon\Carbon($gifts->start);

                $end     = new Carbon\Carbon($gifts->end);

                if($now->between($start, $end)){

                    $gifts_ar = [$gifts->gift1, $gifts->gift2];
            
                    $gift = DB::table('gifts')->whereIn('id',  $gifts_ar)->get()->toArray();

                    $gift =  ['gift'=>$gift, 'gifts'=>$gifts];

                }
            }

        }
        return $gift;

    }    

}    


if (!function_exists('gift')) {

    function gift($id){

        $now = Carbon\Carbon::now();

        $promotion = '';

        $id_all = Cache::remember('id_checks'.$id, 10000, function() use ($id) {

            $id_alls = DB::table('promotion')->where('id_product', $id)->select('id_product')->get()->first()??'';
            return  $id_alls;
        });


        if(!empty($id_all)){
            $promotion = Cache::remember('promotion'.$id, 10000, function() use ($id) {
                return DB::table('promotion')->where('id_product', $id)->select('id_group_gift', 'start', 'end')->get()->last();
            });

        }


        $gift = [];
    
        if(!empty($promotion) && !empty($promotion->id_group_gift)){

            $gifts = Cache::remember('group_gift__'.$promotion->id_group_gift, 1000, function() use ($promotion) {

                $giftss     = DB::table('group_gift')->where('id', $promotion->id_group_gift)->first()??'';

                return  $giftss;
            
            });

            if(!empty($gifts) && !empty($gifts->start)){

                $start    = new Carbon\Carbon($gifts->start);

                $end     = new Carbon\Carbon($gifts->end);

                if($now->between($start, $end)){

                    $gifts_ar = [$gifts->gift1, $gifts->gift2];

                    $gift = Cache::remember('gifts_id_cache'.$promotion->id_group_gift, 1000, function() use ($gifts_ar) {

                        $gift = DB::table('gifts')->whereIn('id',  $gifts_ar)->get()->toArray()??[];

                        return  $gift;
                    
                    });
            
                    $gift =  ['gift'=>$gift, 'gifts'=>$gifts];

                }

            }
            
        }
        return $gift;
    }

}


if (!function_exists('convertSlug')) {

    function convertSlug($title)
    {
       
        $replacement = '-';
        $map = array();
        $quotedReplacement = preg_quote($replacement, '/');
        $default = array(
            '/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|å/' => 'a',
            '/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|ë/' => 'e',
            '/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|î/' => 'i',
            '/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|ø/' => 'o',
            '/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|ů|û/' => 'u',
            '/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/' => 'y',
            '/đ|Đ/' => 'd',
            '/ç/' => 'c',
            '/ñ/' => 'n',
            '/ä|æ/' => 'ae',
            '/ö/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/ß/' => 'ss',
            '/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
            '/\\s+/' => $replacement,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        );
        //Some URL was encode, decode first
        $title = urldecode($title);
        $map = array_merge($map, $default);
        return strtolower(preg_replace(array_keys($map), array_values($map), $title));

    }
}

if (!function_exists('promotion_product')){

    function promotion_product($id, $now)
    {

        $promotion = App\Models\promotion::where('id_product', $id)->get()->last(); 

        if(!empty($promotion->created_at)){

            $convert_time = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $promotion->updated_at);

            $convert_time = $convert_time->addDays($promotion->time);

            $result_time = $convert_time->diffInHours($now);
        }

        $gift ='';

        if(!empty($promotion->created_at)){

            if(!empty($promotion)&& $result_time>=0&&$promotion->id_gift!=0){
                $gift = App\Models\gift::find($promotion->id_gift);

            }
        }
        return  $gift;

    }  
}      

                
