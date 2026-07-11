<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketActivityLog;

class TicketPaymentActivityController extends Controller
{
    public function indexTicketActivity()
    {

        $ticket_activity=TicketActivityLog::orderBy('created_at','desc')->paginate(100);
        return view('ticket-activity-log.ticket-activity-log',compact('ticket_activity'));
    }

    
    
}
