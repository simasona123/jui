<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    // app/Message.php

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['subject', 'creator_id', 'image', 'parent_message_id', 'created_at', ];
    public $timestamps = false;

    public function user(){
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

}
