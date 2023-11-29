@extends('layouts.front')


@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;{{url('img/bg-img.jpeg')}}&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">Tender Details</h2>
        </div>
    </div>

    <div class="container mt-5">
        <table class="table table-striped">

            <div class="mb-5 t-h">
                <h4>[TSE-{{ date('Ymd', strtotime($procurement->opening_date)).$procurement->id }}] - {{ $procurement->title }}</h4>
            </div>
            <tbody>
                <tr>
                    <th scope="row">Search Engine #</th>
                    <td>TSE-{{ date('Ymd', strtotime($procurement->opening_date)).$procurement->id }}</td>
                </tr>
                <tr>
                    <th scope="row">Procurment Title</th>
                    <td>{{ $procurement->title }}</td>
                    @if($procurement->is_in_objection)
                        <td>
                            <div class="badge-wrap">
                                <div class="blink_me"><span class="px-4 py-2 text-white bg-danger badge">In
                                        Objection</span></div>
                            </div>
                        </td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">Procurment Description</th>
                    <td>{!! $procurement->description !!}</td>
                </tr>
                <tr>
                    <th scope="row">Procurment Type</th>
                    <td>{{ $procurement->procurement->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Department</th>
                    <td>{{ $procurement->departmentoffice->description }}</td>
                </tr>
                <tr>
                    <th scope="row">Publish Date</th>
                    <td>{{ date('d F, Y', strtotime($procurement->opening_date)) }}</td>
                </tr>
                <tr>
                    <th scope="row">Closing Date</th>
                    <td>{{ date('d F, Y', strtotime($procurement->closing_date)) }}</td>
                </tr>
                <tr>
                    <th scope="row">Tender Notice</th>
                    <td class="">
                        <a href="{{ asset('/storage/'.$procurement->tender_notice) }}" download><img src="{{ url('icons/download-icon-1.png')}}" alt="Download" title="Download" /></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Bidding Document</th>
                    <td class="">
                        <a href="{{ asset('/storage/'.$procurement->tender_document) }}" download><img src="{{ url('icons/download-icon-1.png')}}" alt="Download" title="Download" /></a>
                    </td>
                </tr>
                @if(count($procurement->procurementdocuments)>0)
                    <tr>
                        <th scope="row">Documents</th>
                        <td class="">
                            <table class="table table-striped">
                                <thead>
                                    <th scope="col">Document Type</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Download</th>
                                </thead>
                                <tbody>
                                    @foreach($procurement->procurementdocuments as $document)
                                        <tr>
                                            <td>{{ $document->procurement->name }}</td>
                                            <td>{{ $document->title }}</td>
                                            <td class="">
                                                <a href="{{ asset('/storage/'.$document->file) }}" download><img src="{{ url('icons/download-icon-1.png')}}" alt="Download" title="Download" /></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif
                <!-- Button trigger modal -->
            </tbody>
        </table>
        <!-- Button trigger modal -->
        {{-- <div class="text-right">
            <a href="{{ url('/procurementdetails/apply', $procurement->id) }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Apply Now
            </a>
        </div> --}}

        <!-- Modal -->
        <div class="modal fade "data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="Apply for This tender" id="exampleModalLabel">Enter your Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Apply Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
    </div>


    {{-- <div class="container mt-3">

        <table class="table table-striped">
            <h2>Active Contractors</h2>
            <thead>
                <th scope="col">Contractors Name / Firm</th>
                <th scope="col">Address</th>
                <th scope="col">Cell #</th>
                <th scope="col">Status</th>
            </thead>
            <tbody>
                @foreach($procurement->contractorprocurments as $contractor)
                    @if($contractor->is_active)
                        <tr>
                            <td>{{ $contractor->contractor_name }}</td>
                            <td>{{ $contractor->office_address }}</td>
                            <td>{{ $contractor->phone }}</td>
                            <td>
                                <div class="badge-wrap b">
                                    <span class="px-4 py-2 text-white bg-info badge">Active</span>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    </div> --}}

@stop


@push('scripts')
    <script></script>
@endpush
