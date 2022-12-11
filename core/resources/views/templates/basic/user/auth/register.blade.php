@extends($activeTemplate.'layouts.auth')
@section('content')
    @php
        $policyElements =  getContent('policy_pages.element');
	    $authBackground =  getContent('auth_page.content',true)->data_values;
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
            <a href="{{ route('user.login') }}" class="headerButton">
                <div class="btn btn-sm btn-success">Login</div>
            </a>
        </div>
    </div>
    <!-- * App Header -->


    <div id="appCapsule">
    
        <div  align="center" class="container">
            <div class="section mt-2 text-center bg-primary rounded-pill p-1 w-75 shadow">
                <h1 class="text-white">Register now</h1>
                <h4 class="text-white">Create an account</h4>
            </div>
        </div>
    
    
    
        <section class="section mb-5 p-2 pt-120 pb-120">
            
        <div class="card bg-primary">
              <div class="card-body">
              
            <div class="row justify-content-center">
              <div class="col">
                <div class="login-area">
                 
                  <form class="action-form mt-50 loginForm" action="{{ route('user.register') }}" method="post">
                    @csrf
                    @if(session()->get('reference') != null)
                        <div class="form-group basic">
                            <label class="label text-white">@lang('Reference By')</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-warning" name="referBy" id="referenceBy" value="{{session()->get('reference')}}" readonly>
                            </div>
                        </div>
                        
                    @else
                    
                    <div class="form-group basic">
                            <label class="label text-white">@lang('Refer Code') <span class="text-dark">(Optional)</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control text-warning" name="referBy" id="referenceBy" value="" >
                            </div>
                        </div>
                    
                    @endif
                    
                    
                    <div class="form-group basic">
                      <label class="label text-white">@lang('First Name')</label>
                      <input type="text" name="firstname" placeholder="@lang('First Name')" class="form-control text-warning" value="{{ old('firstname') }}">
                    </div><!-- form-group end -->
                    
                    
                    <div class="form-group basic">
                      <label class="label text-white">@lang('Last Name')</label>
                      <input type="text" name="lastname" placeholder="@lang('Last Name')" class="form-control text-warning" value="{{ old('lastname') }}">
                    </div><!-- form-group end -->
                    
                    
                    <div class="form-group basic">
                      <label class="label text-white">E-mail <span class="text-dark">(Optional)</span></label>
                      <input type="email" name="email" placeholder="@lang('Your e-mail')" class="form-control checkUser text-warning" value="{{ old('email') }}">
                    </div><!-- form-group end -->
                    
    
                    <div class="form-group basic">
                        <label class="label text-white" for="country">{{ __('Country') }}</label>
                        <select name="country" id="country" class="form-control text-warning">
                            @foreach($countries as $key => $country)
                                <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group basic">
                        <label class="label text-white" for="mobile">@lang('Mobile')</label>
                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-warning mobile-code">
                                        
                                    </span>
                                    <input type="hidden" name="mobile_code">
                                    <input type="hidden" name="country_code">
                                </div>
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control checkUser text-warning" placeholder="@lang('Your Phone Number')">
                            </div>
                            <small class="text-danger mobileExist"></small>
                        </div>
                    </div>
    
                    <div class="form-group basic">
                      <label class="label text-white">@lang('Username')</label>
                      <input type="text" name="username" placeholder="@lang('Username')" class="form-control checkUser text-warning" value="{{ old('username') }}">
                      <small class="text-danger usernameExist"></small>
                    </div><!-- form-group end -->
                    
                    <div class="form-group basic hover-input-popup">
                      <label class="label text-white">Password</label>
                      <input type="password" name="password" placeholder="@lang('Password')" class="form-control text-warning">
                       @if($general->secure_password)
                          <div class="input-popup">
                            <p class="error lower">@lang('1 small letter minimum')</p>
                            <p class="error capital">@lang('1 capital letter minimum')</p>
                            <p class="error number">@lang('1 number minimum')</p>
                            <p class="error special">@lang('1 special character minimum')</p>
                            <p class="error minimum">@lang('6 character password')</p>
                          </div>
                      @endif
                    </div><!-- form-group end -->
                    
                    <div class="form-group basic">
                      <label class="label text-white">@lang('Re-type Password')</label>
                      <input type="password" name="password_confirmation" placeholder="@lang('Re-type Password')" class="form-control text-warning">
                    </div><!-- form-group end -->


                    <div class="cmn--form--group form-group col-md-12 google-captcha">
                        @php echo loadReCaptcha() @endphp
                    </div>
                    @include($activeTemplate.'partials.custom_captcha')



                    @if($general->agree)
                    <div class="form-group">
                        @php
                          $links = getContent('footer_link.element');
                        @endphp
                        <input type="checkbox" name="agree" required class="mr-2">
                        @lang('I agree with ')@foreach($links as $link) 
                        <a href="{{ route('links',[$link->id,slug($link->data_values->title)]) }}"> {{ __($link->data_values->title) }} </a>
                        @if(!$loop->last) , @endif @endforeach
                    </div><!-- form-group end -->
                    @endif
                    <div class="form-button-group text-center transparent">
                      <button type="submit" class="cmn-btn btn btn-success btn-block btn-lg">@lang('Register Now')</button>
                      
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
          
        </section>
    
    </div>








    
