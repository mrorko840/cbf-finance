@extends($activeTemplate.'layouts.frontend')
@section('content')
    
    <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));" class="container pt-5 pb-3 mt-5">
        <div class="row">

            <div align="center" class="col pt-2"><h4 class="text-light">Withdraw History</h4></div>
            
        </div>

    </div>
    
    
<section class="cmn-section">
    <div class="container">
     
            
                       
                    
                               @forelse($withdraws as $k=>$data)
                    <div class="card table-card mt-2 pt-1">
                        <div class="card-body p-o">
                            <div class="table-responsive--sm">
                                   
                                       
                                <div class="row">

                                    <div align="left" class="col-6"><h4>Withdrawal</h4></div>
                                    <div align="right" class="col-6"> <h3 class="text-danger">{{showAmount($data->final_amount)}} {{$data->currency}}</h3></div>
                                    
                                </div>
                                       
                                       
                                <div class="row">
                                          
                                        <div align="left" class="col-6"><h5>{{date('d M, Y ', strtotime($data->created_at))}}</h5></div>
                                       
                                       
                                       <div align="right" class="col-6">
                                           <h5>
                                                @if($data->status == 2)
                                                    <span class="badge badge--warning">@lang('Pending')</span>
                                                @elseif($data->status == 1)
                                                    <span class="badge badge--success">@lang('Completed')</span>
                                                    <a href="javascript:void(0)" class="badge badge--info approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></a>
                                                @elseif($data->status == 3)
                                                    <span class="badge badge--danger">@lang('Rejected')</span>
                                                    <a class="badge badge--info approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></a>
                                                @endif
                                            </h5>
                                       </div>
                                       
                                       <div class="row">
                                                
                                            <div align="left" class="col-6"><h5>Trx :</h5></div>
                                            
                                            <div align="right" class="col-6">
                                                <h5>{{$data->trx}}</h5>
                                            </div>
                                        </div>
                                        
                                </div>  
                            </div>
                        </div>
                    </div>        
                                       
                                       
                                   
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">@lang('Data not found')</td>
                            </tr>
                            @endforelse
                         
                   
         
   </div>
</section>

<section style="height: 90px;">

</section>


    
    
    {{--
    <section class="dashboard-section bg--section pt-120">
        <div class="container">
            <div class="pb-120">
                <div class="text-end mb-4">
                    <a href="{{route('user.withdraw')}}" class="cmn--btn btn--sm">@lang('Withdraw Now')</a>
                </div>
                <div class="table-responsive">
                    <table class="table cmn--table">
                        <thead>
                            <tr>
                                <th>@lang('Transaction ID')</th>
                                <th>@lang('Gateway')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('After Charge')</th>
                                <th>@lang('Rate')</th>
                                <th>@lang('Receivable')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Time')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdraws as $k=>$data)
                                <tr>
                                    <td data-label="#@lang('Transaction ID')">{{$data->trx}}</td>
                                    <td data-label="@lang('Gateway')">{{ __($data->method->name) }}</td>
                                    <td data-label="@lang('Amount')">
                                        <strong>{{showAmount($data->amount)}} {{__($general->cur_text)}}</strong>
                                    </td>
                                    <td data-label="@lang('Charge')" class="text-danger">
                                        {{showAmount($data->charge)}} {{__($general->cur_text)}}
                                    </td>
                                    <td data-label="@lang('After Charge')">
                                        {{showAmount($data->after_charge)}} {{__($general->cur_text)}}
                                    </td>
                                    <td data-label="@lang('Rate')">
                                        {{showAmount($data->rate)}} {{__($data->currency)}}
                                    </td>
                                    <td data-label="@lang('Receivable')" class="text-success">
                                        <strong class="text--base">{{showAmount($data->final_amount)}} {{__($data->currency)}}</strong>
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if($data->status == 2)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($data->status == 1)
                                            <span class="badge badge--success">@lang('Completed')</span>
                                            <a href="javascript:void(0)" class="badge badge--info approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></a>
                                        @elseif($data->status == 3)
                                            <span class="badge badge--danger">@lang('Rejected')</span>
                                            <a class="badge badge--info approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></a>
                                        @endif

                                    </td>
                                    <td data-label="@lang('Time')">
                                        <i class="fa fa-calendar text--base"></i> {{showDateTime($data->created_at)}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{$withdraws->links()}}
                </ul>
            </div>
        </div>
    </section>
    --}}
    
    
    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade cmn--modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-white">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title m-0 text-white">@lang('Details')</h5>
                    <span data-bs-dismiss="modal"><i class="las la-times"></i></span>
                </div>
                <div class="modal-body">
                    <ul class="list-group shadow rounded">
                        <li class="list-group-item bg-warning">@lang('Amount') : <span class="withdraw-amount "></span></li>
                        <li class="list-group-item bg-info">@lang('Charge') : <span class="withdraw-charge "></span></li>
                        <li class="list-group-item bg-warning">@lang('After Charge') : <span class="withdraw-after_charge"></span></li>
                        <li class="list-group-item bg-info">@lang('Conversion Rate') : <span class="withdraw-rate"></span></li>
                        <li class="list-group-item bg-warning">@lang('Payable Amount') : <span class="withdraw-payable"></span></li>
                    </ul>
                    <ul class="list-group withdraw-detail mt-1">
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Detail MODAL --}}
    <div id="detailModal" class="modal fade cmn--modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-white">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">@lang('Details')</h5>
                    <span data-bs-dismiss="modal">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">

                    <div class="withdraw-detail"></div>

                </div>
                <div class="modal-footer bg-transparent border-primary">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($){
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush
