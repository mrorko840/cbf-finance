@extends($activeTemplate.'layouts.frontend')
@section('content')

    <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));" class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">

            
            <div align="center" class="col pt-2"><h4 class="text-light">Account Setting</h4></div>
            
        </div>

    </div>
    
    <div class="container pb-2" align="right">
        <a href="{{route('user.change.password')}}">
            <div class="btn btn-warning">
                Change Password
            </div>
        </a>
    </div>
    
    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="profile-wrapper bg-white shadow">
                    <div class="profile-user mb-lg-0">
                        <div class="thumb">
                            @if($user->image)
                                <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}" class="rounded-circle" width="150px" alt="user">
                            @else
                                <img src="{{ asset('assets/images/avatar.png') }}" class="rounded-circle" width="150px" alt="user">
                            @endif
                        </div>
                        <div class="content">
                            <h3 class="title">@lang('Name'): {{__($user->fullname)}}</h3>
                            <span class="subtitle">@lang('Username'): {{$user->username}}</span>
                        </div>
                    </div>
                    <div class="profile-form-area">
                        <form class="profile-edit-form row mb--25" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="first-name">@lang('First Name') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstname" value="{{$user->firstname}}" minlength="3" required>
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="last-name">@lang('Last Name') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  name="lastname" value="{{$user->lastname}}" minlength="3" required>
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="email">@lang('E-mail Address') <span class="text-danger">*</span></label>
                                <input name="email" type="text" class="form-control" value="{{$user->email}}">
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="mobile">@lang('Mobile Number') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$user->mobile}}" readonly>
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="address">@lang('Address') </label>
                                <input type="text" class="form-control" name="address" value="{{@$user->address->address}}">
                            </div>
                            
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="zip">@lang('Zip') </label>
                                <input type="text" class="form-control" name="zip" value="{{@$user->address->zip}}">
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="city">@lang('City') </label>
                                <input type="text" class="form-control" name="city" value="{{@$user->address->city}}">
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="country">@lang('Country') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{@$user->address->country}}" disabled>
                            </div>
                            <div class="form--group col-md-12">
                                <label class="cmn--label" for="profile-image">@lang('Profile Picture')</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                            <div class="form--group w-100 col-md-6 mb-0 text-end">
                                <button type="submit" class="cmn--btn w-100 justify-content-center">@lang('Update Profile')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
