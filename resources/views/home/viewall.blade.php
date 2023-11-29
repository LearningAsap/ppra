@extends('layouts.front')


@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;{{ url('img/bg-img.jpeg') }}&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">All Procurements</h2>
        </div>
    </div>
    <form action="{{ url('/viewall') }}" method="get" class="p-5 bg-white">
        @csrf
        <div class="row">
            <div class="mb-3 col-lg-3">
                <select name="year" id="year" class="form-control">
                    <option value="">Select Year</option>
                    @foreach ($years as $yr)
                        @if($yr == $year)
                            <option value="{{ $yr }}" selected>{{ $yr }}</option>
                        @else
                            <option value="{{ $yr }}">{{ $yr }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-lg-3">
                <select name="month" id="month" class="form-control">
                    <option value="">Select Month</option>
                    @foreach ($months as $mth)
                        @if($mth == $month)
                            <option value="{{ $mth }}" selected>{{ $mth }}</option>
                        @else
                            <option value="{{ $mth }}">{{ $mth }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-lg-3">
                <select name="day" id="day" class="form-control">
                    <option value="">Select Day</option>
                    @foreach ($days as $dy)
                        @if($dy == $day)
                            <option value="{{ $dy }}" selected>{{ $dy }}</option>
                        @else
                            <option value="{{ $dy }}">{{ $dy }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-lg-2">
                <div class="form-group">
                    <input type="submit" value="Search" class="px-4 py-2 btn btn-primary">
                </div>
            </div>
        </div>
    </form>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                @if (!is_null($day) || !is_null($month) || !is_null($year))
                    <div class="mb-5 col-md-12 col-lg-12">
                        <h3 class="text-center">Results for
                            @if ($year != null)
                                <span class="text-success">"{{ $year }}"</span>
                            @endif
                            @if ($month != null)
                                <span class="text-success">"{{ $month }}"</span>
                            @endif
                            @if ($day != null)
                                <span class="text-success">"{{ $day }}"</span>
                            @endif
                        </h3>
                    </div>
                @endif
                <div class="container">
                    @if (count($procurements == null ? 0 : $procurements) > 0)
                        @foreach ($procurements as $procurement)
                            <div class="row aos-init aos-animate" data-aos="fade">
                                <div class="col-md-12">
                                    <div class="p-4 bg-white job-post-item d-block d-md-flex align-items-center">
                                        <div class="mb-4 mr-1 mb-md-0">
                                            <div class="job-post-item-header d-flex align-items-center">
                                                <h2 class="mr-2 text-black h4">[TSE-{{ date('Ymd', strtotime($procurement->opening_date)).$procurement->id }}]</h2>
                                                <h2 class="mr-3 text-black h4">{{ $procurement->title }}</h2>
                                                <div class="badge-wrap">
                                                    <span
                                                        class="px-4 py-2 text-white bg-info badge">{{ $procurement->procurement->name }}</span>&nbsp;
                                                </div>
                                                @if ($procurement->is_in_objection)
                                                    <div class="badge-wrap">
                                                        <div class="blink_me"><span
                                                                class="px-4 py-2 text-white bg-danger badge">In
                                                                Objection</span></div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="job-post-item-body d-block d-md-flex">
                                                <div class="mr-3"><span class="mr-2 fa fa-university"></span> <a
                                                        href="#">{{ $procurement->departmentoffice->description }}</a>
                                                </div>
                                                <div class="mr-3 text-success"><span
                                                        class="mr-2 fa fa-calendar text-success"></span>
                                                    {{ date('d M, Y', strtotime($procurement->opening_date)) }}</div>
                                                <div class="mr-3 text-danger"><span
                                                        class="mr-2 fa fa-calendar text-danger"></span>
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
                    @else
                        <h4 class="text-center">No Record Found</h4>
                    @endif
                    <div
                        style="
                            display: table;
                            margin-left: auto;
                            margin-right: auto;
                            margin-top: 30px;
                        "
                        class="">
                        {{  $procurements->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop


@push('scripts')
    <script></script>
@endpush
