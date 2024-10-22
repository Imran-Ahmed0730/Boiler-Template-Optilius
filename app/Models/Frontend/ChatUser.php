<?php

namespace App\Models\Frontend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function chat()
    {
        return $this->hasMany(LiveChat::class, 'chat_user_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class,  'assigned_to', 'id');
    }
}
