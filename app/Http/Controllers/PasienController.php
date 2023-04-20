<?php

namespace App\Http\Controllers;

use App\DataTables\PasienDataTable;
use App\Http\Requests\CreatePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PasienRepository;
use Illuminate\Http\Request;
use Flash;

class PasienController extends AppBaseController
{
    /** @var PasienRepository $pasienRepository*/
    private $pasienRepository;

    public function __construct(PasienRepository $pasienRepo)
    {
        $this->pasienRepository = $pasienRepo;
    }

    /**
     * Display a listing of the Pasien.
     */
    public function index(PasienDataTable $pasienDataTable)
    {
        return $pasienDataTable->render('pasien.index');
    }

    /**
     * Show the form for creating a new Pasien.
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Store a newly created Pasien in storage.
     */
    public function store(CreatePasienRequest $request)
    {
        $input = $request->all();

        $pasien = $this->pasienRepository->create($input);

        Flash::success('Pasien saved successfully.');

        return redirect(route('pasien.index'));
    }

    /**
     * Display the specified Pasien.
     */
    public function show($id)
    {
        $pasien = $this->pasienRepository->find($id);

        if (empty($pasien)) {
            Flash::error('Pasien not found');

            return redirect(route('pasien.index'));
        }

        return view('pasien.show')->with('pasien', $pasien);
    }

    /**
     * Show the form for editing the specified Pasien.
     */
    public function edit($id)
    {
        $pasien = $this->pasienRepository->find($id);

        if (empty($pasien)) {
            Flash::error('Pasien not found');

            return redirect(route('pasien.index'));
        }

        return view('pasien.edit')->with('pasien', $pasien);
    }

    /**
     * Update the specified Pasien in storage.
     */
    public function update($id, UpdatePasienRequest $request)
    {
        $pasien = $this->pasienRepository->find($id);

        if (empty($pasien)) {
            Flash::error('Pasien not found');

            return redirect(route('pasien.index'));
        }

        $pasien = $this->pasienRepository->update($request->all(), $id);

        Flash::success('Pasien updated successfully.');

        return redirect(route('pasien.index'));
    }

    /**
     * Remove the specified Pasien from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pasien = $this->pasienRepository->find($id);

        if (empty($pasien)) {
            Flash::error('Pasien not found');

            return redirect(route('pasien.index'));
        }

        $this->pasienRepository->delete($id);

        Flash::success('Pasien deleted successfully.');

        return redirect(route('pasien.index'));
    }
}
