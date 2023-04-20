<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'email',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }

    public function create(array $input): Model
    {
        $input['password'] = Hash::make($input['password']);
        $model = $this->model->newInstance($input);
        $model->assignRole($input['role']);
        $model->save();
        return $model;
    }

    public function update(array $input, int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $array = array_filter($input, function($value){
            return !is_null($value);
        });

        $model->fill($array);

        $model->save();

        return $model;
    }

    public function profil_update($user, $validated){
        
        $user->fill(array_filter($validated));

        $image_name = $user->name.".".$validated['image']->extension();

        $validated['image']->move(storage_path('app/profil'), $image_name);

        $user->addMedia(storage_path('app/profil/') . $image_name)->toMediaCollection();

        $user->save();

    }
}
