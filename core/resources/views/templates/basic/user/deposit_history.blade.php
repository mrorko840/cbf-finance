@extends($activeTemplate.'layouts.frontend')
@section('content')


    <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));" class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">

            
            <div align="center" class="col pt-2"><h4 class="text-light">Deposit History</h4></div>
            
        </div>

    </div>
    
    <section class="cmn-section">
    <div class="container">
          
                                @if(count($logs) >0)
                                    @foreach($logs as $k=>$data)
                                    
                <div class="card table-card mt-2 pt-1">
                    <div class="card-body p-o">
                        <div class="table-responsive--sm">
                            
                                        <div class="row">   
                                            <div align="left" class="col-6"><h4>Deposit</h4></div>
                                            
                                            <div align="right" class="col-6"> <h3 class="text-danger">{{showAmount($data->amount)}} {{$general->cur_text}}</h3></div>
                                        </div>   
                                            
                                            
                                        <div class="row">
                                                
                                            <div align="left" class="col-6"><h5>{{date(' d M, Y ', strtotime($data->created_at))}}</h5></div>
                                            
                                            
                                            <div align="right" class="col-6"><h5>
                                                @if($data->status == 1)
                                                    <span class="badge badge-success">@lang('Complete')</span>
                                                @elseif($data->status == 2)
                                                    <span class="badge badge-warning">@lang('Pending')</span>
                                                @elseif($data->status == 3)
                                                    <span class="badge badge-danger">@lang('Cancel')

                                                @endif
                                                </h5>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                                
                                            <div align="left" class="col-6"><h5>Trx : {{$data->trx}}</h5></div>
                                            
                                            @php
                                            $details = ($data->detail != null) ? json_encode($data->detail) : null;
                                            @endphp
                                            
                                            <div align="right" class="col-6">
                                                <h5>More: 
                                                    <a href="javascript:void(0)" class="badge badge--success approveBtn"
                                                data-info="{{ $details }}"
                                                data-id="{{ $data->id }}"
                                                data-amount="{{ showAmount($data->amount)}} {{ __($general->cur_text) }}"
                                                data-charge="{{ showAmount($data->charge)}} {{ __($general->cur_text) }}"
                                                data-after_charge="{{ showAmount($data->amount + $data->charge)}} {{ __($general->cur_text) }}"
                                                data-rate="{{ showAmount($data->rate)}} {{ __($data->method_currency) }}"
                                                data-payable="{{ showAmount($data->final_amo)}} {{ __($data->method_currency) }}">
                                                <i class="fa fa-desktop"></i>
                                            </a>
                                                </h5>
                                            </div>
                                        </div>
        
                                            
                        </div>
                    </div>
                </div>
                                        
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%" class="text-center"> @lang('No results found')!</td>
                                    </tr>
                                @endif
                                
                           
                        </div>
                    </div>
                </div>

    </div>
</section>



<section style="height: 90px;">

</section>







{{--
    <section class="dashboard-section bg--section pt-120">
        <div class="container">
            <div class="pb-120">
                <div class="text-end mb-4">
                    <a href="{{route('user.deposit')}}" class="cmn--btn btn--sm">@lang('Deposit Now')</a>
                </div>
                <div class="table-responsive">
                    <table class="table cmn--table">
                        <thead>
                            <tr>
                                <th>@lang('Transaction ID')</th>
                                <th>@lang('Gateway')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Time')</th>
                                <th> @lang('More')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($logs) >0)
                                @foreach($logs as $k=>$data)
                                    <tr>
                                        <td data-label="#@lang('Transaction ID')">{{$data->trx}}</td>
                                        <td data-label="@lang('Gateway')">{{ __(@$data->gateway->name)  }}</td>
                                        <td data-label="@lang('Amount')">
                                            <strong>{{showAmount($data->amount)}} {{__($general->cur_text)}}</strong>
                                        </td>
                                        <td>
                                            @if($data->status == 1)
                                                <span class="badge badge--success">@lang('Complete')</span>
                                            @elseif($data->status == 2)
                                                <span class="badge badge--warning">@lang('Pending')</span>
                                            @elseif($data->status == 3)
                                                <span class="badge badge--danger">@lang('Cancel')</span>
                                            @endif

                                            @if($data->admin_feedback != null)
                                                <a href="javascript:void(0)" class="badge badge--info detailBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></a>
                                            @endif

                                        </td>
                                        <td data-label="@lang('Time')">
                                            <i class="fa fa-calendar text--base"></i> {{showDateTime($data->created_at)}}
                                        </td>

                                        @php
                                            $details = ($data->detail != null) ? json_encode($data->detail) : null;
                                        @endphp

                                        <td data-label="@lang('More')">
                                            <a href="javascript:void(0)" class="badge badge--success approveBtn"
                                                data-info="{{ $details }}"
                                                data-id="{{ $data->id }}"
                                                data-amount="{{ showAmount($data->amount)}} {{ __($general->cur_text) }}"
                                                data-charge="{{ showAmount($data->charge)}} {{ __($general->cur_text) }}"
                                                data-after_charge="{{ showAmount($data->amount + $data->charge)}} {{ __($general->cur_text) }}"
                                                data-rate="{{ showAmount($data->rate)}} {{ __($data->method_currency) }}"
                                                data-payable="{{ showAmount($data->final_amo)}} {{ __($data->method_currency) }}">
                                                <i class="fa fa-desktop"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="100%" class="text-enter">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{$logs->links()}}
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
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0">@lang('Details')</h6>
                    <span data-bs-dismiss="modal"><i class="las la-times"></i></span>
                </div>
                <div class="modal-body">
                    <div class="withdraw-detail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#approveModal');
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-charge').text($(this).data('charge'));
                modal.find('.withdraw-after_charge').text($(this).data('after_charge'));
                modal.find('.withdraw-rate').text($(this).data('rate'));
                modal.find('.withdraw-payable').text($(this).data('payable'));
                var list = [];
                var details =  Object.entries($(this).data('info'));

                var ImgPath = "{{asset(imagePath()['verify']['deposit']['path'])}}/";
                var singleInfo = '';
                for (var i = 0; i < details.length; i++) {
                    if (details[i][1].type == 'file') {
                        singleInfo += `<li class="list-group-item">
                                            <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <img src="${ImgPath}/${details[i][1].field_name}" alt="@lang('Image')" class="w-100">
                                        </li>`;
                    }else{
                        singleInfo += `<li class="list-group-item">
                                            <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <textarea class="form-control shadow-sm text-warning" rows="2">${details[i][1].field_name}</textarea>
                                        </li>`;
                    }
                }

                if (singleInfo)
                {
                    modal.find('.withdraw-detail').html(`<br><strong class="my-3">@lang('Payment Information')</strong>  ${singleInfo}`);
                }else{
                    modal.find('.withdraw-detail').html(`${singleInfo}`);
                }
                modal.modal('show');
            });

            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush

