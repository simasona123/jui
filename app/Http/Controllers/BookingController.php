<?php

namespace App\Http\Controllers;

use App\DataTables\BookingDataTable;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Packages\MyModules;
use App\Repositories\BookingRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;

class BookingController extends AppBaseController
{
    /** @var BookingRepository $bookingRepository*/
    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepo)
    {
        $this->bookingRepository = $bookingRepo;
    }

    /**
     * Display a listing of the Booking.
     */
    public function index(BookingDataTable $bookingDataTable)
    {
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        if(MyModules::cek_pasien_pertama($user, $role) == -1)return redirect()->route('pasien.create');
        return $bookingDataTable->render('bookings.index');
    }


    /**
     * Show the form for creating a new Booking.
     */
    public function create()
    {
        $user = Auth::user();
        if($user->hasRole('klien')){
            if($user->address == '' || $user->phone==''){
                return redirect(route('home.profil'));
            }
        }
        return view('bookings.create');
    }

    /**
     * Store a newly created Booking in storage.
     */
    public function store(CreateBookingRequest $request)
    {
        $input = $request->all();

        $booking = $this->bookingRepository->create_booking($input);

        if (gettype($booking) == "integer"){
            Flash::error('Jadwal Tidak Tersedia');

            return redirect(route('bookings.index'));
        }

        Flash::success('Booking saved successfully.');

        return redirect(route('bookings.index'));
    }

    /**
     * Display the specified Booking.
     */
    public function show($id)
    {
        $booking = $this->bookingRepository->find($id);
        
        if (empty($booking)) {
            Flash::error('Booking not found');

            return redirect(route('bookings.index'));
        }

        return view('bookings.show')->with('booking', $booking);
    }

    /**
     * Show the form for editing the specified Booking.
     */
    public function edit($id)
    {
        $booking = $this->bookingRepository->find($id);

        if (empty($booking)) {
            Flash::error('Booking not found');

            return redirect(route('bookings.index'));
        }

        return view('bookings.edit', [
            'booking' => $booking,
        ]);
    }

    /**
     * Update the specified Booking in storage.
     */
    public function update($id, Request $request)
    {
        $booking = $this->bookingRepository->find($id);

        if (empty($booking)) {
            Flash::error('Booking not found');

            return redirect(route('bookings.index'));
        }

        $booking = $this->bookingRepository->update_booking($request->all(), $id);
        
        if (gettype($booking) == "integer"){
            Flash::error('Jadwal Tidak Tersedia');

            return redirect(route('bookings.index'));
        }

        Flash::success('Booking updated successfully.');

        return redirect(route('bookings.index'));
    }

    /**
     * Remove the specified Booking from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $booking = $this->bookingRepository->find($id);

        if (empty($booking)) {
            Flash::error('Booking not found');

            return redirect(route('bookings.index'));
        }

        $this->bookingRepository->delete($id);

        Flash::success('Booking deleted successfully.');

        return redirect(route('bookings.index'));
    }
}
