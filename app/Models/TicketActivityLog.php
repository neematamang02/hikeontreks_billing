<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketActivityLog extends Model
{
    use HasFactory;

    protected $table = "ticket_activity_logs";

    protected $fillable = ['ticket_id', 'description', 'user_id', 'user_name'];
}
