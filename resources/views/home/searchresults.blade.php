@extends('layouts.front')


@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;{{url('img/bg-img.jpeg')}}&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">Search Results</h2>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="mb-5 col-md-12 col-lg-12">
                    <h3>Search Results for Keyword <span class="text-success">"{{ $keyword }}"</span>&nbsp;&nbsp;
                        @if (!is_null($procurement_type))
                            <span class="font-thin text-success">"{{ $procurement_type->name }}"</span>&nbsp;&nbsp;
                        @endif
                        @if (!is_null($department))
                            <span class="font-thin text-success">"{{ $department->description }}"</span>
                    </h3>
                    @endif
                </div>
                <div class="container">
                    @if(count($procurements == null ? 0 : $procurements)>0)
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
                                                        <div class="blink_me"><span class="px-4 py-2 text-white bg-danger badge">In
                                                                Objection</span></div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="job-post-item-body d-block d-md-flex">
                                                <div class="mr-3"><span class="mr-2 fa fa-university"></span> <a
                                                        href="#">{{ $procurement->departmentoffice->description }}</a></div>
                                                <div class="mr-3 text-success"><span
                                                        class="mr-2 fa fa-calendar text-success"></span>
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
                    @else
                        <h4 class="text-center">No Record Found</h4>
                    @endif
                </div>

            </div>
        </div>
    </div>

@stop


@push('scripts')
    <script>

    </script>
@endpush
