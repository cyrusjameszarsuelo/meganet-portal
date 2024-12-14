<section>
    <div class="wrap">
        <div class="container">
            {{-- <div class="row justify-content-between"> --}}
                <div class="row no-gutters">
                    <div class="col-8">
                        <div class="marquee">
                            <p style="color: white">
                                {!!$runningCredit?->content!!}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-1 pr-2">
                        <img class="float-right mt-1 mb-1" src="{{ asset('logos/Calendar W.png') }}" alt=""
                            style="width: 15px">
                    </div>
                    <div class="col-md-3">
                        <iframe
                            src="https://free.timeanddate.com/clock/i8yn7ip2/n145/tlph/fcfff/tct/pct/ftb/pl0/pr0/pt5/pb0/tt0/th2/tb2"
                            frameborder="0" width="294" height="21" allowtransparency="true"></iframe>

                        {{-- <span class="text-white">{{ Carbon\Carbon::now()->toDateTimeString() }}</span> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="" href="/home">
                <img src="{{ asset('images/meganet updated logo.gif') }}" alt="" style="width: 260px;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                    aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item active"><a href="/home" class="nav-link hover-underline-animation">Home</a>
                        </li>
                        <li class="nav-item"><a href="/our-company" class="nav-link hover-underline-animation">Our
                                Company</a>
                        </li>
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">Corporate
                                Office</a>
                            <div class="dropdown-menu " style="margin-top: -32px;">
                                @foreach ($corporateOffice as $item)
                                {{-- <a class="dropdown-item metricStore" href="/corporate-office/{{ $item->id }}">{{
                                    $item->department }}</a> --}}
                                <a class="dropdown-item metricStore" data-action="Department Site"
                                    data-url="/corporate-office/{{ $item->id }}" data-value="{{ $item->id }}"
                                    href="#">{{ $item->department }}</a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item"><a href="https://hr-portal.atwebpages.com/"
                                class="nav-link hover-underline-animation">Corporate HR Portal</a></li>
                        {{-- <li class="nav-item"><a href="/our-business-and-subsidiaries"
                                class="nav-link hover-underline-animation">Our Businesses &
                                Subsidiaries</a></li> --}}
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">Our Businesses &
                                Subsidiaries</a>
                            <div class="dropdown-menu " style="margin-top: -32px;">
                                <a class="dropdown-item" href="/our-business-and-subsidiaries">Our Businesses &
                                    Subsidiaries</a>
                                <a class="dropdown-item" href="/megawide-construction">Megawide Construction</a>
                                <a class="dropdown-item" href="/pcs">PCS</a>
                            </div>
                        </li>
                    </ul>

                    <div class="collapse navbar-collapse" id="ftco-nav">
                        <ul class="navbar-nav m-auto">
                            @if ($user['contacts']['mail'] == 'cjzarsuelo@megawide.com.ph' || $user['contacts']['mail'] ==
                            'jjpascua@megawide.com.ph' || $user['contacts']['mail'] == 'jnmaramba@megawide.com.ph')
                            <li class="nav-item" >
                                <a href="https://meganet-portal-admin.atwebpages.com/public/login" target="_blank" class="nav-link hover-underline-animation" style="padding-left: 0px; padding-right: 0px;">
                                    <i class="fa-solid fa-user mr-2 pt-1" style="font-size: 18px; color: black;"></i>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item" >
                                <a href="/home" class="nav-link hover-underline-animation" style="padding-left: 0px; padding-right: 0px;"><img class="mr-2" src="{{ asset('logos/Asset 64.png') }}" alt="" style="width: 20px"></a>
                            </li>
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false"  style="padding-left: 0px; padding-right: 0px;">
                                    <img src="{{ asset('logos/Asset 62.png') }}" alt="" style="width: 20px">
                                </a>
                                
                                <div class="dropdown-menu notification" style="margin-top: -32px; margin-left: -70%;">
                                    
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="userInfo">
                    <span style="color: #ee2f21"><b>{{ $user['contacts']['displayName'] }}</b></span>
                    <span class="ml-2 "><i class="fa fa-user userIcon"></i></span>
                    <h6 class="position"><i>{{ $user['contacts']['jobTitle'] }}</i></h6>
                </div>
        </div>
    </nav>
    <!-- END nav -->

</section>