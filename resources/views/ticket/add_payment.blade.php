@extends('main.master')

@section('main-section')

@php
	$destinations = [
		'Kathmandu', 'Pokhara', 'Kalinchowk', 'Manakamana', 'Dolakha', 'Delhi', 'Siliguri', 'Ilam', 'Chitwan', 'Kakarvitta', 'Lumbini', 'Butwal', 'Jomsom', 'Bhairahawa', 'Sunauli', 'Narayanghat', 'Pashupatinagar', 'Fikkal'
	];
	$payment_methods = [
		'Cash', 'E-sewa', 'Khalti', 'FonePay', 'Bank Transfer', 'Card Payment', 'Other'
	]

@endphp	

<div class="col g-ml-45 g-ml-0--lg g-pb-65--md">
	<!-- Breadcrumb-v1 -->
	<div class="g-hidden-sm-down g-bg-gray-light-v8 g-pa-20">
		<ul class="u-list-inline g-color-gray-dark-v6">
			
			<li class="list-inline-item g-mr-10">
				<a class="u-link-v5 g-color-gray-dark-v6 g-color-secondary--hover g-valign-middle" href="#!">Ticket</a>
				<i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
			</li>
			
			<li class="list-inline-item">
				<span class="g-valign-middle">Add Payment</span>
			</li>
		</ul>
	</div>
	<!-- End Breadcrumb-v1 -->
	{{-- Form Start --}}
	<div class="g-pa-20">
		<h1 class="g-font-weight-300 g-font-size-28 g-color-black g-mb-28">Add Payment</h1>
		
		<div class="row">
			<div class="col-12">
				<div class="wrap bg-light p-4">
					<div class="row">
						<div class="col-4">
							<p>Ticket <br/><strong>HT-{{ $ticket->id }}</strong></p>
							<p>Client <br/><strong>{{ $ticket->customer_name }}</strong></p>
						</div>
						<div class="col-4">
							<p>Ticket Price : Rs. {{ $ticket->ticket_price }}</p>
							<p>Paid Amount : Rs. {{ $total_paid }}</p>
							<hr class="p-0 my-1"/>
							<p>Amount Due : <strong>Rs. {{ (int)$ticket->ticket_price - $total_paid }}</strong></p>
						</div>
					</div>
				</div>
			</div>
		</div>


		<form method="POST" action="{{ route('ticket.add_payment_post', $ticket->id) }}" class="mt-4">
			@csrf
			@include('common.form_error')
			<div class="row">

				
				<div class="col-md-12">

					<div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group g-mb-30">
									<label class="g-mb-10" for="inputGroup-1_1">Amount Paid (Rs.)*</label>
									
									<div class="g-pos-rel">
										<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
											<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
										</span>
										<input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="number" placeholder="Amount Paid" name="amount_paid" value="{{ old('amount_paid') }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group g-mb-30">
									<label class="g-mb-10" for="inputGroup-1_1">Payment Method*</label>
									
									<div class="g-pos-rel">
										<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
											<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
										</span>
										<select id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="number" placeholder="Amount Paid" name="payment_method">

											@foreach( $payment_methods as $pm )
											<option value="{{$pm}}" {{ (old('payment_method') == $pm)?'selected':'' }}>{{$pm}}</option>
											
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group g-mb-30">
									<label class="g-mb-10" for="inputGroup-1_1">Remarks</label>
									
									<div class="g-pos-rel">
										<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
											<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
										</span>
										<textarea id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="number" placeholder="Remarks (if any)" name="remarks"></textarea>
									</div>
								</div>
							</div>

						</div>
					</div>
					<button class="btn btn-md btn-success" type="submit">Add Payment</button>

					</div>
				</div>
				
				
			</div>
		</form>
	</div>
</div>
@endsection