<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreategroupProductRequest;
use App\Http\Requests\UpdategroupProductRequest;
use App\Repositories\groupProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\metaSeo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

use App\Models\groupProduct;

class groupProductController extends AppBaseController
{
    /** @var  groupProductRepository */
    private $groupProductRepository;

    public function __construct(groupProductRepository $groupProductRepo)
    {
        $this->groupProductRepository = $groupProductRepo;
    }

    /**
     * Display a listing of the groupProduct.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $groupProducts = $this->groupProductRepository->paginate(10);


        return view('group_products.index')
            ->with('groupProducts', $groupProducts);
    }

    /**
     * Show the form for creating a new groupProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('group_products.create');
    }

    /**
     * Store a newly created groupProduct in storage.
     *
     * @param CreategroupProductRequest $request
     *
     * @return Response
     */
    public function store(CreategroupProductRequest $request)
    {
        $input = $request->all();

        if($input['group_product_id']==0){

            $input['level'] = 0;

            $input['parent_id'] = 0;

        }

        if(empty($input['link'])){

            $input['link'] = convertSlug($input['name']);
        }

        $meta_model = new metaSeo();

        $meta_model->meta_title = '';

        $meta_model->meta_content ='';

        $meta_model->meta_og_content ='';

        $meta_model->meta_og_title ='';

        $meta_model->meta_key_words ='';

        $meta_model->save();

       
        $input['Meta_id'] = $meta_model['id'];

        $groupProduct = $this->groupProductRepository->create($input);

        Flash::success('Group Product saved successfully.');

        return redirect(route('groupProducts.index'));
    }

    /**
     * Display the specified groupProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $groupProduct = $this->groupProductRepository->find($id);

        if (empty($groupProduct)) {
            Flash::error('Group Product not found');

            return redirect(route('groupProducts.index'));
        }

        return view('group_products.show')->with('groupProduct', $groupProduct);
    }

    /**
     * Show the form for editing the specified groupProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $groupProduct = $this->groupProductRepository->find($id);

        if (empty($groupProduct)) {
            Flash::error('Group Product not found');

            return redirect(route('groupProducts.index'));
        }

        return view('group_products.edit')->with('groupProduct', $groupProduct);
    }

    /**
     * Update the specified groupProduct in storage.
     *
     * @param int $id
     * @param UpdategroupProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategroupProductRequest $request)
    {

        $input = $request->all();

        $groupProduct = $this->groupProductRepository->find($id);

       

        if($input['group_product_id']==0){

            $input['level'] = 0;

            $input['parent_id'] = 0;

        }

        if (empty($groupProduct)) {
            Flash::error('Group Product not found');

            return redirect(route('groupProducts.index'));
        }


        $groupProduct = $this->groupProductRepository->update($input, $id);

        Flash::success('Group Product updated successfully.');

        return redirect(route('groupProducts.index'));
    }

    /**
     * Remove the specified groupProduct from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $groupProduct = $this->groupProductRepository->find($id);

        if (empty($groupProduct)) {
            Flash::error('Group Product not found');

            return redirect(route('groupProducts.index'));
        }

        $this->groupProductRepository->delete($id);

        Flash::success('Group Product deleted successfully.');

        return redirect(route('groupProducts.index'));
    }

    public function showProductIdToUrl($id)
    {
        $Product = product::findOrFail($id);

        return view('group_products.product_selected_group_product', compact('id'));
        
    }

    public function find_Parent($id)
    {

        $ar_parent = [];

        $parent =  groupProduct::find($id);

        $level = $parent->level;

        for($i=0 ;$i<$level; $i++){

            $find = $parent->parent_id;

            $parent = groupProduct::where('id',  $find)->first();


            $ar_parent[$i] = $parent->id;

        }

        return $ar_parent;
    }


    public function deleteChild($id, $product_id)
    {
        $all_product_group =  groupProduct::find($id);

        if( $all_product_group->product_id != ''){

            $data_product_id = json_decode($all_product_group->product_id);

            $findKey = array_search($product_id, $data_product_id);

            array_splice($data_product_id, $findKey, 1);

            $all_product_group->product_id = json_encode($data_product_id);

            $all_product_group->save();

            
        }
    }


    public function showGroupProduct(Request $request)
    {
        $id = $request->id;

        $group = $this->groupProductRepository->find($id);

        $groupActive = $group->active==1?0:1;

        $input['active'] = $groupActive;

        $this->groupProductRepository->update($input, $id);

        Flash::success('Group Product saved successfully.');

        return redirect(route('groupProducts.index'));
    }

    public function removeGrPD(Request $request)
    {
        $id = $request->id;

        // check để xóa

        $check = $this->groupProductRepository->find($id);

        $level = (int)$check->level+1;



        $check_child = groupProduct::where('level', $level)->where('id', $id)->get()->toArray();

        

        if(empty(json_decode($check->product_id))&& $check_child==null){

            $this->groupProductRepository->delete($id);

            Flash::success('Xóa thành công');
        }
        else{
           
             Flash::error('Không thể xóa Danh mục này, do phát sinh lỗi');

        }
        

        return redirect(route('groupProducts.index'));
    }

   

    public function addGroupProduct(Request $request)
    {
        $id = $request->id;

        $product_id = $request->product_id;

        $active = $request->active;

        // đẩy nhóm con vào nhóm sản phẩm cha

        $id_group = $this->find_Parent($id);

        array_push($id_group, $id);

        if($active==1){

            if(isset($id_group)){

                // nhóm group id của sản phẩm

                foreach ($id_group as $value) {

                    $data_product_id = [];

                    $all_product_group =  groupProduct::find($value);

                    if( $all_product_group->product_id != ''){

                        $data_product_id = json_decode($all_product_group->product_id);

                        
                    }
                    array_push($data_product_id, $product_id);

                    $all_product_group->product_id = json_encode(array_unique($data_product_id));

                    $all_product_group->save();

                }
               

            }
           
        
        }
        // th xóa ko chọn
        else{
            if($active==0){
                $level = groupProduct::find($id)->level;

                if($level==2){

                    $this->deleteChild($id, $product_id);


                } 
                elseif($level==1){

                    // xoa con level =2

                    $all_product_group =  groupProduct::where('parent_id', $id)->where('level', 2)->get()->pluck('id');

                    if(isset($all_product_group)){

                        foreach ($all_product_group as  $value) {

                            $this->deleteChild($value, $product_id);
                            
                            
                        }
                    }

                    // xoa phan tu cha

                    $this->deleteChild($id, $product_id);

                }  

                
                else{

                    // neu level bang 0 

                    $all_product_group_level1 =  groupProduct::where('parent_id', $id)->where('level', 1)->get()->pluck('id'); 

                    if(isset($all_product_group_level1)){

                        foreach($all_product_group_level1 as $value1){

                            $all_product_group =  groupProduct::where('parent_id', $value1)->where('level', 2)->get()->pluck('id');

                            if(isset($all_product_group)){

                                foreach ($all_product_group as  $value) {

                                    $this->deleteChild($value, $product_id);
                                    
                                    
                                }
                            }

                            // xoa phan tu cha

                            $this->deleteChild($value1, $product_id);

                        }

                    }

                    // xoa phan tu level bang 0

                    $this->deleteChild($id, $product_id);
                    
                }

            }


        }
         $product_tick = product::find($product_id);
        $product_tick->updated_at = Carbon::now();
        $product_tick->user_id = Auth::user()->id;
        $product_tick->save();

         return response('thanh cong');


    }
}
