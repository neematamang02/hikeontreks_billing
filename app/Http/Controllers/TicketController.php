<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketPayment;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{


    // public function __construct()
    // {
    //     $this->authorizeResource(Ticket::class, 'ticket');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tickets'] = Ticket::orderBy('created_at','desc')->paginate(20);
        return view('ticket.ticket_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.ticket_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'departure_date' => 'required',
            'travel_from' => 'required',
            'travel_to' => 'required',
            'departure_location' => 'required',
            'departure_time' => 'required',
            'pickup_location' => 'required',
            'vehicle_number' => 'nullable',
            'booked_seat' => 'required',
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_email' => 'nullable',
            'customer_phone' => 'required',
            'ticket_price' => 'required|numeric|min:0',
            'remarks' => 'nullable',

            'amount_paid' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable'

        ];

        $validator = \Validator::make($request->all(), $rules);
        
        if( $validator->fails() ){
            return back()->withInput()->withErrors($validator->errors());
        }

        $ticketData = $validator->validated();

        $new_ticket = Ticket::create($ticketData);
        if( $new_ticket )
        {
            if( (float) ($ticketData['amount_paid'] ?? 0) > 0 ){
                $payment = new TicketPayment();
                $payment->ticket_id = $new_ticket->id;
                $payment->payment_method = $ticketData['payment_method'] ?? null;
                $payment->amount = $ticketData['amount_paid'];
                $payment->save();
            }

            return back()->with('success_msg', "Ticket Created Successfully");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $data['ticket'] = $ticket;
        $data['payments'] = $ticket->ticketPayments;
        $data['total_paid'] = 0;

        foreach( $data['payments'] as $p ){
            $data['total_paid'] += $p->amount;
        }

        return view('ticket.ticket_single', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit-tickets');

        $ticket = Ticket::findOrFail($id);

        $ticket_payment = TicketPayment::where('ticket_id', $id)->get();
        return view('ticket.ticket_edit', compact('ticket', 'ticket_payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('edit-tickets');

        $rules = [
            'departure_date' => 'required',
            'travel_from' => 'required',
            'travel_to' => 'required',
            'departure_location' => 'required',
            'departure_time' => 'required',
            'pickup_location' => 'required',
            'vehicle_number' => 'nullable',
            'booked_seat' => 'required',
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_email' => 'nullable',
            'customer_phone' => 'required',
            'ticket_price' => 'required|numeric|min:0',

        ];

        $validator = \Validator::make($request->all(), $rules);
        
        if( $validator->fails() ){
            return back()->withInput()->withErrors($validator->errors());
        }
        
        $ticket->departure_date=$request->departure_date;
        $ticket->travel_from=$request->travel_from;
        $ticket->travel_to=$request->travel_to;
        $ticket->departure_location=$request->departure_location;
        $ticket->departure_time=$request->departure_time;
        $ticket->pickup_location=$request->pickup_location;
        $ticket->vehicle_number=$request->vehicle_number;
        $ticket->booked_seat=$request->booked_seat;
        $ticket->customer_name=$request->customer_name;
        $ticket->customer_email=$request->customer_email;
        $ticket->customer_phone=$request->customer_phone;
        $ticket->ticket_price=$request->ticket_price;
        $ticket->save();
        return redirect()->back()->with('success_msg','Ticket Updated Successfully');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addPaymentView( Ticket $ticket ){
        $data['ticket'] = $ticket;
        $data['payments'] = $ticket->ticketPayments;
        $data['total_paid'] = 0;

        foreach( $data['payments'] as $p ){
            $data['total_paid'] += $p->amount;
        }

        return view('ticket.add_payment', $data);
    }

    public function addPayment( Ticket $ticket, Request $request ){
        $rules = [
            'amount_paid' => 'required|numeric|min:0.01',
            'payment_method' => 'required',
            'remarks' => 'nullable'
        ];

        $validator = \Validator::make($request->all(), $rules);

        if( $validator->fails() ){
            return back()->withInput()->withErrors($validator);
        }

        $payments = $ticket->ticketPayments;
        $total_paid = 0;
        foreach( $payments as $p ){
            $total_paid += $p->amount;
        }

        $due = (float) $ticket->ticket_price - $total_paid;

        if( (float) $request->amount_paid > $due){
            return back()->with(['error_msg' => 'Amount paid can\'t be greater than amount due']);
        }

        DB::transaction(function () use ($ticket, $request) {
            $payment = new TicketPayment();
            $payment->payment_method = $request->payment_method;
            $payment->amount = $request->amount_paid;
            $payment->remarks = $request->remarks;

            $ticket->ticketPayments()->save($payment);
        });

        return back()->with(['success_msg' => 'Payment added successfully']);
    }

}
