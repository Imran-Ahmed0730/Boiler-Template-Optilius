<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportContent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function support()
    {
        return $this->belongsTo(SupportTicket::class, 'support_ticket_id');
    }

    public function supportFiles()
    {
        return $this->hasMany(SupportFile::class, 'support_content_id');
    }
}
