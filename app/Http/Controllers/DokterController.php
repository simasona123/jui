<?php

namespace App\Http\Controllers;

use App\DataTables\DokterDataTable;
use App\Http\Requests\CreateDokterRequest;
use App\Http\Requests\UpdateDokterRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Repositories\DokterRepository;
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
    public function index(DokterDataTable $dokterDataTable)
    {
        return $dokterDataTable->render('dokter.index');
    }

    /**
     * Show the form for creating a new Dokter.
     */
    public function create()
    {
        return view('dokter.create');
    }

    /**
     * Store a newly created Dokter in storage.
     */
    public function store(CreateDokterRequest $request)
    {
        $dokter = $this->dokterRepository->create_with_image($request);

        Flash::success('Dokter saved successfully.');

        return redirect(route('dokter.index'));
    }

    /**
     * Display the specified Dokter.
     */
    public function show($id)
    {
        $dokter = $this->dokterRepository->find($id);

        if (empty($dokter)) {
            Flash::error('Dokter not found');

            return redirect(route('dokter.index'));
        }

        return view('dokter.show')->with('dokter', $dokter);
    }

    /**
     * Show the form for editing the specified Dokter.
     */
    public function edit($id)
    {
        $dokter = $this->dokterRepository->find($id);

        $user = User::find($dokter->user_id);

        if (empty($dokter)) {
            Flash::error('Dokter not found');

            return redirect(route('dokter.index'));
        }

        return view('dokter.edit', [
            "dokter" => $dokter,
            "user" => $user,
        ]);
    }

    /**
     * Update the specified Dokter in storage.
     */
    public function update($id, UpdateDokterRequest $request)
    {
        $dokter = $this->dokterRepository->find($id);

        if (empty($dokter)) {
            Flash::error('Dokter not found');

            return redirect(route('dokter.index'));
        }

        $dokter = $this->dokterRepository->update($request->all(), $id);

        Flash::success('Dokter updated successfully.');

        return redirect(route('dokter.index'));
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

            return redirect(route('dokter.index'));
        }

        $this->dokterRepository->delete($id);

        Flash::success('Dokter deleted successfully.');

        return redirect(route('dokter.index'));
    }
}
