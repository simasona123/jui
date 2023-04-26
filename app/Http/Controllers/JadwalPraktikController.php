<?php

namespace App\Http\Controllers;

use App\DataTables\JadwalPraktikDataTable;
use App\Http\Requests\CreateJadwalPraktikRequest;
use App\Http\Requests\UpdateJadwalPraktikRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Dokter;
use App\Models\User;
use App\Repositories\JadwalPraktikRepository;
use Flash;

class JadwalPraktikController extends AppBaseController
{
    /** @var JadwalPraktikRepository $jadwalPraktikRepository*/
    private $jadwalPraktikRepository;

    public function __construct(JadwalPraktikRepository $jadwalPraktikRepo)
    {
        $this->jadwalPraktikRepository = $jadwalPraktikRepo;
    }

    /**
     * Display a listing of the JadwalPraktik.
     */
    public function index(JadwalPraktikDataTable $jadwalPraktikDataTable)
    {
        return $jadwalPraktikDataTable->render('jadwal_praktik.index');
    }


    /**
     * Show the form for creating a new JadwalPraktik.
     */
    public function create()
    {
        return view('jadwal_praktik.create');
    }

    /**
     * Store a newly created JadwalPraktik in storage.
     */
    public function store(CreateJadwalPraktikRequest $request)
    {
        $input = $request->all();

        $jadwalPraktik = $this->jadwalPraktikRepository->create($input);

        Flash::success('Jadwal Praktik saved successfully.');

        return redirect(route('jadwal-praktik.index'));
    }

    /**
     * Display the specified JadwalPraktik.
     */
    public function show($id)
    {
        $jadwalPraktik = $this->jadwalPraktikRepository->find($id);

        if (empty($jadwalPraktik)) {
            Flash::error('Jadwal Praktik not found');

            return redirect(route('jadwal-praktik.index'));
        }

        return view('jadwal_praktik.show')->with('jadwalPraktik', $jadwalPraktik);
    }

    /**
     * Show the form for editing the specified JadwalPraktik.
     */
    public function edit($id)
    {
        $jadwalPraktik = $this->jadwalPraktikRepository->find($id);
        $user = Dokter::find($jadwalPraktik->dokter_id)->user;

        if (empty($jadwalPraktik)) {
            Flash::error('Jadwal Praktik not found');

            return redirect(route('jadwal-praktik.index'));
        }

        return view('jadwal_praktik.edit', [
            'jadwalPraktik' => $jadwalPraktik,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified JadwalPraktik in storage.
     */
    public function update($id, UpdateJadwalPraktikRequest $request)
    {
        $jadwalPraktik = $this->jadwalPraktikRepository->find($id);

        if (empty($jadwalPraktik)) {
            Flash::error('Jadwal Praktik not found');

            return redirect(route('jadwal-praktik.index'));
        }

        $jadwalPraktik = $this->jadwalPraktikRepository->update($request->all(), $id);

        Flash::success('Jadwal Praktik updated successfully.');

        return redirect(route('jadwal-praktik.index'));
    }

    /**
     * Remove the specified JadwalPraktik from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $jadwalPraktik = $this->jadwalPraktikRepository->find($id);

        if (empty($jadwalPraktik)) {
            Flash::error('Jadwal Praktik not found');

            return redirect(route('jadwal-praktik.index'));
        }

        $this->jadwalPraktikRepository->delete($id);

        Flash::success('Jadwal Praktik deleted successfully.');

        return redirect(route('jadwal-praktik.index'));
    }
}
