@extends($activeTemplate.'layouts.frontend')
@section('content')


    <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));" class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">

            
            <div align="center" class="col pt-2"><h4 class="text-light">Transactions</h4></div>
            
        </div>

    </div>
    
<section class="cmn-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card table-card">
                    <div class="card-body p-0">
                        <div class="table-responsive--sm">
                            <table class="table table-striped">
                                <thead class="bg-primary rounded">
                                <tr>
                                    <th class="text-white">@lang('Amount')</th>
                                    <th class="text-white">@lang('Balance')</th>
                                    <th class="text-white">@lang('Details')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($transactions as $item)
                                <tr>

                                    <td data-label="@lang('Amount')"> 
                                    @if ($item->trx_type == '+')
                                        <span class="text--base">+ {{showAmount($item->amount)}} {{__($general->cur_text)}}</td></span>
                                    @elseif ($item->trx_type == '-')
                                        <span class="text--danger">- {{showAmount($item->amount)}} {{__($general->cur_text)}}</td></span>
                                    @endif

                                    <td data-label="@lang('Post Balance')">{{showAmount($item->post_balance)}} {{__($general->cur_text)}}</td>

                                    <td data-label="@lang('Details')">{{__($item->details)}}</td>
                                </tr>
                                    @empty
                                <tr><td colspan="100%" class="text-center">{{__($emptyMessage)}}</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <ul class="pagination justify-content-end">
                    {{$transactions->links()}}
                </ul>
            </div>
        </div>
    </div>
</section>

<section style="height: 90px;">

</section>
@endsection

