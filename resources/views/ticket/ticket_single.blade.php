<html>
	<head>
		<title> Ticket | HT-{{$ticket->id}} </title>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
		<style>
			body,p, h1, h2, h3, h4,h5,h6, table, tr, td{
				font-size: 90% !important;
			}
			p{
				margin-bottom: 0rem !important; 
			}
			.t-header p, .t-header h3{
			    color: #fff;
			}
			tr td, tr th{
				padding: 4px 10px !important;
			}
			img{
				max-width: 100px;
			}
			.seat_number{
				font-size : 14px;
			}
		</style>
	</head>

	<body>
		<div class="container">
			<div class="row d-print-none">
				<div class="col-md-6 mt-4">
					<button class="btn btn-success" id="print_btn"><i class="fas fa-print mr-2"></i>Print Ticket</button>
					<a href="{{ route('ticket.add_payment',$ticket->id) }}" class="btn btn-primary ml-4"><i class="fas fa-plus mr-2"></i></i>Add Payment</a>
					{{-- <form method="post" action="{{route('ticket.sent_in_mail', $ticket->id)}}" class="d-inline-block ml-4">
					@csrf
						<input type="mail" value="{{ $ticket->customer_email }}" />
						<button class="btn btn-info" type="submit"><i class="fa fa-envelope mr-2"></i>Sent In Mail</button>
					</form> --}}
				</div>
			</div>


			{{-- Bill start --- Top Part --}}
			<div class="col-10 bill mx-auto border" id="bill_part">
				<div class="row py-2 border-bottom border-dotted">
					<div class="col-md-6">
						<!--PAN No : <span class="text-secondary">605959060</span>-->
					</div>
					<div class="col-md-6 text-right">
						Regd. No. : <span class="text-secondary">167652/73/074</span>
					</div>

				</div>

				<div class="row t-header border-bottom border-dashed justify-content-center d-flex align-items-center bg-info">
					<div class="col align-item-center">
						<img src="https://sp-ao.shortpixel.ai/client/q_lossy,ret_img,w_484,h_437/https://hikeontreks.com/wp-content/uploads/2021/02/cropped-cropped-hike-on-trek-LOGO-copy-Copy-1.jpg"/>
					</div>
					<div class="col-4 py-2 text-left px-0">
						<h3>HEAD OFFICE</h3>
						<p>Thamel Aloft Hotel<br>(Chhaya Center) Opposite</p>
						<p><i class="fab fa-whatsapp"></i> 9851237317</p>
						<p>☎ 01-4514568 01-4535569</p>
						<p><i class="fas fa-envelope"></i> hikeontrek@gmail.com</p>
					</div>
					<div class="col-4 py-2 text-left px-0">
						<h3>BRANCH OFFICE</h3>
						<p>Street no.4 Pokhara<br>Lakeside</p>
						<p><i class="fab fa-whatsapp"></i> 9801177317</p>
						<p>☎ 061458550</p>
						<p><i class="fas fa-envelope"></i> hikeontrek@gmail.com</p>
					</div>
					<div class="col p-0">
						<div class="wrapper text-center">
							<img src="{{asset('assets/img/qr/frame.svg')}}" alt="QR code" />
						</div>
					</div>
				</div>
                <div class="t-wrap">
				<div class="row p-2">
					<div class="col-6">
						<p class="text-secondary"><strong>Client</strong></p>
						<p style="font-size:14px !important">{{ $ticket->customer_name }}</p>
						<p>{{ $ticket->customer_address }}</p>
						<p>{{ $ticket->customer_phone }}</p>
					</div>
					<div class="col-6">
						<p><strong>Booking Date :</strong> {{ $ticket->created_at->format('Y-m-d \( h:i a \)') }} </p>
						@if( $ticket->remarks )
							<p style="font-size:14px !important">{{ $ticket->remarks }}</p>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col-5 py-2">
						<table class="table-borderless">
							<tbody>
								<tr>
									<td><strong>Booking Code</strong></td>
									<td><span class="text-dark">HT-{{$ticket->id}}</span></td>
								</tr>
								<tr>
									<td><strong>Travel Date</strong></td>
									<td><span class="badge badge-success seat_number">{{ $ticket->departure_date }}</span></td>
								</tr>
								<tr>
									<td><strong>Departure Time</strong></td>
									@php
										$time = \Carbon\Carbon::createFromTime( explode(':', $ticket->departure_time)[0], explode(':', $ticket->departure_time)[1] );
										$final_time = $time->format('h:i a');
									@endphp
									<td><span class="text-dark">{{ $final_time }}</span></td>
								</tr>
								<tr>
									<td><strong>Sector</strong></td>
									<td><span class="text-dark">{{ $ticket->travel_from }} - {{ $ticket->travel_to }}</span></td>
								</tr>
								<tr>
									<td><strong>Seat Number</strong></td>
									<td>
										@foreach( explode(',' ,$ticket->booked_seat) as $bs )
											<span class="badge badge-success seat_number">{{ $bs }}</span>
										@endforeach
									</td>
								</tr>
								<tr>
									<td><strong>Pickup Location</strong></td>
									<td><span class="text-dark">{{ $ticket->pickup_location }}</span></td>
								</tr>
								
							</tbody>
						</table>
					</div>

					<div class="col-1"></div>

					<div class="col-6">
						@php	
							$payment_due = (int)$ticket->ticket_price - (int)$total_paid;
						@endphp
						<p><span class="text-dark">Payment Status</span> : <strong>{{ ($payment_due > 0)?'Due ( Rs.'.$payment_due.' )' : 'Full Paid' }}</strong></p>
						<p><span class="text-dark">Ticket Price</span> : Rs. {{ $ticket->ticket_price }}</p>

						<h6 class="mt-4">Payment Details</h6>
						<table class="table table-bordered border-dark">
							<thead>
								<tr>
									<th>Date</th>
									<th>Amount</th>
									<th>Payment Method</th>
								</tr>
							</thead>

							<tbody>
								@foreach( $payments as $p )
									<tr>
										<td class="text-dark">{{ $p->created_at->format('Y-m-d \| h:i a') }}</td>
										<td class="text-dark">Rs. {{ $p->amount }}</td>
										<td class="text-dark">{{ $p->payment_method }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>

					</div>
				</div>
				</div>

				<div class="row t-footer border-top bg-dark text-white py-2">

					<div class="col-12">
					    <!--<h2 class="text-center" style="font-size:18px !important; border-bottom: 1px solid #666; margin-bottom:20px !important; padding-bottom:10px">WE PROVIDE ALSO:</h2>-->

					</div>
					<!--<div class="col-3">-->
					<!--	{{-- <h5>Branch Office</h5> --}}-->
					<!--	<div class="row">-->
					<!--		<div class="col-12 bg-light">-->
					<!--			<strong>Kathmandu Branch</strong>-->
					<!--			<hr class="my-1 p-0"/>-->
					<!--			<p class="ml-2">Bhagawanbahal, Kathmandu, Nepal</p>-->
					<!--			<p class="ml-2"><strong> 01-4514568 </strong></p>-->
					<!--		</div>-->
					<!--		<div class="col-12 mt-2 bg-light">-->
					<!--			<strong>Pokhara Branch</strong>-->
					<!--			<hr class="p-0 my-1"/>-->
					<!--			<p class="ml-2">Pokhara-19 ( Airport Frontgate)</p>-->
					<!--			<p class="ml-2"><strong>06-1458550</strong> </p>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->

					<div class="col">
					    <h5>NEPAL TREKKING</h5>
						<ul class="pl-4">
                            <li>Annapurna Region </li>
                            <li>Langtang Region </li>
                            <li>Everest Region</li>
						</ul>
					</div>

					<div class="col">
					    <h5>INBOUND TOUR</h5>
						<ul  class="pl-4">
                            <li>Muktinath Tour </li>
                            <li>Upper Mustang Tour </li>
                            <li>Pathivara Tour </li>
                            <li>Kathmandu - Chitwan - Pokhara Tour</li>
						</ul>
					</div>

					<div class="col">
						<h5>OUTBOUND TOUR</h5>
						<ul class="pl-4">
                            <li>Thailand Tour </li>
                            <li>Dubai Tour </li>
                            <li>Singapore Tour </li>
                            <li>Sikkim Darjeeling Tour</li>
                            <li>Europe Tour </li>
						</ul>
					</div>
					
					<div class="col">
						<h5>ADVENTURE ACTIVITIES</h5>
						<ul class="pl-4">
                            <li>Bungee </li>
                            <li>paragliding </li>
                            <li>Zip Line </li>
                            <li>ATV </li>
                            <li>Canyoning </li>
                            <li>Rafting </li>
                            <li>Ultralight Flight</li> 
                            <li>Mountain Flight</li>
						</ul>
					</div>
					<div class="col-3">
						<h5>BUS SEWA</h5>
						<ul class="pl-4">
                            <li>KTM-Pokhara Sofa Bus</li>
                            <li>KTM-Delhi Bus Sewa</li> 
                            <li>KTM-Sauraha Bus</li>
                            <li>Vehicle Hiring</li>
						</ul>
					</div>
					
					<em class="px-4">
					    <h5>Note:</h5>
					    - After issuing ticket 19% Per Seats will be charged.<br>
                        - Within/ Before 48Hrs 32%  Per seat will be charged<br>
                        - with in 24hrs 100% Per seat will be charged. <br>
                        - In case of bus cancellation (Ticket will be canceled/ Transferred) Refunded according to travelers' need.<br>
                        - For date change, Time Change AM/PM. Company Will Charge 15%  per Seat After 2 Hrs. of issuing ticket.</em>


					{{-- <div class="col-12 p-4 text-center border-top border-bottom">
						<div class="text-secondary"> Please Visit our website : https://hikeontreks.com for more info. </div>
					</div> --}}
				</div>

				
			</div>
			{{-- end bill  --}}


		</div>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script>
			$(document).on('click','#print_btn',function(){
				window.print();
			})
		</script>
	</body>
</html>