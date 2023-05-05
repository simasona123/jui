<?php

namespace App\Http\Controllers;

use App\DataTables\PembayaranDataTable;
use App\Http\Requests\CreatePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Booking;
use App\Models\Dokter;
use App\Models\JadwalPraktik;
use App\Models\Pasien;
use App\Models\Pembayaran;
use App\Models\Reminder;
use App\Models\User;
use App\Notifications\CustomNotification;
use App\Repositories\PembayaranRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends AppBaseController
{
    /** @var PembayaranRepository $pembayaranRepository*/
    private $pembayaranRepository;

    public function __construct(PembayaranRepository $pembayaranRepo)
    {
        $this->pembayaranRepository = $pembayaranRepo;
    }

    /**
     * Display a listing of the Pembayaran.
     */
    public function index(PembayaranDataTable $pembayaranDataTable)
    {  
        return $pembayaranDataTable->render('pembayarans.index');
    }


    /**
     * Show the form for creating a new Pembayaran.
     */
    public function create()
    {
        return view('pembayarans.create');
    }

    /**
     * Store a newly created Pembayaran in storage.
     */
    public function store(CreatePembayaranRequest $request)
    {
        $input = $request->all();
        $booking = Booking::find($request->booking_id);
        $pasien = $booking->pasien;
        $input['user_id']= $pasien->user_id;

        $pembayaran = $this->pembayaranRepository->create($input);

        $user = User::find($input['user_id']);

        $reminder = Reminder::create([
            'pasien_id' => $pasien->id,
            'keterangan' => "Silahkan lakukan konfirmasi pembayaran untuk kode booking " . 
                $booking->kode_booking . " sebesar "  . $pembayaran->jumlah_transaksi . ". Terima kasih",
            "tanggal" => date('Y-m-d')
        ]);

        $reminder->save();

        $user->notify(new CustomNotification($reminder));

        Flash::success('Pembayaran saved successfully.');

        return redirect(route('pembayarans.index'));
    }

    /**
     * Display the specified Pembayaran.
     */
    public function show($id)
    {
        $pembayaran = $this->pembayaranRepository->find($id);

        if (empty($pembayaran)) {
            Flash::error('Pembayaran not found');

            return redirect(route('pembayarans.index'));
        }

        return view('pembayarans.show')->with('pembayaran', $pembayaran);
    }

    /**
     * Show the form for editing the specified Pembayaran.
     */
    public function edit($id)
    {
        $pembayaran = $this->pembayaranRepository->find($id);

        if (empty($pembayaran)) {
            Flash::error('Pembayaran not found');

            return redirect(route('pembayarans.index'));
        }

        return view('pembayarans.edit')->with('pembayaran', $pembayaran);
    }

    /**
     * Update the specified Pembayaran in storage.
     */
    public function update($id, UpdatePembayaranRequest $request)
    {
        $pembayaran = $this->pembayaranRepository->find($id);

        if (empty($pembayaran)) {
            Flash::error('Pembayaran not found');

            return redirect(route('pembayarans.index'));
        }

        $pembayaran = $this->pembayaranRepository->update_custom($request->all(), $id);

        Flash::success('Pembayaran updated successfully.');

        return redirect(route('pembayarans.index'));
    }

    /**
     * Remove the specified Pembayaran from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pembayaran = $this->pembayaranRepository->find($id);

        if (empty($pembayaran)) {
            Flash::error('Pembayaran not found');

            return redirect(route('pembayarans.index'));
        }

        $this->pembayaranRepository->delete($id);

        Flash::success('Pembayaran deleted successfully.');

        return redirect(route('pembayarans.index'));
    }
}
