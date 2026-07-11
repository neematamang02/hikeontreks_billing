@extends('main.master')

@section('main-section')


<div class="col g-ml-45 g-ml-0--lg g-pb-65--md">
	<!-- Breadcrumb-v1 -->
	<div class="g-hidden-sm-down g-bg-gray-light-v8 g-pa-20">
		<ul class="u-list-inline g-color-gray-dark-v6">
			
			<li class="list-inline-item g-mr-10">
				<a class="u-link-v5 g-color-gray-dark-v6 g-color-secondary--hover g-valign-middle" href="#!">Dashboard</a>
				<i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
			</li>
			
			<li class="list-inline-item">
				<span class="g-valign-middle">Ticket List</span>
			</li>
		</ul>
	</div>
	<!-- End Breadcrumb-v1 -->
	{{-- Form Start --}}
	<div class="g-pa-20">
		<h1 class="g-font-weight-300 g-font-size-28 g-color-black g-mb-28">Tickets</h1>
		
		<div class="table-responsive g-mb-40">
			<table class="table u-table--v3 g-color-black">
			<thead>
				<tr>
					<th>Ticket No</th>
					<th>Booking Date</th>
					<th>Departure Date</th>
					<th>From - To</th>
					<th>Customer Name</th>
					<th>Customer Contact</th>
					<th>Booked Seats</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>


				@foreach( $tickets as $ticket )
				<tr>
					<td><a target="_blank" href="{{route('ticket.show', $ticket->id)}}" class="text-primary" style="font-weight: bold; text-decoration:underline">HT-{{$ticket->id}}</a></td>
					<td>{{ $ticket->created_at->format('Y-m-d') }}</td>
					<td>{{ $ticket->departure_date }}</td>
					<td>{{ $ticket->travel_from }} - {{ $ticket->travel_to }}</td>
					<td>{{ $ticket->customer_name }}</td>
					<td>{{ $ticket->customer_phone }}</td>
					<td>
						@foreach( explode(',',$ticket->booked_seat) as $seat )
							<span class="badge badge-info">{{$seat}}</span>
						@endforeach
					</td>
					<td>
					@if (Auth::user()->can('edit-tickets'))

						<a href="{{route('ticket.edit', $ticket->id)}}" class="text-primary" style="font-size: 24px;"><i class="fa fa-pencil-square-o"></i></a>
					@endif	
						
						
						<a target="_blank" href="{{route('ticket.show', $ticket->id)}}" class="ml-2" style="font-size: 24px;"><i class="fa fa-print"></i></a>
					</td>
				</tr>

				@endforeach
				
			</tbody>
			</table>
		</div>
		{{ $tickets->links() }}
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

@push('js')
	<script>
	
	</script>
@endpush