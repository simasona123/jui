<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserRole;
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

        $model->save();

        return $model;
    }

    public function update(array $input, int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);
        
        $model->fill(array_filter($input));

        $model->roles()->detach();
        
        $model->assignRole($input['role']);

        $model->save();

        return $model;
    }
}
