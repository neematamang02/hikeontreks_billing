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
				<span class="g-valign-middle">User List</span>
			</li>
		</ul>
	</div>
    @include('common.form_error')


    {{-- @if( Session::has('store') )
        <div class="alert alert-success error_msg">
            {{ Session::get('store') }}
        </div>
    @endif
    @if( Session::has('update') )
        <div class="alert alert-success error_msg">
            {{ Session::get('update') }}
        </div>
    @endif --}}
	<!-- End Breadcrumb-v1 -->
	{{-- Form Start --}}
	<div class="g-pa-20">
		<h1 class="g-font-weight-300 g-font-size-28 g-color-black g-mb-28">Users List</h1>
		
		<div class="table-responsive g-mb-40">
			<table class="table u-table--v3 g-color-black">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $i=0
                    @endphp


                    @foreach( $user as $users )
                    <tr>
                        <td><?php $i++?>{{$i}}</td>
                        <td>{{ $users->name }}</td>
                        <td>{{ $users->email }}</td>
                        <td>{{ $users->role }}</td>

                        
                        <td>
                            <a  href="{{route('user.edit', $users->id)}}" class="ml-2" style="font-size: 24px;" title="Edit"><i class="fa fa-edit"></i></a>
                            <a  href="{{route('user-reset-password', $users->id)}}" class="ml-2" style="font-size: 24px;" title="Reset Password"><i class="fa fa-refresh"></i></a>
                        
                        </td>
                    </tr>

                    @endforeach
                    
                </tbody>
			</table>
		</div>
		{{-- {{ $tickets->links() }} --}}
	</div>
</div>
@endsection

@push('js')
<script src="/assets/assets/vendor/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
@endpush

@push('js')
	<script>
	
	</script>
@endpush