    @extends('main.master')

    @section('main-section')

    @php
        $destinations = [
            'Kathmandu', 'Pokhara', 'Kalinchowk', 'Manakamana', 'Dolakha', 'Delhi'
        ];
        $payment_methods = [
            'Cash', 'E-sewa', 'FonePay', 'Bank Transfer', 'Other'
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
                    <span class="g-valign-middle">Update Ticket Payment</span>
                </li>
            </ul>
        </div>
        
        
        <!-- End Breadcrumb-v1 -->
        {{-- Form Start --}}
        <div class="g-pa-20">
            <h1 class="g-font-weight-300 g-font-size-28 g-color-black g-mb-28">Update Ticket Payment</h1>
            
            <form method="POST" action="{{ route('ticket_payment.update',$ticket_payment->id) }}">
                @csrf
                @include('common.form_error')
                <div class="row">

                    
                    <div class="col-md-12">
                        <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
                            <h3 class="col-12 row">Update Ticket Payment</h3>
                            {{-- Departure Detail --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group g-mb-30">
                                        <label class="g-mb-10" for="inputGroup-1_1">Amount Paid (Rs.)*</label>
                                        
                                        <div class="g-pos-rel">
                                            <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                                                <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
                                            </span>
                                            <input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="number" placeholder="Amount Paid" name="amount_paid" value="{{ old('amount_paid', $ticket_payment->amount) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group g-mb-30">
                                        <label class="g-mb-10" for="inputGroup-1_1">Ticket Price (Rs.)*</label>
                                        
                                        <div class="g-pos-rel">
                                            <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                                                <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-secondary"></i>
                                            </span>
                                            <input id="inputGroup-1_1" value="{{$ticket_price}}" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="number" placeholder="Ticket Price" name="ticket_price" >
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

                                                

                                                @foreach( $payment_methods as $payment_method )
                                                    <option value="{{$payment_method}}" {{ (old('payment_method',isset($ticket_payment->payment_method) ? $ticket_payment->payment_method : '' ) == $payment_method)?'selected="selected"':'' }}>{{$payment_method }}</option>

                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                                                          
                            </div>
                            {{-- End Departure Detail --}}
                        </div>                     

                        <button class="btn btn-md btn-success" type="submit">Update Ticket Payment</button>

                        </div>
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