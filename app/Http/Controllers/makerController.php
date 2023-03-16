<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemakerRequest;
use App\Http\Requests\UpdatemakerRequest;
use App\Repositories\makerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class makerController extends AppBaseController
{
    /** @var  makerRepository */
    private $makerRepository;

    public function __construct(makerRepository $makerRepo)
    {
        $this->makerRepository = $makerRepo;
    }

    /**
     * Display a listing of the maker.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $makers = $this->makerRepository->paginate(16);

        return view('makers.index')
            ->with('makers', $makers);
    }

    /**
     * Show the form for creating a new maker.
     *
     * @return Response
     */
    public function create()
    {
        return view('makers.create');
    }

    /**
     * Store a newly created maker in storage.
     *
     * @param CreatemakerRequest $request
     *
     * @return Response
     */
    public function store(CreatemakerRequest $request)
    {
        $input = $request->all();

        $maker = $this->makerRepository->create($input);

        Flash::success('Maker saved successfully.');

        return redirect(route('makers.index'));
    }

    /**
     * Display the specified maker.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $maker = $this->makerRepository->find($id);

        if (empty($maker)) {
            Flash::error('Maker not found');

            return redirect(route('makers.index'));
        }

        return view('makers.show')->with('maker', $maker);
    }

    /**
     * Show the form for editing the specified maker.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $maker = $this->makerRepository->find($id);

        if (empty($maker)) {
            Flash::error('Maker not found');

            return redirect(route('makers.index'));
        }

        return view('makers.edit')->with('maker', $maker);
    }

    /**
     * Update the specified maker in storage.
     *
     * @param int $id
     * @param UpdatemakerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemakerRequest $request)
    {
        $maker = $this->makerRepository->find($id);

        if (empty($maker)) {
            Flash::error('Maker not found');

            return redirect(route('makers.index'));
        }

        $maker = $this->makerRepository->update($request->all(), $id);

        Flash::success('Maker updated successfully.');

        return redirect(route('makers.index'));
    }

    /**
     * Remove the specified maker from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $maker = $this->makerRepository->find($id);

        if (empty($maker)) {
            Flash::error('Maker not found');

            return redirect(route('makers.index'));
        }

        $this->makerRepository->delete($id);

        Flash::success('Maker deleted successfully.');

        return redirect(route('makers.index'));
    }
}