@endsection

@push('style')
<style>
    .country-code .input-group-prepend .input-group-text{
        background: #fff !important;
    }
    .country-code select{
        border: none;
    }
    .country-code select:focus{
        border: none;
        outline: none;
    }
    .hover-input-popup {
        position: relative;
    }
    .hover-input-popup:hover .input-popup {
        opacity: 1;
        visibility: visible;
    }
    .input-popup {
        position: absolute;
        bottom: 130%;
        left: 50%;
        width: 280px;
        background-color: #1a1a1a;
        color: #fff;
        padding: 20px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        opacity: 0;
        visibility: hidden;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }
    .input-popup::after {
        position: absolute;
        content: '';
        bottom: -19px;
        left: 50%;
        margin-left: -5px;
        border-width: 10px 10px 10px 10px;
        border-style: solid;
        border-color: transparent transparent #1a1a1a transparent;
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }
    .input-popup p {
        padding-left: 20px;
        position: relative;
    }
    .input-popup p::before {
        position: absolute;
        content: '';
        font-family: 'Line Awesome Free';
        font-weight: 900;
        left: 0;
        top: 4px;
        line-height: 1;
        font-size: 18px;
    }
    .input-popup p.error {
        text-decoration: line-through;
    }
    .input-popup p.error::before {
        content: "\f057";
        color: #ea5455;
    }
    .input-popup p.success::before {
        content: "\f058";
        color: #28c76f;
    }
</style>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush

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
        (function ($) {
            @if($mobile_code)
                $(`option[data-code={{ $mobile_code }}]`).attr('selected','');
            @endif

            $('select[name=country]').change(function(){
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            @if($general->secure_password)
                $('input[name=password]').on('input',function(){
                    secure_password($(this));
                });
            @endif

            $('.checkUser').on('focusout',function(e){
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {mobile:mobile,_token:token}
                }
                if ($(this).attr('name') == 'email') {
                    var data = {email:value,_token:token}
                }
                if ($(this).attr('name') == 'username') {
                    var data = {username:value,_token:token}
                }
                $.post(url,data,function(response) {
                  if (response['data'] && response['type'] == 'email') {
                    $('#existModalCenter').modal('show');
                  }else if(response['data'] != null){
                    $(`.${response['type']}Exist`).text(`${response['type']} already exist`);
                  }else{
                    $(`.${response['type']}Exist`).text('');
                  }
                });
            });

        })(jQuery);

    </script>
@endpush
