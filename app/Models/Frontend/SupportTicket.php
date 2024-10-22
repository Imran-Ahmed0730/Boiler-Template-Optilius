<?php

namespace App\Models\Frontend;

use App\Models\Admin\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function content()
    {
        return $this->hasMany(SupportContent::class, 'support_ticket_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
}
