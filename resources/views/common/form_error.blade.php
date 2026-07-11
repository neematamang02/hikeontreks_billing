@if($errors->any())
    <div class="alert alert-danger error_msg alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>

@endif
@if( Session::has('success_msg') )
    <div class="alert alert-success success_msg alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        {{ Session::get('success_msg') }}
    </div>
@endif
@if( Session::has('error_msg') )
    <div class="alert alert-danger error_msg alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        {{ Session::get('error_msg') }}
    </div>
@endif
