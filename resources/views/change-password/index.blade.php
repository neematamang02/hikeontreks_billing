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
                <span class="g-valign-middle">Change Password</span>
            </li>
        </ul>
    </div>
    @include('common.form_error')

    <!-- End Breadcrumb-v1 -->
    {{-- Form Start --}}
    <div class="g-pa-20">
        <h1 class="g-font-weight-300 g-font-size-28 g-color-black g-mb-28">Change Password</h1>
        
        <form method="POST" action="{{ route('update-password') }}">
            @csrf
            <div class="row">

                
                <div class="col-md-12">
                    <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
                        <h3 class="col-12 row">Change Password</h3>
                        {{-- Departure Detail --}}
                        <div class="row">
                            <hr class="g-brd-bottom g-brd-gray-light-v7"/>                       
                            <div class="col-md-6">
                                <div class="form-group g-mb-30">
                                    <label class="g-mb-10" for="inputGroup-1_1">Old Password</label>
                                    
                                    <div class="g-pos-rel">
                                        <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                                            <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
                                        </span>
                                        <input id="old_password" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10 " type="password" name="old_password"  required/> 
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group g-mb-30">
                                    <label class="g-mb-10" for="inputGroup-1_1">Password</label>
                                    
                                    <div class="g-pos-rel">
                                        <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                                            <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
                                        </span>
                                        <input id="password" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10 " type="password" name="password" autocomplete="new-password"  required/> 
                                       
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group g-mb-30">
                                    <label class="g-mb-10" for="inputGroup-1_1">Confirm Password</label>
                                    
                                    <div class="g-pos-rel">
                                        <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                                            <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
                                        </span>
                                        <input id="confirm_password" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="password" name="password_confirmation" autocomplete="new-password" required/> 
                                    </div>
                                </div>
                            </div>                          
                        </div>
                        
                    </div>
                    
                    <button class="btn btn-md btn-success" type="submit">Change Password</button>

                    </div>
                </div>
                
                
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
@endpush