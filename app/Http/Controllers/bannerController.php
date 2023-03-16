<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebannerRequest;
use App\Http\Requests\UpdatebannerRequest;
use App\Repositories\bannerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class bannerController extends AppBaseController
{
    /** @var  bannerRepository */
    private $bannerRepository;

    public function __construct(bannerRepository $bannerRepo)
    {
        $this->bannerRepository = $bannerRepo;
    }

    /**
     * Display a listing of the banner.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $option = empty($request->option)?0:$request->option;
        $banners = $this->bannerRepository->allQuery(['option'=>$option])->orderBy('id','desc')->paginate(10);

        return view('banners.index')
            ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new banner.
     *
     * @return Response
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * Store a newly created banner in storage.
     *
     * @param CreatebannerRequest $request
     *
     * @return Response
     */
    public function store(CreatebannerRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {

            $file_upload = $request->file('image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/banner', $name, 'public');

            $input['image'] = $filePath;
        }

        $banner = $this->bannerRepository->create($input);

        Flash::success('Banner saved successfully.');

        return redirect(route('banners.index'));
    }

    /**
     * Display the specified banner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        return view('banners.show')->with('banner', $banner);
    }

    /**
     * Show the form for editing the specified banner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }
        
        

        return view('banners.edit')->with('banner', $banner);
    }

    /**
     * Update the specified banner in storage.
     *
     * @param int $id
     * @param UpdatebannerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebannerRequest $request)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        

        $input = $request->all();
        
        if ($request->hasFile('image')) {

            $file_upload = $request->file('image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/banner', $name, 'public');

            $input['image'] = $filePath;
        }

        $banner = $this->bannerRepository->update($input, $id);

        $option =  $banner->option;

        Flash::success('Banner updated successfully.');

       

        return redirect(route('banners.index').'?option='.$option);
    }

    /**
     * Remove the specified banner from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        $this->bannerRepository->delete($id);

        Flash::success('Banner deleted successfully.');

        return redirect(route('banners.index'));
    }

    public function activeBanner(Request $request)
    {
        $id  = $request->id;

        $banner = $this->bannerRepository->update(['active'=>$request->active], $id);

        Flash::success('Banner update successfully.');

        return redirect()->back();
    }
}
