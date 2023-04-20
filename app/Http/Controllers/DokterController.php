<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDokterRequest;
use App\Http\Requests\UpdateDokterRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DokterRepository;
use Illuminate\Http\Request;
use Flash;

class DokterController extends AppBaseController
{
    /** @var DokterRepository $dokterRepository*/
    private $dokterRepository;

    public function __construct(DokterRepository $dokterRepo)
    {
        $this->dokterRepository = $dokterRepo;
    }

    /**
     * Display a listing of the Dokter.
     */
    public function index(Request $request)
    {
        return view('dokters.index');
    }

    /**
     * Show the form for creating a new Dokter.
     */
    public function create()
    {
        return view('dokters.create');
    }

    /**
     * Store a newly created Dokter in storage.
     */
    public function store(CreateDokterRequest $request)
    {
        $input = $request->all();

        $dokter = $this->dokterRepository->create($input);

        Flash::success('Dokter saved successfully.');

        return redirect(route('dokters.index'));
    }

    /**
     * Display the specified Dokter.
     */
    public function show($id)
    {
        $dokter = $this->dokterRepository->find($id);

        if (empty($dokter)) {
            Flash::error('Dokter not found');

            return redirect(route('dokters.index'));
        }

        return view('dokters.show')->with('dokter', $dokter);
    }

    /**
     * Show the form for editing the specified Dokter.
     */
    public function edit($id)
    {
        $dokter = $this->dokterRepository->find($id);

        if (empty($dokter)) {
            Flash::error('Dokter not found');

            return redirect(route('dokters.index'));
        }

        return view('dokters.edit')->with('dokter', $dokter);
    }

    /**
     * Update the specified Dokter in storage.
     */
    public function update($id, UpdateDokterRequest $request)
    {
        $dokter = $this->dokterRepository->find($id);

        if (empty($dokter)) {
            Flash::error('Dokter not found');

            return redirect(route('dokters.index'));
        }

        $dokter = $this->dokterRepository->update($request->all(), $id);

        Flash::success('Dokter updated successfully.');

        return redirect(route('dokters.index'));
    }

    /**
     * Remove the specified Dokter from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $dokter = $this->dokterRepository->find($id);

        if (empty($dokter)) {
            Flash::error('Dokter not found');

            return redirect(route('dokters.index'));
        }

        $this->dokterRepository->delete($id);

        Flash::success('Dokter deleted successfully.');

        return redirect(route('dokters.index'));
    }
}
