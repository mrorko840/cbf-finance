@extends($activeTemplate . 'layouts.frontend')
@section('content')

    @php
        $banners = getContent('banner.element');
        $bannerElements2 = getContent('banner_2.element');
        $fakeCount = getContent('fake_count.content', true);
        $noticeCaption = getContent('notice.content', true);
        $sponsors = getContent('sponsor.element');
        $fake_reviews = getContent('fake_review.element');
    @endphp
    @include($activeTemplate . 'liveonline')


<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @guest
            @include($activeTemplate . 'includes.home.top_nav')
        @endguest
        
        @auth
            @include($activeTemplate . 'includes.top_nav')
            @include($activeTemplate . 'includes.side_nav')
        @endauth
        

        <div class="main-container">

            <!-- Scrolling Banner -->
            <div class="container pb-3">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    
                    <div class="carousel-inner border-custom shadow-sm">
        
                    @php $i=0; @endphp
                    @forelse($banners as $item)
                    @php 
                    $actives = ''; 
                    @endphp
        
                    @if($i==0)
                    @php $actives = 'active';@endphp
                    @endif
                    @php $i=$i+1; @endphp
        
                        <div class="carousel-item <?= $actives ?>">
                        <img class="d-block w-100" src="{{ getImage('assets/images/frontend/banner/' . $item->data_values->image) }}" alt="banner">
                        </div>
                    
                    @empty
        
                    @endforelse
        
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            
            <!-- Scrolling Notice -->
            <div class="row pt-1 mx-2 mb-3">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-body p-0 px-2">
                            <div class="row">
                                <div class="col-auto d-flex align-items-center justify-content-center border-custom bg-warning-light text-warning">
                                    <span class="material-icons">campaign</span>
                                </div>
                                <div class="col align-items-center px-0 mx-0 pt-2">
                                    <marquee behavior="scroll" direction="left">
                                        @php 
                                            echo $noticeCaption->data_values->sliding_notice; 
                                        @endphp
                                    </marquee>
                                </div>
                                <div style="font-size: 10px" class="col-auto d-flex align-items-center justify-content-center border-custom bg-default-secondary">
                                    <span style="font-size: 17px" class="material-icons">groups</span>{{'-'}} <b id="dynamic_counter"></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today & Tomorrow Match Heading -->
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #fff0;" class="nav-link active" id="today-tab" data-toggle="tab" href="#today" role="tab"
                        aria-controls="today" aria-selected="true">Today Match</a>
                </li>
                <li class="nav-item">
                    <a style="background-color: #fff0;" class="nav-link" id="tomorrow-tab" data-toggle="tab" href="#tomorrow" role="tab"
                        aria-controls="tomorrow" aria-selected="false">Tomorrow Match</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">

                <!-- Today Match -->
                <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
                    <div class="mt-4">
                        @foreach ($matches as $item)
                        <div class="container">
                            <div class="card border-0 mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div align="center" class="col-4">
                                            <div class="avatar avatar-50 border-0 bg-danger-light rounded-circle shadow-sm text-danger">
                                                <img width="50" height="50" src="{{ $item->logo_1 }}" alt="team_1">
                                            </div>
                                            <div class="text-center pt-2">
                                                <p>{{ $item->team_1 }}</p>
                                            </div>
                                        </div>
                                        <div style="flex-direction: column;" class="col d-flex align-items-center justify-content-center text-center">
                                            <h6 class="mb-1">{{__($item->category->name)}}</h6><br>
                                            <a class="bet-info btn btn-sm btn-primary border-custom" data-id="{{ $item->id }}" href="javascript:void(0);">
                                                Bet Now
                                            </a>
                                        </div>
                                        <div align="center" class="col-4">
                                            <div class="avatar avatar-50 border-0 bg-danger-light rounded-circle shadow-sm text-danger">
                                                <img width="50" height="50" src="{{ $item->logo_2 }}" alt="item_2">
                                            </div>
                                            <div class="text-center pt-2">
                                                <p>{{ $item->team_2 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tomorrow Match -->
                <div class="tab-pane fade" id="tomorrow" role="tabpanel" aria-labelledby="tomorrow-tab">
                    <div class="mt-4">
                        @foreach ($matches_t as $item)
                        <div class="container">
                            <div class="card border-0 mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div align="center" class="col-4">
                                            <div class="avatar avatar-50 border-0 bg-danger-light rounded-circle shadow-sm text-danger">
                                                <img width="50" height="50" src="{{ $item->logo_1 }}" alt="team_1">
                                            </div>
                                            <div class="text-center pt-2">
                                                <p>{{ $item->team_1 }}</p>
                                            </div>
                                        </div>
                                        <div style="flex-direction: column;" class="col d-flex align-items-center justify-content-center text-center">
                                            <h6 class="mb-1">{{__($item->category->name)}}</h6><br>
                                            <a class="bet-info btn btn-sm btn-primary border-custom" data-id="{{ $item->id }}" href="javascript:void(0);">
                                                Bet Now
                                            </a>
                                        </div>
                                        <div align="center" class="col-4">
                                            <div class="avatar avatar-50 border-0 bg-danger-light rounded-circle shadow-sm text-danger">
                                                <img width="50" height="50" src="{{ $item->logo_2 }}" alt="item_2">
                                            </div>
                                            <div class="text-center pt-2">
                                                <p>{{ $item->team_2 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>

            <!-- Swiper Our Reviews-->
            <div class="container mb-4">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">Our Reviews</h6>
                    </div>
                </div>
                <div class="swiper-container swiper-users ">
                    <div class="swiper-wrapper">
                        @forelse($fake_reviews as $review)

                        <div class="swiper-slide">
                            <div style="min-height: 180px; width: 320px;" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="avatar avatar-60 rounded mb-1">
                                                <div class="background"><img src="{{ getImage('assets/images/frontend/fake_review/'.@$review->data_values->image) }}" alt=""></div>
                                            </div>
                                            <p class="text-secondary mb-0"><small>{{ @$review->data_values->name }}</small></p>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col ">
                                            <p class="mb-1">{{@$review->data_values->review_text}}<small class="text-success" hidden>28% <span class="material-icons small" hidden>call_made</span></small></p>
                                            <p class="text-secondary small">{{ showDateTime(@$review->updated_at, 'd-m-Y, h:i a') }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @empty

                        @endforelse
                        
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- footer-->
    @guest
    @include($activeTemplate . 'includes.home.bottom_nav')
    @endguest
    @auth
    @include($activeTemplate . 'includes.bottom_nav')
    @endauth
    


    
</body>



    {{-- <!-- App Capsule -->
    <div id="appCapsule">

        @if (Request::routeIs('home'))
            <div class="banner-wrapper owl-theme owl-carousel mb-1">
                @foreach ($bannerElements as $item)
                    <div class="banner-item">
                        <img src="{{ route('home') }}/assets/images/frontend/banner/{{ @$item->data_values->image }}"
                            alt="banner">
                    </div>
                @endforeach
            </div>
        @endif


        <div class="row">

            <div class="mb-1">
                <div class="px-2">

                    <div class="row rounded bg-primary shadow-sm">

                        <div align="center" class="col-1 pt-1">
                            <ion-icon name="volume-high-outline" style="font-size: 20px;color: #ffffff"></ion-icon>
                        </div>
                        <div class="col-11">
                            <marquee behavior="scroll" direction="left">
                                <h5 class="align-bottom text-light mt-1">
                                    @php echo $notice->data_values->sliding_notice; @endphp
                                </h5>
                            </marquee>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container-fluid mb-2">
                <div align="center" class="row">
                    <div class="col-3 bg-primary rounded-pill">
                        <h6 class="text-white p-1">Total Deposit</h6>
                        <h5 class="text-white p-1">@php echo $fakeCount->data_values->deposit; @endphp</h5>
                    </div>

                    <div class="col-3 bg-primary rounded-pill">
                        <h6 class="text-white p-1">Total Transcection</h6>
                        <h5 class="text-white p-1">@php echo $fakeCount->data_values->transcetion; @endphp</h5>
                    </div>

                    <div class="col-3 bg-primary rounded-pill">
                        <h6 class="text-white p-1">Total Withdraw</h6>
                        <h5 class="text-white p-1">@php echo $fakeCount->data_values->withdraw; @endphp</h5>
                    </div>

                    <div class="col-3 bg-primary rounded-pill">
                        <h6 class="text-white p-1">Total Member</h6>
                        <h5 class="text-white p-1">@php echo $fakeCount->data_values->member; @endphp</h5>
                    </div>
                </div>

            </div>




            <br />
            <div class="mhome row">


                <div class="col-12 mb-2">

                    <div class="predict__wrapper">

                        <div align="center" class="bg-primary py-1 rounded-top px-0 mx-0">
                            <h3 class="predict__header-title text-white">
                                @if (Request::routeIs('home'))
                                    @lang('--- Today Matches ---')
                                @else
                                    {{ __($pageTitle) }}
                                @endif
                            </h3>
                        </div>

                        <div class="predict__area">

                            <div class="row">
                                @foreach ($matches as $item)
                                    <div class="col-12">
                                        <!--<a class="bet-info" data-id="{{ $item->id }}" href="javascript:void(0);">-->
                                        <div class="stat-box shadow mb-1 mx-0 border border-light center bg-img-match">

                                            <div class="row">
                                                <div align="center" class="col-12 text-white bg-dark rounded">
                                                    {{ date('Y-m-d H:i', strtotime($item->match_time)) }}
                                                </div>

                                                <div class="mt-1 mb-1">
                                                    <div class="row">
                                                        <div align="center" class="col-6 p-1">
                                                            <div style="font-size: 10px;"
                                                                class="text-danger bg-white rounded">{{ $item->team_1 }}
                                                            </div>
                                                        </div>
                                                        <div align="center" class="col-6 p-1">
                                                            <div style="font-size: 10px;"
                                                                class="text-danger bg-white rounded">{{ $item->team_2 }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div align="right" class="col-4 mt-1"><img
                                                                src="{{ $item->logo_1 }}" width="50px" height="50px"
                                                                class="rounded-circle shadow" alt="team-1"></div>
                                                        <div align="center" class="col-4 mt-1 pt-2"><img style="width:60px;"
                                                                src="{{ url('/assets/images') }}/vs-2.png" /></div>
                                                        <div align="left" class="col-4 mt-1"><img
                                                                src="{{ $item->logo_2 }}" width="50px" height="50px"
                                                                class="rounded-circle shadow" alt="team-2"></div>
                                                    </div>
                                                    <div class="row mt-1">
                                                        <a class="bet-info col-12" data-id="{{ $item->id }}"
                                                            href="javascript:void(0);">
                                                            <div align="center" class=" mt-1 bg-primary rounded shadow">Bet
                                                                Place</div>
                                                        </a>
                                                    </div>
                                                </div>

                                                <!--<div class="mt-1 mb-1" disabled align="center" style="font-size:14px;color:yellow">Match Starts In : -->
                                                <!--    <span data-date="{{ date('Y-m-d H:i:s', strtotime($item->match_time)) }}" class="mtime"></span>-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                        <!--</a>-->
                                    </div>
                                   
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>

                @if (Request::routeIs('home'))
                    <!--<div class="container">-->
                    <div class="banner-wrapper owl-theme owl-carousel mb-3">
                        @foreach ($bannerElements2 as $item)
                            <div class="banner-item">
                                <!--<a href="{{ @$item->data_values->url }}" class="d-block">-->
                                <img src="{{ route('home') }}/assets/images/frontend/banner_2/{{ @$item->data_values->image2 }}"
                                    alt="banner">

                                <!--</a>-->
                            </div>
                        @endforeach
                    </div>
                    <!--</div>-->
                @endif




                <div class="col-12 mb-2">


                    <div class="predict__wrapper">
                        <div align="center" class="bg-primary py-1 rounded-top">
                            <h3 class="predict__header-title text-white">
                                @if (Request::routeIs('home'))
                                    @lang('--- Tommorow Matches ---')
                                @else
                                    {{ __($pageTitle) }}
                                @endif
                            </h3>
                        </div>

                        <div class="predict__area">

                            <div class="row">
                                @foreach ($matches_t as $item)
                                    <div class="col-12">
                                        <!--<a class="bet-info" data-id="{{ $item->id }}" href="javascript:void(0);">-->
                                        <div class="stat-box shadow mb-1 mx-0 border border-light center bg-img-match2">

                                            <div class="row">
                                                <div align="center" class="col-12 text-white bg-dark rounded">
                                                    {{ date('Y-m-d H:i', strtotime($item->match_time)) }}
                                                </div>

                                                <div class="mt-1 mb-1">
                                                    <div class="row">
                                                        <div align="center" class="col-6 p-1">
                                                            <div style="font-size: 10px;"
                                                                class="text-danger bg-white rounded">{{ $item->team_1 }}
                                                            </div>
                                                        </div>
                                                        <div align="center" class="col-6 p-1">
                                                            <div style="font-size: 10px;"
                                                                class="text-danger bg-white rounded">{{ $item->team_2 }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div align="right" class="col-4 mt-1"><img
                                                                src="{{ $item->logo_1 }}" width="50px" height="50px"
                                                                class="rounded-circle shadow" alt="team-1"></div>
                                                        <div align="center" class="col-4 mt-1 pt-2"><img
                                                                style="width:60px;"
                                                                src="{{ url('/assets/images') }}/vs-2.png" /></div>
                                                        <div align="left" class="col-4 mt-1"><img
                                                                src="{{ $item->logo_2 }}" width="50px" height="50px"
                                                                class="rounded-circle shadow" alt="team-2"></div>
                                                    </div>
                                                    <div class="row mt-1">
                                                        <a class="bet-info col-12" data-id="{{ $item->id }}"
                                                            href="javascript:void(0);">
                                                            <div align="center" class=" mt-1 bg-primary rounded shadow">
                                                                Bet Place</div>
                                                        </a>
                                                    </div>
                                                </div>

                                                <!--<div class="mt-1 mb-1" disabled align="center" style="font-size:14px;color:yellow">Match Starts In : -->
                                                <!--    <span data-date="{{ date('Y-m-d H:i:s', strtotime($item->match_time)) }}" class="mtime"></span>-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                        <!--</a>-->
                                    </div>
                                @endforeach
                            </div>


                        </div>

                    </div>


                </div>

            </div>

            <!-- Send Money -->
            <div class="section full mt-4">
                <div class="section-heading padding">
                    <h2 class="title">Powered By</h2>
                    <!--<a href="#" class="link">Add New</a>-->
                </div>

                <!-- carousel small -->
                <div class="carousel-small splide mb-5">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @forelse($sponsors as $sponsor)
                                <li class="splide__slide">
                                    <a href="#">
                                        <div class="user-card">
                                            <img src="assets/images/frontend/sponsor/{{ @$sponsor->data_values->image }}"
                                                alt="img" class="imaged w-100">
                                            <strong></strong>
                                        </div>
                                    </a>
                                </li>
                            @empty
                            @endforelse

                        </ul>
                    </div>
                </div>
                <!-- * carousel small -->
            </div>
            <!-- * Send Money -->

            <div style="height:30px;"></div>

        </div>
        <!--</div>-->
        <!--</main>-->






        @if ($sections->secs == time())
            @foreach (json_decode($sections->secs) as $sec)
                @include($activeTemplate . 'sections.' . $sec)
            @endforeach
        @endif

    </div> --}}

@endsection
