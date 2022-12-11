@extends($activeTemplate.'layouts.frontend')
@section('content')
 <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));" class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">

            
            <div align="center" class="col pt-2"><h4 class="text-light">My Team</h4>
            <b>LEVEL - {{ $levelNo }} </b>
            </div>
            
        </div>

    </div>
    
   
    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="text-end mb-2">
                    @for($i = 1; $i <= $lev; $i++)
                        <a href="{{route('user.referral.users',$i)}}" class="cmn--btn btn--sm">@lang('Level '.$i)</a>
                    @endfor
                </div>
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white" scope="col">@lang('SL')</th>
                                <th class="text-white" scope="col">@lang('Username')</th>
                                <th class="text-white" scope="col">@lang('Joined At')</th>
                                <th class="text-white" scope="col">@lang('First Deposit')</th>
                                <th class="text-white" scope="col">@lang('Super Agent')</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ showUserLevel(auth()->user()->id, $levelNo) }}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
