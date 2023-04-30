<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the User.
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created User in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        try {
            $this->userRepository->create($input);
        } catch (\Throwable $th) {
            Flash::error('Email telah terdaftar');
            return redirect(route('users.create'));
        }
        
        Flash::success('User saved successfully.');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $role = $user->getRoleNames();

        return view('users.show', [
            'user' => $user,
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified User.
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $roles = Role::all();
        $role = $user->getRoleNames();

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        return view('users.edit', [
            'user' => $user,
            'role' => $role,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified User in storage.
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function profil(){
        $user = Auth::user();
        return view('users.profil', [
            'user' => $user,
        ]);
    }

    public function profil_update(Request $request){

        $user = Auth::user();

        $validated = $request->validate([
            'full_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'confirmed'],
            'address' => ['nullable',],
            'phone' => ['nullable', 'regex:/(^[0-9]+$)/i'],
            'image' => ["nullable", "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
        ]);

        $this->userRepository->profil_update($user, $validated);

        return redirect('/home');
    }
}
