<?php

namespace App\Http\Controllers;

use App\DataTables\ReminderDataTable;
use App\Http\Requests\CreateReminderRequest;
use App\Http\Requests\UpdateReminderRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Reminder;
use App\Models\User;
use App\Notifications\CustomNotification;
use App\Repositories\ReminderRepository;
use Flash;
use Illuminate\Support\Facades\Notification;

class ReminderController extends AppBaseController
{
    /** @var ReminderRepository $reminderRepository*/
    private $reminderRepository;

    public function __construct(ReminderRepository $reminderRepo)
    {
        $this->reminderRepository = $reminderRepo;
    }

    /**
     * Display a listing of the Reminder.
     */
    public function index(ReminderDataTable $reminderDataTable)
    {
    return $reminderDataTable->render('reminders.index');
    }


    /**
     * Show the form for creating a new Reminder.
     */
    public function create()
    {
        return view('reminders.create');
    }

    /**
     * Store a newly created Reminder in storage.
     */
    public function store(CreateReminderRequest $request)
    {
        $input = $request->all();
        
        $reminder = $this->reminderRepository->create($input);

        Flash::success('Reminder saved successfully.');

        return redirect(route('reminders.index'));
    }

    /**
     * Display the specified Reminder.
     */
    public function show($id)
    {
        $reminder = $this->reminderRepository->find($id);

        if (empty($reminder)) {
            Flash::error('Reminder not found');

            return redirect(route('reminders.index'));
        }

        return view('reminders.show')->with('reminder', $reminder);
    }

    /**
     * Show the form for editing the specified Reminder.
     */
    public function edit($id)
    {
        $reminder = $this->reminderRepository->find($id);

        if (empty($reminder)) {
            Flash::error('Reminder not found');

            return redirect(route('reminders.index'));
        }

        return view('reminders.edit')->with('reminder', $reminder);
    }

    /**
     * Update the specified Reminder in storage.
     */
    public function update($id, UpdateReminderRequest $request)
    {
        $reminder = $this->reminderRepository->find($id);

        if (empty($reminder)) {
            Flash::error('Reminder not found');

            return redirect(route('reminders.index'));
        }

        $reminder = $this->reminderRepository->update($request->all(), $id);

        Flash::success('Reminder updated successfully.');

        return redirect(route('reminders.index'));
    }

    /**
     * Remove the specified Reminder from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $reminder = $this->reminderRepository->find($id);

        if (empty($reminder)) {
            Flash::error('Reminder not found');

            return redirect(route('reminders.index'));
        }

        $this->reminderRepository->delete($id);

        Flash::success('Reminder deleted successfully.');

        return redirect(route('reminders.index'));
    }

    public function kirim($id){

        $reminder = Reminder::find($id);
        if($reminder->status != -1){
            return redirect(route('reminders.index'));
        }

        $user_ids = [$reminder->dokter_id, $reminder->pasien_id];
        $users = [];

        if($user_ids[0] != null){
            array_push($users, Dokter::find($user_ids[0])->user_id);
        }
        if($user_ids[1] != null){
            array_push($users, Pasien::find($user_ids[1])->user_id);
        }

        $users = User::whereIn('id', $users)->get();
        Notification::send($users, new CustomNotification($reminder));
        $reminder->status = 1;
        $reminder->save();
        
        return redirect(route('reminders.index'));
    }
}
