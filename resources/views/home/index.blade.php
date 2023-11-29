@extends('layouts.front')


@section('content')

    <div class="site-blocks-cover aos-init aos-animate"
        style="background-image: url(&quot;img/bg-img.jpg&quot;); background-position: 100% 0px;" data-aos="fade"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row row-custom align-items-center">
                <div class="col-md-10">
                    <h1 class="mb-2 text-black" style="font-size:45px;"><span class="font-weight-bold">
                            Public Procurement Regulatory Authority, </span>
                        Gilgit Baltistan
                    </h1>
                    <div class="job-search">
                        <ul class="mb-3 nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="py-3 nav-link active" id="pills-job-tab" data-toggle="pill" href="#"
                                    role="tab" aria-controls="pills-job" aria-selected="true">Search a
                                    Procurement</a>
                            </li>
                        </ul>
                        <div class="p-4 bg-white rounded tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-job" role="tabpanel"
                                aria-labelledby="pills-job-tab">
                                <form action="{{ route('searchresults') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="mb-3 col-md-6 col-lg-3 mb-lg-0">
                                            <input type="text" name="keyword" required minlength="3"
                                                class="form-control" placeholder="Search">
                                        </div>
                                        <div class="mb-3 col-md-6 col-lg-3 mb-lg-0">
                                            <div class="select-wrap">
                                                <span class="icon-keyboard_arrow_down arrow-down"></span>
                                                <select name="procurement_type" id="" class="form-control select2">
                                                    <option value="">Select a Procurement</option>
                                                    @foreach ($procurement_types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6 col-lg-3 mb-lg-0">
                                            <div class="select-wrap">
                                                <span class="icon-keyboard_arrow_down arrow-down"></span>
                                                <select name="department" id="" class="form-control select2">
                                                    <option value="">Select a Department</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->ddo_code }}">
                                                            {{ $department->description }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6 col-lg-3 mb-lg-0">
                                            <input type="submit" class="btn btn-primary btn-block" value="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="counters" class="site-section" style="padding-top:0px; padding-bottom:0px;">
        <div class="pl-0 pr-0 ml-0 mr-0 mt-5">
            <div class="mb-5 text-center justify-content-center">
                <div class="col-md-12 aos-init" data-aos="fade">
                    <h2 class="text-black">Current Statistics</h2>
                    <div class="container"><hr style="background: #ccc;"></div>
                </div>
            </div>
            <div class="d-flex">
                @php $i=0 @endphp
                @foreach ($procs as $proc)
                    <div class="col-md-3 mb-0 col-lg-3 aos-init " data-aos="fade">
                        <div class="position-relative unit-8">
                            <h1 style="font-size: 80px; font-weight:bolder; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class=" text-center text-black font-weihgt-normal line-height-sm count">
                                {{ count($proc->departmentprocurements) }}</h1>
                            <p style="font-weight:bold;" class="text-center text-black">{{ $proc->name }}</p>
                        </div>
                    </div>
                    @php $i++ @endphp
                @endforeach
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="mb-5 text-left row justify-content-start">
                <div class="col-md-6 aos-init aos-animate" data-aos="fade">
                    <h2 class="text-black font-weight-bold">Recent Procurements</h2>
                </div>
                <div class="col-md-3 aos-init aos-animate" data-aos="fade" data-aos-delay="200">
                    <a href="{{ url('/admin') }}" class="py-3 btn btn-primary btn-block"><b>Login</b></a>
                </div>
                <div class="col-md-3 aos-init aos-animate" data-aos="fade" data-aos-delay="200">
                    <a href="{{ url('/register') }}" class="py-3 btn btn-primary btn-block"><b>Sign Up</b></a>
                </div>
            </div>
            @foreach ($procurements as $procurement)
                <div class="row aos-init aos-animate" data-aos="fade">
                    <div class="col-md-12">
                        <div class="p-4 bg-white job-post-item d-block d-md-flex align-items-center">
                            <div class="mb-4 mr-1 mb-md-0">
                                <div class="job-post-item-header d-flex align-items-center">
                                    <h2 class="mr-2 text-black h4">[TSE-{{ date('Ymd', strtotime($procurement->opening_date)).$procurement->id }}]</h2>
                                    <h2 class="mr-2 text-black h4">{{ $procurement->title }}</h2>
                                    <div class="badge-wrap">
                                        <span
                                            class="px-4 py-2 text-white bg-info badge">{{ $procurement->procurement->name }}</span>&nbsp;
                                    </div>
                                    @if ($procurement->is_in_objection)
                                        <div class="badge-wrap">
                                            <div class="blink_me"><span class="px-4 py-2 text-white bg-danger badge">In
                                                    Objection</span></div>
                                        </div>
                                    @endif
                                </div>
                                <div class="job-post-item-body d-block d-md-flex">
                                    <div class="mr-3"><span class="mr-2 fa fa-university"></span> <a
                                            href="#">{{ $procurement->departmentoffice->description }}</a></div>
                                    <div class="mr-3 text-success"><span class="mr-2 fa fa-calendar text-success"></span>
                                        {{ date('d M, Y', strtotime($procurement->opening_date)) }}</div>
                                    <div class="mr-3 text-danger"><span class="mr-2 fa fa-calendar text-danger"></span>
                                        {{ date('d M, Y', strtotime($procurement->closing_date)) }}</div>
                                    {{-- <div><span class="mr-2 fa fa-map-pin"></span> <span>Gilgit</span></div> --}}
                                </div>
                                <div class="job-post-item-body d-block d-md-flex">

                                    <div class="mr-3"><span class="mr-2 fa fa-download"></span> <span><a
                                                href="{{ asset('storage/' . $procurement->tender_notice) }}"
                                                download>Notice</a></span></div>
                                    <div class="mr-3"><span class="mr-2 fa fa-download"></span> <span><a
                                                href="{{ asset('storage/' . $procurement->tender_document) }}"
                                                download>Document</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-auto">
                                <a href="{{ url('/procurementdetails/' . $procurement->id) }}"
                                    class="py-2 btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="mt-5 row">
                <div class="text-center col-md-12">
                    <div class="site-block-27">
                        <div class="ml-auto">
                            <a href="{{ url('/viewall') }}" class="py-2 btn btn-primary">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <div class="mb-5 text-center row justify-content-center">
                <div class="col-md-10 aos-init" data-aos="fade">
                    <h2 class="text-black"><strong> Services</strong> </h2>
                    <p>PPRA provide several services to procuring agencies. Most of the services are web based;
                        these services include:</p>
                </div>
            </div>
            <div class="row hosting">
                <div class="mb-5 col-md-6 col-lg-4 mb-lg-4 aos-init" data-aos="fade" data-aos-delay="100">
                    <a style="color:inherit !important;" href="{{ url('services/rules_regulations') }}">
                        <div class="bg-white unit-3 h-100">
                            <div class="mb-3 d-flex align-items-center unit-3-heading">
                                <div class="mr-4 unit-3-icon-wrap">
                                    <div class="box-column">
                                        <span class="fa fa-gavel"></span>
                                    </div>
                                </div>
                                <h2 class="h5 mgt-30px">Rules / Regulations</h2>
                            </div>
                            <div class="unit-3-body">
                                <p>{{ $gs->rules_reg_short_description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="mb-5 col-md-6 col-lg-4 mb-lg-4 aos-init" data-aos="fade" data-aos-delay="200">
                    <a style="color:inherit !important;" href="{{ url('services/tender_guidelines') }}">
                        <div class="bg-white unit-3 h-100">
                            <div class="mb-3 d-flex align-items-center unit-3-heading">
                                <div class="mr-4 unit-3-icon-wrap">
                                    <div class="box-column">
                                        <span class="fa fa-list"></span>
                                    </div>
                                </div>
                                <h2 class="h5 mgt-30px">Tender Guidelines</h2>
                            </div>
                            <div class="unit-3-body">
                                <p>{{ $gs->tender_guidelines_short_description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="mb-5 col-md-6 col-lg-4 mb-lg-4 aos-init" data-aos="fade" data-aos-delay="300">
                    <a style="color:inherit !important;" href="{{ url('services/bidding_documents') }}">
                        <div class="bg-white unit-3 h-100">
                            <div class="mb-3 d-flex align-items-center unit-3-heading">
                                <div class="mr-4 unit-3-icon-wrap">
                                    <div class="box-column">
                                        <span class="fa fa-file-text"></span>
                                    </div>
                                </div>
                                <h2 class="h5 mgt-30px">Bidding Documents</h2>
                            </div>
                            <div class="unit-3-body">
                                <p>{{ $gs->bidding_documents_short_description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="mb-5 col-md-6 col-lg-4 mb-lg-4 aos-init" data-aos="fade" data-aos-delay="400">
                    <a style="color:inherit !important;" href="{{ url('services/tender_instructions') }}">
                        <div class="bg-white unit-3 h-100">
                            <div class="mb-3 d-flex align-items-center unit-3-heading">
                                <div class="mr-4 unit-3-icon-wrap">
                                    <div class="box-column">
                                        <span class="fa fa-list-ol"></span>
                                    </div>
                                </div>
                                <h2 class="h5 mgt-30px">Tender Instructions</h2>
                            </div>
                            <div class="unit-3-body">
                                <p>{{ $gs->tender_instructions_short_description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="mb-5 col-md-6 col-lg-4 mb-lg-4 aos-init" data-aos="fade" data-aos-delay="500">
                    <a style="color:inherit !important;" href="{{ url('services/public_procurement') }}">
                        <div class="bg-white unit-3 h-100">
                            <div class="mb-3 d-flex align-items-center unit-3-heading">
                                <div class="mr-4 unit-3-icon-wrap">
                                    <div class="box-column">
                                        <span class="fa fa-calendar-check"></span>
                                    </div>
                                </div>
                                <h2 class="h5 mgt-30px">Public Procurement Checklist</h2>
                            </div>
                            <div class="unit-3-body">
                                <p>{{ $gs->public_procurement_short_description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="mb-5 col-md-6 col-lg-4 mb-lg-4 aos-init" data-aos="fade" data-aos-delay="600">
                    <a style="color:inherit !important;" href="{{ url('services/standing_instructions') }}">
                        <div class="bg-white unit-3 h-100">
                            <div class="mb-3 d-flex align-items-center unit-3-heading">
                                <div class="mr-4 unit-3-icon-wrap">
                                    <div class="box-column">
                                        <span class="fa fa-handshake"></span>
                                    </div>
                                </div>
                                <h2 class="h5 mgt-30px">Standing Instructions</h2>
                            </div>
                            <div class="unit-3-body">
                                <p>{{ $gs->standing_instructions_short_description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section" style="padding-top:0px;">
        <div class="container">
            <div class="mb-5 text-center row justify-content-center">
                <div class="col-md-6 aos-init" data-aos="fade">
                    <h2 class="text-black">News & Events</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($newss as $news)
                    <div class="mb-5 col-md-6 mb-lg-0 col-lg-3 aos-init" data-aos="fade">
                        <div class="position-relative unit-8">
                            <a href="{{ url('/news/getnews/'. $news->id) }}" class="mb-3 d-block img-a"><img
                                    src="{{ asset('storage/' . $news->image) }}" alt="Image"
                                    class="rounded img-fluid news-image"></a>
                            <span
                                class="mb-3 text-gray-500 d-block text-normal small">{{ date('F d, Y', strtotime($news->created_at)) }}</span>
                            <h2 class="mb-3 h5 font-weihgt-normal line-height-sm news-heading"><a
                                    href="{{ url('/news') }}" class="text-black">{{ $news->title }}</a></h2>
                            <div class="news-para">{!! $news->description !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="text-center col-md-12">
                    <div class="site-block-27">
                        <div class="mt-3 ml-auto">
                            <a href="{{ url('/news') }}" class="py-2 btn btn-primary">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap5',
                dropdownAutoWidth: true
            });
        });
    </script>
@endpush
