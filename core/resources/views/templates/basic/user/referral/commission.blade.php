@extends($activeTemplate.'layouts.frontend')
@section('content')

    <div style="" class="container pt-5 pb-3 mt-5 mb-2 bg-warning">
        <div class="row">

            
            <div align="center" class="col pt-2"><h4 class="text-light">Commissions</h4></div>
            
        </div>

    </div>


    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="btn--group justify-content-center mb-1">
                    <a href="@if(request()->routeIs('user.referral.commissions.deposit')) javascript:void(0) @else {{route('user.referral.commissions.deposit')}} @endif" class="cmn--btn btn--sm btn-primary w-100 @if(request()->routeIs('user.referral.commissions.deposit')) btn-disabled @endif">@lang('Deposit Bonus')</a>

                    <a href="@if(request()->routeIs('user.referral.commissions.bet')) javascript:void(0) @else {{route('user.referral.commissions.bet')}} @endif" class="cmn--btn btn--sm btn-warning w-100 @if(request()->routeIs('user.referral.commissions.bet')) btn-disabled @endif">@lang('Bet Bonus')</a>
                    
                    <a href="@if(request()->routeIs('user.referral.commissions.win')) javascript:void(0) @else {{route('user.referral.commissions.win')}} @endif" class="cmn--btn btn--sm btn-dark w-100 @if(request()->routeIs('user.referral.commissions.win')) btn-disabled @endif">@lang('Won Bet Bonus')</a>
                </div>
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary rounded">
                            <tr>
                                <th class="text-white">@lang('Date')</th>
                                <th class="text-white">@lang('From')</th>
                                <th class="text-white">@lang('Amount')</th>
                                <th class="text-white">@lang('Details')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $data)
                                <tr class="bg-success">
                                    <td data-label="@lang('Date')">{{showDateTime($data->created_at,'d M, Y')}}</td>
                                    <td data-label="@lang('From')"><strong>{{@$data->bywho->username}}</strong></td>
                                    <td data-label="@lang('Amount')">{{__($general->cur_sym)}}{{getAmount($data->comission_amount)}}</td>
                                    <td data-label="@lang('Type')">{{__($data->details)}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="100%">{{__($emptyMessage)}}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{$logs->links()}}
                </ul>
            </div>
        </div>
    </section>
@endsection
