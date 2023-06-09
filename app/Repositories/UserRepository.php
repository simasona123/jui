<?php

namespace App\Repositories;

use App\Models\Dokter;
use App\Models\User;
use App\Notifications\UserVerification;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

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

        Notification::send($model, new UserVerification(2, $model));

        if($model->verification == 1){
            Notification::send($model, new UserVerification(1));
        }

        if($input['role'] == 4){
            Dokter::create([
                "user_id" => $model->id,
                "spesialis" => "Belum ada",
                "jenis_kelamin" => "pria",
                "nip" => "Belum ada",
            ]);
        }

        return $model;
    }

    public function update(array $input, int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);
        
        $verif = $model->verification;

        $array = array_filter($input, function($value){
            return !is_null($value);
        });

        if(isset($input['password'])) $array['password'] = Hash::make($array['password']);

        $model->fill($array);
        $model->save();

        if($verif == 0 && $array['verification'] == 1){
            Notification::send($model, new UserVerification(1, $model));
        }

        return $model;
    }

    public function profil_update($user, $validated){
        
        $user->fill(array_filter($validated));

        $media = $user->getMedia();

            foreach ($media as $item) {
                $item->delete();
            }

        if(isset($validated['image'])){
            $image_name = $user->name.".".$validated['image']->extension();
            $validated['image']->move(storage_path('app/profil'), $image_name);
            $user->addMedia(storage_path('app/profil/') . $image_name)
                ->usingName($image_name)
                ->toMediaCollection();
        }
        $user->save();
    }
}
