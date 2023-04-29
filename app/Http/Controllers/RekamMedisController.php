<?php

namespace App\Http\Controllers;

use App\DataTables\RekamMedisDataTable;
use App\Http\Requests\CreateRekamMedisRequest;
use App\Http\Requests\UpdateRekamMedisRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Booking;
use App\Models\Dokter;
use App\Repositories\RekamMedisRepository;
use Illuminate\Http\Request;
use Flash;

class RekamMedisController extends AppBaseController
{
    /** @var RekamMedisRepository $rekamMedisRepository*/
    private $rekamMedisRepository;

    public function __construct(RekamMedisRepository $rekamMedisRepo)
    {
        $this->rekamMedisRepository = $rekamMedisRepo;
    }

    /**
     * Display a listing of the RekamMedis.
     */
    public function index(RekamMedisDataTable $rekamMedisDataTable)
    {
    return $rekamMedisDataTable->render('rekam_medis.index');
    }


    /**
     * Show the form for creating a new RekamMedis.
     */
    public function create()
    {
        return view('rekam_medis.create');
    }

    /**
     * Store a newly created RekamMedis in storage.
     */
    public function store(CreateRekamMedisRequest $request)
    {
        $input = $request->all();

        $rekamMedis = $this->rekamMedisRepository->create($input);

        Flash::success('Rekam Medis saved successfully.');

        return redirect(route('rekamMedis.index'));
    }

    /**
     * Display the specified RekamMedis.
     */
    public function show($id)
    {
        $rekamMedis = $this->rekamMedisRepository->find($id);

        if (empty($rekamMedis)) {
            Flash::error('Rekam Medis not found');

            return redirect(route('rekamMedis.index'));
        }

        return view('rekam_medis.show')->with('rekamMedis', $rekamMedis);
    }

    /**
     * Show the form for editing the specified RekamMedis.
     */
    public function edit($id)
    {
        $rekamMedis = $this->rekamMedisRepository->find($id);

        if (empty($rekamMedis)) {
            Flash::error('Rekam Medis not found');

            return redirect(route('rekamMedis.index'));
        }

        return view('rekam_medis.edit')->with('rekamMedis', $rekamMedis);
    }

    /**
     * Update the specified RekamMedis in storage.
     */
    public function update($id, UpdateRekamMedisRequest $request)
    {
        $rekamMedis = $this->rekamMedisRepository->find($id);
        if (empty($rekamMedis)) {
            Flash::error('Rekam Medis not found');

            return redirect(route('rekamMedis.index'));
        }

        $rekamMedis = $this->rekamMedisRepository->update($request->all(), $id);

        Flash::success('Rekam Medis updated successfully.');

        return redirect(route('rekamMedis.index'));
    }

    /**
     * Remove the specified RekamMedis from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekamMedis = $this->rekamMedisRepository->find($id);

        if (empty($rekamMedis)) {
            Flash::error('Rekam Medis not found');

            return redirect(route('rekamMedis.index'));
        }

        $this->rekamMedisRepository->delete($id);

        Flash::success('Rekam Medis deleted successfully.');

        return redirect(route('rekamMedis.index'));
    }
}