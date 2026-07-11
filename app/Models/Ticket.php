<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure_date',
        'travel_from',
        'travel_to',
        'departure_location',
        'departure_time',
        'pickup_location',
        'vehicle_number',
        'booked_seat',
        'customer_name',
        'customer_address',
        'customer_email',
        'customer_phone',
        'ticket_price',
        'remarks',
    ];

    public function ticketPayments()
    {
        return $this->hasMany(TicketPayment::class, 'ticket_id');
    }

    public function ticketActivityLogs()
    {
        return $this->hasMany(TicketActivityLog::class, 'ticket_id');
    }
    
}
