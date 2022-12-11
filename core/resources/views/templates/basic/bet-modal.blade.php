@auth

    <style>
        /*.predicts table tbody tr a.active {*/
        /*background: green !important;*/
        /*border-color: green !important;*/
        /*}*/
        .predicts table tbody tr a:focus,
        .predicts table tbody tr a:hover {
            background: green !important;
            border-color: green !important;
        }

        /*.predicts td a.active2 {*/
        /*background: green !important;*/
        /*}*/
        /*.active {*/
        /*background: green !important;*/
        /*}*/
    </style>

    <div class="modal-body">
        @csrf
        <input type="hidden" name="option_id">
        <div class="predict-content">
            <h6 class="subtitle betting-details">

                {{ $match->team_1 }}
                <font color="red">VS</font> {{ $match->team_2 }}


            </h6>


            <b>Select Score</b>

            <!--<div class="container predicts ps-0">-->


            <!--                @foreach ($answers as $data)
    -->

            <!--                <div class="row bg-warning rounded p-1 m-1">-->
            <!--                    <div align="center" class="col-6">{{ getAmount($data->dividend) }} : {{ getAmount($data->divisor) }}</div>-->
            <!--                    <div align="center" class="col-6">{{ $data->profit }}%</div>-->
            <!--                </div>-->


            <!--<tr align="center">-->
            <!--    <td data-label="@lang('Item')"><b style="color: red;font-size: 15px;">{{ getAmount($data->dividend) }} : {{ getAmount($data->divisor) }}</b></td>-->
            <!--    <td data-label="@lang('Profit')">{{ $data->profit }}%</td>-->
            <!--    <td data-label="@lang('Action')">-->
            <!--        <a class="btn btn-sm btn-warning cfc" href="javascript:void(0);" data-profit="{{ $data->profit }}" data-id="{{ $data->id }}">-->
            <!--                Select-->
            <!--        </a> &nbsp;-->
            <!--    </td>-->
            <!--</tr>-->





            <!--<li>-->
            <!--    <a class="pf" href="javascript:void(0);" data-profit="{{ $data->profit }}" data-id="{{ $data->id }}">-->
            <!--        <span>{{ getAmount($data->dividend) }} : {{ getAmount($data->divisor) }}</span>-->
            <!--        <span style="color: #f7bf42;font-size: 15px;">{{ $data->profit }}%</span>-->
            <!--    </a> &nbsp;-->
            <!--</li>-->

            <!--
    @endforeach-->

            <!--</div>-->

            <ul class="predicts ps-0">
                <table class="table table-striped">

                    <thead class="thead-dark">
                        <tr align="center">
                            <th>@lang('Item')</th>
                            <th>@lang('Profit')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($answers as $data)
                            <tr align="center">
                                <td data-label="@lang('Item')"><b
                                        style="color: red;font-size: 15px;">{{ getAmount($data->dividend) }} :
                                        {{ getAmount($data->divisor) }}</b></td>
                                <td data-label="@lang('Profit')">{{ $data->profit }}%</td>
                                <td data-label="@lang('Action')">
                                    <a class="btn btn-sm btn-warning cfc" href="javascript:void(0);"
                                        data-profit="{{ $data->profit }}" data-id="{{ $data->id }}">
                                        Select
                                    </a> &nbsp;
                                </td>
                            </tr>





                            <!--<li>-->
                            <!--    <a class="pf" href="javascript:void(0);" data-profit="{{ $data->profit }}" data-id="{{ $data->id }}">-->
                            <!--        <span>{{ getAmount($data->dividend) }} : {{ getAmount($data->divisor) }}</span>-->
                            <!--        <span style="color: #f7bf42;font-size: 15px;">{{ $data->profit }}%</span>-->
                            <!--    </a> &nbsp;-->
                            <!--</li>-->
                        @endforeach
                    </tbody>
                </table>
            </ul>

            <br />


            <div class="form-group text-start">
                <div class="row">


                    <div style="display:none" id="msg">

                    </div>

                    <div class="form-group">
                        <label for="amount" class="mb-2">@lang('Enter Bet Amount')</label>
                        <div class="input-group">
                            <input style="color:red! important" type="number" step="any" id="invest-amount"
                                name="invest_amount" min="{{ $general->min_limit }}" max="{{ $general->max_limit }}"
                                class="form-control" required>
                            <span align="right" class="input-group-text bg-info rounded-end text-dark">
                                {{ __($general->cur_text) }}</span>
                        </div>

                        <div style="color:red" id="min-bet" style="display:none"><b>Minimum bet is 10$</b></div>




                        <h6 class="mt-2 text-center">

                            <span>Profit : </span>
                            <span id="ppf" style="color: #f7bf42;font-size: 15px;">0</span><span
                                style="color: #f7bf42;font-size: 15px;">%</span>
                            <!--<br/>
                                            <span>Processing Fee : </span>
                                            <span style="color: #f7bf42;font-size: 15px;">1% </span>
                                            -->
                            <br />
                            @lang('You will get') <span class="text--success" id="return-amount">0.00
                                {{ __($general->cur_text) }}</span> @lang('if you win')

                            <br />
                            Current Balance : <b> {{ getAmount(Auth::user()->balance) }} {{ __($general->cur_text) }} </b>

                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn bg-danger text--white border-0 fz--16"
            data-bs-dismiss="modal">@lang('Close')</button>
        <button id="place-bet" class="btn btn-success border-0 fz--16">@lang('Proceed')</button>
    </div>
@else
    <div class="modal-body bg-warning">
        <h5 class="modal-title col text-center">@lang('Login Required')</h5>

        <div class="predict-content">
            <h6 class="subtitle">
                @lang('Placing Bet Requires Login')
            </h6>
            <div class="be-in-limit">
                <span>@lang('If you are already with us then please ')</span> <span><a href="{{ route('user.login') }}"
                        class="text-danger">@lang('login')</a></span> <span>@lang('otherwisw')</span> <span><a
                        href="{{ route('user.register') }}" class="text-danger">@lang('register')</a></span>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-warning">
        <button type="button" class="btn bg--danger text--white border-0 fz--16"
            data-bs-dismiss="modal">@lang('Close')</button>
        <a href="{{ route('user.login') }}" class="btn  btn--success border-0 fz--16">@lang('Login')</a>
    </div>


    @endif
