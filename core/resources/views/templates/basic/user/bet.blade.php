@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));" class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">

            
            <div align="center" class="col pt-2"><h4 class="text-light">All Bets</h4></div>
            
        </div>

    </div>

    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">@lang('Match')</th>
                                <th class="text-white">@lang('Betted Score')</th>
                                <th class="text-white">@lang('Betted Amount')</th>
                                <th class="text-white">@lang('Reward if Won')</th>
                                <th class="text-white">@lang('Result')</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bets as $item)
                                <tr>
                                    <td data-label="@lang('Match')">{{__($item->match->team_1)}} <font color="red">VS</font>
                                    {{__($item->match->team_2)}}
                                    </td>
                                  
                                    <td data-label="@lang('Score')">{{__($item->option->dividend)}}:{{__($item->option->divisor)}} ( <font color="yellow">{{__($item->option->profit)}}%</font> ) </td>
                                    <td data-label="@lang('Invest')">{{getAmount($item->invest_amount)}} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Return')">
                                        
                                        <?php 
                                        $p = getAmount($item->option->profit);
                                        $p = 0.01 * $p;
                                        $p = $p * $item->invest_amount;
                                        $d = getAmount($item->invest_amount) + getAmount($p);
                                        ?>
                                      
                                        {{
                                        getAmount($d)
                                        }}
                                        
                                        {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Result')">
                                        @php echo $item->statusBadge @endphp
                                    </td>
                                   
                                </tr>
                            @empty
                                <tr><td colspan="100%" class="text-center">{{__($emptyMessage)}}</td></tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{$bets->links()}}
                </ul>
            </div>
        </div>
    </section>

    <div class="modal cmn--modal fade" id="detailsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col text-center match-name" id="exampleModalLabel">@lang('Login Required')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="predict-content">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                @lang('Question') <span class="subtitle question"></span>
                            </li>
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span>@lang('My Choice Was ')</span> <span class="choice text--base"></span>
                            </li>
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span><b>@lang('Invested Amount ')</b></span> <span class="invest text--base"></span>
                            </li>
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span><b>@lang('Return Amount ')</b></span> <span class="return text--base"></span>
                            </li>

                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span><b>@lang('Result')</b></span> <span class="status text--base"></span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";

            $('.detailBtn').on('click', function() {
                var modal       = $('#detailsModal');
                var match       = $(this).data('match');
                var question    = $(this).data('question');
                var choice      = $(this).data('choice');
                var investAmount= $(this).data('invest_amount');
                var returnAmount= $(this).data('return_amount');
                var statusBadge = $(this).data('status_badge');

                modal.find('.match-name').text(match);
                modal.find('.question').text(question);
                modal.find('.choice').text(choice);
                modal.find('.invest').html(`${parseFloat(investAmount).toFixed(2)} {{__($general->cur_text)}}`);
                modal.find('.return').html(`${parseFloat(returnAmount).toFixed(2)} {{__($general->cur_text)}}`);
                modal.find('.status').html(statusBadge);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
