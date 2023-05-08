<?php

namespace App\Http\Controllers;

use App\DataTables\RekamMedisDataTable;
use App\Http\Requests\CreateRekamMedisRequest;
use App\Http\Requests\UpdateRekamMedisRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Booking;
use App\Models\Dokter;
use App\Models\RekamMedis;
use App\Repositories\RekamMedisRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;

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
    public function create(Request $request)
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

        Flash::success('Rekam medis berhasil dibuat.');

        return redirect(route('rekamMedis.index'));
    }

    /**
     * Display the specified RekamMedis.
     */
    public function show($id)
    {
        $rekamMedis = $this->rekamMedisRepository->find($id);

        if (empty($rekamMedis)) {
            Flash::error('Rekam medis tidak ditemukan.');

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
            Flash::error('Rekam medis tidak ditemukan.');

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
            Flash::error('Rekam medis tidak ditemukan.');

            return redirect(route('rekamMedis.index'));
        }

        $rekamMedis = $this->rekamMedisRepository->update($request->all(), $id);

        Flash::success('Rekam medis berhasil diubah.');

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
            Flash::error('Rekam medis tidak ditemukan.');

            return redirect(route('rekamMedis.index'));
        }

        $this->rekamMedisRepository->delete($id);

        Flash::success('Rekam berhasil dihapus.');

        return redirect(route('rekamMedis.index'));
    }

    public function redirect(Request $request){
        $booking = Booking::where('kode_booking', $request->kode_booking)->first();
        $rekam_medis = RekamMedis::where('booking_id', (int)$booking->id)->first();
        $user = Auth::user();
        if($user->hasRole('dokter-hewan')){
            if($rekam_medis == null){
                return view('rekam_medis.create', [
                    'booking' => $booking
                ]);
            } return view('rekam_medis.edit', ["rekamMedis" => $rekam_medis]);
        }else{
            if($rekam_medis == null){
                Flash::success('Rekam medis Belum dibuat');
                return redirect(route('bookings.index'));
            } return view('rekam_medis.show', ["rekamMedis" => $rekam_medis]);
        }
        
    }
}
