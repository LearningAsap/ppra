<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>{{ $page_title }}</title>
    <link rel="shortcut icon" href="{{ url('/img/gbdoelogo.png') }}">
    <meta name="description" content="Public Procurement Regulatory Authority (PPRA)">
    <meta name="author" content="Public Procurement Regulatory Authority (PPRA)">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('/css/home.css') }}">
    <link rel="stylesheet" href="{{ url('/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ url('/css/css') }}">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ url('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ url('/css/animate.css') }}">
    <link rel="stylesheet" href="{{ url('/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('/css/fl-bigmug-line.css') }}">
    <link rel="stylesheet" href="{{ url('/css/aos.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style(1).css') }}">
    <link rel="stylesheet" href="{{ url('/css/signup.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body>
    @php
        $gsl = App\Models\GeneralSetting::first();
    @endphp
    <div class="site-wrap">
        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
                <div class="mt-3 site-mobile-menu-close">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body">
                <ul class="site-nav-wrap">
                    <li class="{{ $selected_main_menu == 'home_page' ? 'active' : '' }}"><a
                            href="{{ url('/') }}">Home</a></li>
                    <li class="{{ $selected_main_menu == 'about_page' ? 'active' : '' }}"><a
                            href="{{ url('/about') }}">About</a></li>
                    <li class="has-children" {{ $selected_main_menu == 'public_procurement' ? 'active' : '' }}><span
                            class="arrow-collapse collapsed" data-toggle="collapse" data-target="#collapseItem0"></span>
                        <a href="#">Public Procurement</a>
                        <ul class="collapse" id="collapseItem0">
                            @php
                                $procs = App\Models\Procurement::all();
                            @endphp
                            @foreach ($procs as $proc)
                                <li><a href="{{ url('/procurements', $proc->id) }}">{{ $proc->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="has-children {{ $selected_main_menu == 'news_page' ? 'active' : '' }}"><span
                            class="arrow-collapse collapsed" data-toggle="collapse" data-target="#collapseItem1"></span>
                        <a href="{{ url('/news') }}">News & Events</a>
                        <ul class="collapse" id="collapseItem1">
                            <li class="{{ $selected_main_menu == 'news_page' ? 'active' : '' }}"><a href="{{ url('/news') }}">News</a></li>
                            <li class="{{ $selected_main_menu == 'publications_page' ? 'active' : '' }}"><a href="{{ url('/publications') }}">Publications</a></li>
                            <li class="{{ $selected_main_menu == 'press_clippings_page' ? 'active' : '' }}"><a href="{{ url('/pressclippings') }}">Press Clippings</a></li>
                        </ul>
                    </li>
                    <li class="{{ $selected_main_menu == 'contact_page' ? 'active' : '' }}"><a
                            href="{{ url('/contact') }}">Contact</a></li>
                    <li class="{{ $selected_main_menu == 'download_page' ? 'active' : '' }}"><a
                            href="{{ url('/download') }}">Downloads</a></li>
                </ul>
            </div>
        </div>
        <header class="py-1 site-navbar" role="banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 col-xl-2">
                        <!-- <h1 class="mb-0"><a href="https://preview.colorlib.com/theme/jobstart/index.html"
                class="mb-0 text-black h2">Job<strong>start</strong></a></h1> -->

                        <div class="row">
                            <div class="col-3">
                                <img src="{{ url('img/ppra.jpeg') }}" class="img-responsive" width="40%">
                            </div>
                            <!-- <div class="col-9">
                    <h3 style="margin-left:5px;margin-top:15px;">PPRA, <strong>GB</strong></h3>
                </div> -->
                        </div>
                    </div>
                    <div class="col-10 col-xl-10 d-none d-xl-block">
                        <nav class="text-right site-navigation" role="navigation">
                            <ul class="mr-auto site-menu js-clone-nav d-none d-lg-block">
                                <li class="{{ $selected_main_menu == 'home_page' ? 'active' : '' }}"><a
                                        href="{{ url('/') }}">Home</a></li>
                                <li class="{{ $selected_main_menu == 'about_page' ? 'active' : '' }}"><a
                                        href="{{ url('/about') }}">About</a></li>
                                <li class="has-children"
                                    {{ $selected_main_menu == 'public_procurement' ? 'active' : '' }}>
                                    <a href="#">Public Procurement</a>
                                    <ul class="dropdown">
                                        @php
                                            $procs = App\Models\Procurement::all();
                                        @endphp
                                        @foreach ($procs as $proc)
                                            <li><a
                                                    href="{{ url('/procurements', $proc->id) }}">{{ $proc->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="has-children {{ $selected_main_menu == 'news_page' ? 'active' : '' }}">
                                    <a href="{{ url('/news') }}">News & Events</a>
                                    <ul class="dropdown">
                                        <li class="{{ $selected_main_menu == 'news_page' ? 'active' : '' }}"><a href="{{ url('/news') }}">News</a></li>
                                        <li class="{{ $selected_main_menu == 'publications_page' ? 'active' : '' }}"><a href="{{ url('/publications') }}">Publications</a></li>
                                        <li class="{{ $selected_main_menu == 'press_clippings_page' ? 'active' : '' }}"><a href="{{ url('/pressclippings') }}">Press Clippings</a></li>
                                    </ul>
                                </li>
                                <li class="{{ $selected_main_menu == 'contact_page' ? 'active' : '' }}"><a
                                        href="{{ url('/contact') }}">Contact</a></li>
                                <li class="{{ $selected_main_menu == 'downoload_page' ? 'active' : '' }}"><a
                                        href="{{ url('/download') }}">Downloads</a></li>
                                <!-- <li><a href="#"><span class="px-3 py-2 text-white rounded bg-primary"><span
                                                class="mr-2 h5">+</span> Post a
                                            Procurement</span></a></li> -->
                            </ul>
                        </nav>
                    </div>
                    <div class="text-right col-6 col-xl-2 d-block">
                        <div class="py-3 mr-auto d-inline-block d-xl-none ml-md-0"
                            style="position: relative; top: 3px;"><a href="#"
                                class="text-black site-menu-toggle js-menu-toggle"><span
                                    class="icon-menu h3"></span></a></div>
                    </div>
                </div>
            </div>
        </header>

        <section class="main_content_container">
            @yield('content')
        </section>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="mb-5 col-6 col-md-4 col-lg-4 mb-lg-0">
                                <h3 class="mb-4 footer-heading">Social</h3>
                                <ul class="list-unstyled">
                                    @if($gsl->facebook_link)
                                        <li><a target="_blank" href="{{ $gsl->facebook_link }}" class="social-link"><i class="fab fa-facebook"></i> Facebook</a></li>
                                    @endif

                                    @if($gsl->twitter_link)
                                        <li><a target="_blank" href="{{ $gsl->twitter_link }}" class="social-link"><i class="fab fa-twitter"></i> Twitter</a></li>
                                    @endif

                                    @if($gsl->linked_in_link)
                                        <li><a target="_blank" href="{{ $gsl->linked_in_link }}" class="social-link"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                                    @endif

                                    @if($gsl->youtube_link)
                                        <li><a target="_blank" href="{{ $gsl->youtube_link }}" class="social-link"><i class="fab fa-youtube"></i> YouTube</a></li>
                                    @endif

                                    @if($gsl->google_plus_link)
                                        <li><a target="_blank" href="{{ $gsl->google_plus_link }}" class="social-link"><i class="fab fa-google-plus"></i> Google Plus</a></li>
                                    @endif
                                    {{-- <li><a href="#" class="social-link"><i class="fab fa-instagram"></i> Instagram</a></li> --}}
                                </ul>
                            </div>
                            <div class="mb-5 col-6 col-md-4 col-lg-4 mb-lg-0">
                                <h3 class="mb-4 footer-heading">Archives</h3>
                                @php
                                    $currentMonth = date('F'); // Current month name
                                    $currentYear = date('Y'); // Current year

                                    $previousMonths = [];

                                    for ($i = 0; $i < 6; $i++) {
                                        $previousMonths[] = [
                                            'month' => $currentMonth,
                                            'year' => $currentYear
                                        ];

                                        // Move to the previous month
                                        $currentMonth = date('F', strtotime("-1 month", strtotime($currentMonth)));
                                        if ($currentMonth === 'December') {
                                            $currentYear--; // Move to the previous year when December is reached
                                        }
                                    }
                                @endphp
                                <ul class="list-unstyled">
                                    @foreach ($previousMonths as $pm)
                                    <li><a href="{{ url('/viewall?year=' . $pm['year'] . '&month=' . $pm['month'] . '&day=') }}">{{ $pm['month'] }} {{ $pm['year'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mb-5 col-6 col-md-4 col-lg-4 mb-lg-0">
                                <h3 class="mb-4 footer-heading">GB-PPRA</h3>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('/about') }}">About</a></li>
                                    <li><a href="{{ url('/downloads') }}">Downloads</a></li>
                                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                                    {{-- <li><a href="{{ url('/services/rules_regulations') }}">Rules and Regulations</a></li>
                                    <li><a href="{{ url('/services/tender_guidelines') }}">Tender Guidelines</a></li>
                                    <li><a href="{{ url('/services/bidding_documents') }}">Bidding Documents</a></li>
                                    <li><a href="{{ url('/services/tender_instructions') }}">Tender Instructions</a></li>
                                    <li><a href="{{ url('/services/public_procurement') }}">Procurement Checklist</a></li>
                                    <li><a href="{{ url('/services/standing_instructions') }}">Standing Instructions</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <h3 class="mb-4 footer-heading">Contact Info</h3>
                        <ul class="list-unstyled">
                            <li>
                                <span class="text-white d-block">Address</span>
                                {{ $gsl->global_address }}
                            </li>
                            <li>
                                <span class="text-white d-block">Telephone</span>
                                {{ $gsl->global_phone_no }}
                            </li>
                            <li>
                                <span class="text-white d-block">Email</span>
                                {{ $gsl->info_email }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="pt-5 mt-5 text-center row">
                    <div class="col-md-12">
                        <p>
                            Powered by <a href="http://www.gbit.gov.pk" target="_blank">Information Technology
                                Department GB</a>.

                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <script type="text/javascript" async="" src="{{ url('js/analytics.js.download') }}"
        nonce="c938036c-6ef1-42bb-8315-c1547b86be3f"></script>
    <script defer="" referrerpolicy="origin" src="{{ url('js/s.js.download') }}"></script>
    <script nonce="c938036c-6ef1-42bb-8315-c1547b86be3f">
        (function(w, d) {
            ! function(eK, eL, eM, eN) {
                eK.zarazData = eK.zarazData || {};
                eK.zarazData.executed = [];
                eK.zaraz = {
                    deferred: [],
                    listeners: []
                };
                eK.zaraz.q = [];
                eK.zaraz._f = function(eO) {
                    return function() {
                        var eP = Array.prototype.slice.call(arguments);
                        eK.zaraz.q.push({
                            m: eO,
                            a: eP
                        })
                    }
                };
                for (const eQ of ["track", "set", "debug"]) eK.zaraz[eQ] = eK.zaraz._f(eQ);
                eK.zaraz.init = () => {
                    var eR = eL.getElementsByTagName(eN)[0],
                        eS = eL.createElement(eN),
                        eT = eL.getElementsByTagName("title")[0];
                    eT && (eK.zarazData.t = eL.getElementsByTagName("title")[0].text);
                    eK.zarazData.x = Math.random();
                    eK.zarazData.w = eK.screen.width;
                    eK.zarazData.h = eK.screen.height;
                    eK.zarazData.j = eK.innerHeight;
                    eK.zarazData.e = eK.innerWidth;
                    eK.zarazData.l = eK.location.href;
                    eK.zarazData.r = eL.referrer;
                    eK.zarazData.k = eK.screen.colorDepth;
                    eK.zarazData.n = eL.characterSet;
                    eK.zarazData.o = (new Date).getTimezoneOffset();
                    if (eK.dataLayer)
                        for (const eX of Object.entries(Object.entries(dataLayer).reduce(((eY, eZ) => ({
                                ...eY[1],
                                ...eZ[1]
                            }))))) zaraz.set(eX[0], eX[1], {
                            scope: "page"
                        });
                    eK.zarazData.q = [];
                    for (; eK.zaraz.q.length;) {
                        const e_ = eK.zaraz.q.shift();
                        eK.zarazData.q.push(e_)
                    }
                    eS.defer = !0;
                    for (const fa of [localStorage, sessionStorage]) Object.keys(fa || {}).filter((fc => fc
                        .startsWith("_zaraz_"))).forEach((fb => {
                        try {
                            eK.zarazData["z_" + fb.slice(7)] = JSON.parse(fa.getItem(fb))
                        } catch {
                            eK.zarazData["z_" + fb.slice(7)] = fa.getItem(fb)
                        }
                    }));
                    eS.referrerPolicy = "origin";
                    eS.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(eK.zarazData)));
                    eR.parentNode.insertBefore(eS, eR)
                };
                ["complete", "interactive"].includes(eL.readyState) ? zaraz.init() : eK.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, 0, "script");
        })(window, document);
    </script>
    <script type="text/javascript" charset="UTF-8" src="{{ url('js/common.js.download') }}"
        nonce="c938036c-6ef1-42bb-8315-c1547b86be3f"></script>
    <script type="text/javascript" charset="UTF-8" src="{{ url('js/util.js.download') }}"
        nonce="c938036c-6ef1-42bb-8315-c1547b86be3f"></script>
    <script type="text/javascript" charset="UTF-8" src="{{ url('js/controls.js.download') }}"
        nonce="c938036c-6ef1-42bb-8315-c1547b86be3f"></script>
    <script type="text/javascript" charset="UTF-8" src="{{ url('js/places_impl.js.download') }}"
        nonce="c938036c-6ef1-42bb-8315-c1547b86be3f"></script>
    <script src="{{ url('js/jquery-3.3.1.min.js.download') }}"></script>
    <script src="{{ url('js/jquery-migrate-3.0.1.min.js.download') }}"></script>
    <script src="{{ url('js/jquery-ui.js.download') }}"></script>
    <script src="{{ url('js/popper.min.js.download') }}"></script>
    <script src="{{ url('js/bootstrap.min.js.download') }}"></script>
    <script src="{{ url('js/owl.carousel.min.js.download') }}"></script>
    <script src="{{ url('js/jquery.stellar.min.js.download') }}"></script>
    <script src="{{ url('js/jquery.countdown.min.js.download') }}"></script>
    <script src="{{ url('js/jquery.magnific-popup.min.js.download') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.min.js.download') }}"></script>
    <script src="{{ url('js/aos.js.download') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".count").each(function() {
            $(this)
                .prop("Counter", 0)
                .animate({
                    Counter: $(this).text(),
                }, {
                    duration: 4000,
                    easing: "swing",
                    step: function(now) {
                        now = Number(Math.ceil(now)).toLocaleString('en');
                        $(this).text(now);
                    },
                });
        });
    </script>
    <script src="{{ url('js/js') }}" async="" defer=""></script>
    <script src="{{ url('js/main.js.download') }}"></script>

    <script async="" src="{{ url('js/js(1)') }}"></script>
    <script defer="" src="{{ url('js/vaafb692b2aea4879b33c060e79fe94621666317369993') }}"
        integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA=="
        data-cf-beacon="{&quot;rayId&quot;:&quot;77f7c220ce3cc8f4&quot;,&quot;token&quot;:&quot;cd0b4b3a733644fc843ef0b185f98241&quot;,&quot;version&quot;:&quot;2022.11.3&quot;,&quot;si&quot;:100}"
        crossorigin="anonymous"></script>

    <div class="pac-container pac-logo hdpi"
        style="display: none; width: 193px; position: absolute; left: 552px; top: 535px;"></div>

    @stack('scripts')
</body>

</html>
