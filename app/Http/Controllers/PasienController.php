<?php

namespace App\Http\Controllers;

use App\DataTables\PasienDataTable;
use App\Http\Requests\CreatePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Repositories\PasienRepository;
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
        $input = $request;

        $pasien = $this->pasienRepository->create_with_image($input);

        Flash::success('Pasien saved successfully.');

        return redirect(route('pasien.index'));
    }

    /**
     * Display the specified Pasien.
     */
    public function show($id)
    {
        $pasien = $this->pasienRepository->find($id);

        $klien = User::find($pasien->user_id);


        if (empty($pasien)) {
            Flash::error('Pasien not found');

            return redirect(route('pasien.index'));
        }

        return view('pasien.show', [
            "pasien" => $pasien,
            "klien" => $klien,
        ]);
    }

    /**
     * Show the form for editing the specified Pasien.
     */
    public function edit($id)
    {
        $pasien = $this->pasienRepository->find($id);

        $klien = User::find($pasien->user_id);

        if (empty($pasien)) {
            Flash::error('Pasien not found');

            return redirect(route('pasien.index'));
        }

        return view('pasien.edit', [
            "pasien" => $pasien,
            "klien" => $klien,
        ]);
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

        $request = $request->all();

        $media = $pasien->getMedia();

            foreach ($media as $item) {
                $item->delete();
            }

        if(isset($request['image'])){
            $image_name = $pasien->nama_hewan.".".$request['image']->extension();
            $request['image']->move(storage_path('app/pasien'), $image_name);
            $pasien->addMedia(storage_path('app/pasien/') . $image_name)
                ->usingName($image_name)
                ->toMediaCollection();
        }

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

        try {
            $this->pasienRepository->delete($id);
        } catch (\Throwable $th) {
            $pasien->status = false;
            $pasien->save();
        }

        Flash::success('Pasien deleted successfully.');

        return redirect(route('pasien.index'));
    }
}
