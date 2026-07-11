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
						<a class="u-link-v5 g-color-gray-dark-v6 g-color-secondary--hover g-valign-middle" href="#!">Dashboard</a>
						<i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
					</li>
					
					<li class="list-inline-item">
						<span class="g-valign-middle">Edit Ticket</span>
					</li>
				</ul>
			</div>
			
			<!-- End Breadcrumb-v1 -->
			{{-- Form Start --}}
			<div class="g-pa-20">
				<h1 class="g-font-weight-300 g-font-size-28 g-color-black g-mb-28">Edit Ticket</h1>
				
				<form method="post" action="{{ route('ticket.update', $ticket->id ) }}">
					
					@csrf
					@method('patch')
					@include('common.form_error')
					<div class="row">

						
						<div class="col-md-12">
							<div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
								<h3 class="col-12 row">Departure Detail</h3>
								{{-- Departure Detail --}}
								<div class="row">
									<hr class="g-brd-bottom g-brd-gray-light-v7"/>
									<div class="col-md-4">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">Travel Date</label>
											<div id="datepickerWrapper" class="u-datepicker-right u-datepicker--v3 g-pos-rel w-100 g-cursor-pointer g-brd-around g-brd-gray-light-v7 g-rounded-4">
												<input class="js-range-datepicker w-100 g-bg-transparent g-font-size-12 g-font-size-default--md g-color-gray-dark-v6 g-pr-80 g-pl-15 g-py-9" type="text" placeholder="Select Date" data-rp-wrapper="#datepickerWrapper" data-rp-date-format="Y-m-d" name="departure_date" value="{{$ticket->departure_date}}">
												<div class="d-flex align-items-center g-absolute-centered--y g-right-0 g-color-gray-light-v6 g-color-lightblue-v9--sibling-opened g-mr-15">
													<i class="hs-admin-calendar g-font-size-18 g-mr-10"></i>
													<i class="hs-admin-angle-down"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-8"></div>
									
									
									<div class="col-md-6">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">From</label>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<select id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" name="travel_from"> 
													
													@foreach( $destinations as $destination )
														<option value="{{$destination}}" {{ (old('destination',isset($ticket->travel_from) ? $ticket->travel_from : '' ) == $destination)?'selected="selected"':'' }}>{{$destination}}</option>
													@endforeach


													

												</select>
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">To</label>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<select id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" name="travel_to"> 
													@foreach( $destinations as $destination )
														<option value="{{$destination}}" {{ (old('destination',isset($ticket->travel_to) ? $ticket->travel_to : '' ) == $destination)?'selected="selected"':'' }}>{{$destination}}</option>

													@endforeach
												</select>
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">Departure Location</label>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" name="departure_location" value="{{ $ticket->departure_location}}" /> 
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">Departure Time</label>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="time" name="departure_time" value="{{ $ticket->departure_time }}"> 
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">Pickup Location</label>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" name="pickup_location" value="{{ $ticket->pickup_location }}"> 
											</div>
										</div>
									</div>
								</div>
								{{-- End Departure Detail --}}
							</div>
							
							<div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
								<h3 class="col-12 row">Vehicle Detail</h3>
								{{-- Vehicle Detail --}}
								<div class="row">
									<hr class="g-brd-bottom g-brd-gray-light-v7"/>
									
									<div class="col-md-6">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">Vehicle Number</label>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" placeholder="Vehicle Number" name="vehicle_number" value="{{$ticket->vehicle_number }}">
											</div>
										</div>
									</div>
							<div class="col-md-6"></div>
											
											<div class="g-pos-rel u-tagsinput--v2--blue">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<div class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-6">
													<input id="inputGroup-1_1" class="" type="text" placeholder="Eg: 1,2,3,4,5" data-role="tagsinput" name="booked_seat" value="{{$ticket->booked_seat}}"/>
													<small class="g-text-gray">Add seat and hit 'Enter'</small>
												</div>
											</div>

											
										</div>
									</div>
									
								</div>
								{{-- end Vehicle Detail --}}
							</div>
							
							<div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
								<h3 class="col-12 row">Customer Detail</h3>
								{{-- Customer Detail --}}
								<div class="row">
									<hr class="g-brd-bottom g-brd-gray-light-v7"/>
									
									<div class="col-md-6">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">Name</label>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" placeholder="Name" name="customer_name" value="{{ $ticket->customer_name }}">
											</div>
										</div>
									</div>
							<div class="col-md-6"></div>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" placeholder="Address" name="customer_address" value="{{ $ticket->customer_address }}" />
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">Email</label>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="email" placeholder="Email" name="customer_email" value="{{ $ticket->customer_email }}" />
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group g-mb-30">
											<label class="g-mb-10" for="inputGroup-1_1">Contact No.</label>
											
											<div class="g-pos-rel">
												<span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
													<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
												</span>
												<input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" placeholder="Contact No." name="customer_phone" value="{{ $ticket->customer_phone }}" />
											</div>
										</div>
									</div>
									
								</div>
								{{-- end Vehicle Detail --}}
							</div>

							<div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
								<h3 class="col-12 row">Payment Detail</h3>
								<table class="table table-bordered">
									
									<thead>
										<tr>
											<th scope="col">S.N</th>
											<th scope="col">Payment Method</th>
											<th scope="col">Amount Paid</th>
											<th scope="col">Action</th>

										</tr>
									</thead>
									<tbody>
										@foreach($ticket_payment as $ticket_payments)
											<tr>
												<td >{{$loop->iteration}}</td>
												<td>{{$ticket_payments->payment_method}}</td>
												<td>{{$ticket_payments->amount}}</td>
												<td>
													<a href="{{route('ticket_payment.edit', $ticket_payments->id)}}" class="text-primary" style="font-size: 24px;"><i class="fa fa-pencil-square-o"></i></a>
													
												
												</td>

											</tr>
									
										@endforeach
									</tbody>
								</table>
								<a href="{{ route('ticket.add_payment',$ticket->id) }}" class="btn btn-md btn-info"><i class="fas fas-plus mr-2"></i>Add Payment</a>

							</div> 
							<button class="btn btn-md btn-success" type="submit">Update Ticket</button>							
						</div>					
					</div>
				</form>
			</div>
		</div>
		@endsection

		@push('js')
		<script src="/assets/assets/vendor/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
		<script>
			$(document).ready(function(){
				// initialization of range datepicker
				$.HSCore.components.HSRangeDatepicker.init('.js-range-datepicker');
			})
		</script>
		@endpush