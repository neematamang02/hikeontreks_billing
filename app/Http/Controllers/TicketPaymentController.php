<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TicketPayment;
use App\Models\Ticket;
use App\Models\TicketActivityLog;

class TicketPaymentController extends Controller
{
    public function editTicketPayment($id)
    {
        $ticket_payment = TicketPayment::findOrFail($id);

        $ticket_id = $ticket_payment->ticket_id;

        $ticket = Ticket::findOrFail($ticket_id);
        $ticket_price = $ticket->ticket_price;

        
        return view('ticket-payment.edit',compact('ticket_payment','ticket_price'));

    }

    public function updateTicketPayment(Request $request,$id)
    {
        $rules = [
            'ticket_price' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'required'
        ];

        $validator = \Validator::make($request->all(), $rules);
        
        if( $validator->fails() ){
            return back()->withInput()->withErrors($validator->errors());
        }
        
        $ticket_payment = TicketPayment::findOrFail($id);
        $ticket_id = $ticket_payment->ticket_id;

        $ticket = Ticket::findOrFail($ticket_id);
        $otherPaymentsTotal = $ticket->ticketPayments()
            ->where('id', '!=', $ticket_payment->id)
            ->sum('amount');

        if ((float) $request->amount_paid + (float) $otherPaymentsTotal > (float) $request->ticket_price) {
            return back()->withInput()->with(['error_msg' => 'Total paid amount cannot be greater than ticket price']);
        }

        DB::transaction(function () use ($request, $ticket_payment, $ticket, $ticket_id) {
            $previous_ticket_price = $ticket->ticket_price;
            $previous_ticket_amount = $ticket_payment->amount;

            $ticket->ticket_price = $request->ticket_price;
            $ticket->save();

            $ticket_payment->amount = $request->amount_paid;
            $ticket_payment->payment_method = $request->payment_method;
            $ticket_payment->save();

            $description = '';
            if ($previous_ticket_price != $ticket->ticket_price) {
                $description .= '<p>Ticket Price Update</p>';
                $description .= 'From Rs. ' . e($previous_ticket_price) . ' to Rs. ' . e($ticket->ticket_price);
            }

            if ($previous_ticket_amount != $ticket_payment->amount) {
                $description .= '<p>Amount Paid Update</p>';
                $description .= 'From Rs. ' . e($previous_ticket_amount) . ' to Rs. ' . e($ticket_payment->amount);
            }

            if ($description !== '') {
                $ticket_activity = new TicketActivityLog();
                $ticket_activity->ticket_id = $ticket_id;
                $ticket_activity->user_id = auth()->user()->id;
                $ticket_activity->user_name = auth()->user()->name;
                $ticket_activity->description = $description;
                $ticket_activity->save();
            }
        });

        return redirect()->route('ticket.show', $ticket_id);
    }
}
