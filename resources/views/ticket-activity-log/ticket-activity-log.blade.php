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
						<span class="g-valign-middle">Activity Log List</span>
					</li>
				</ul>
			</div>
			<!-- End Breadcrumb-v1 -->
			{{-- Form Start --}}
			<div class="g-pa-20">
				<h1 class="g-font-weight-300 g-font-size-28 g-color-black g-mb-28">Activity Log List</h1>
				
				<div class="table-responsive g-mb-40">
					<table class="table u-table--v3 g-color-black">
					<thead>
						<tr>
							<th>Date</th>
							<th>Name</th>
							<th>Description</th>
							
						</tr>
					</thead>
					
					<tbody>


						@foreach( $ticket_activity as $ta )
						<tr>
							<td>{{$ta->created_at->format('Y-m-d H:i:s') }}</td>
							<td>{{ $ta->user_name }}</td>
							<td> {!! $ta->description !!}</td>						
							
						</tr>

						@endforeach
						
					</tbody>
					</table>
					<br>
					{{ $ticket_activity->links() }}

				</div>
				
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