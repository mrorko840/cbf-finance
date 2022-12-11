@extends($activeTemplate.'layouts.auth')

@section('content')
    @php
	    $authBackground = getContent('auth_page.content',true)->data_values;
    @endphp



    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
            <a href="{{ route('user.register') }}" class="headerButton">
                <div class="btn btn-sm btn-success">Register</div>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div  align="center" class="container">
            <div class="section mt-2 text-center bg-primary rounded-pill p-1 w-75 shadow">
                <h1 class="text-white">Log in</h1>
                <h4 class="text-info">Fill the form to log in</h4>
            </div>
        </div>
        <div class="section mb-5 p-2">

            <form class="action-form mt-50 loginForm" action="{{ route('user.login') }}" method="post">
                @csrf
                <div class="card bg-primary">
                    <div class="card-body pb-1">
                        
                        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label text-white">Username</label>
                                <input type="username" name="username" class="form-control text-warning" placeholder="@lang('Your Username')">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label text-white">Password</label>
                                <input type="password" name="password" class="form-control text-warning" placeholder="@lang('Your Password')">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="container">
                <div class="cmn--form--group form-group mt-3">
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="checkgroup text--white d-flex align-items-center">
                            <input type="checkbox" class="border-0 form--checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="m-0 pl-2 text-dark">@lang('Remember Me')</label>
                        </div>
                        <a href="{{route('user.password.request')}}" class="text--base">@lang('Forget Password?')</a>
                    </div>
                </div>
            </div>
                
                <div class="form-group d-flex justify-content-center">
                  
                </div><!-- form-group end -->
            <div class="container bg-dark p-1 rounded">
                <div class="cmn--form--group form-group col-md-12 google-captcha">
                    @php echo loadReCaptcha() @endphp
                </div>
                @include($activeTemplate.'partials.custom_captcha')
            </div> 
                <div class="form-button-group  transparent">
                    <button type="submit" class="btn btn-success btn-block btn-lg cmn-btn">Log in</button>
                </div>

                

            </form>
        </div>

    </div>
    <!-- * App Capsule -->


@endsection

@push('script')
    <script>
        "use strict";
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
    </script>
@endpush
