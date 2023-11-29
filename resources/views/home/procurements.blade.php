@extends('layouts.front')


@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;{{url('img/bg-img.jpeg')}}&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">{{ $proc->name }}</h2>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <table class="table table table-striped">
                <thead>
                    <tr>
                        <th class="">S#</th>
                        <th class="">Title</th>
                        <th class="">Type</th>
                        <th class="">Department</th>
                        <th class="">Opening Date</th>
                        <th class="">Closing Date</th>
                        <th class="text-center">Tender Document</th>
                        <th class="text-center">Tender Notice</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach($procurements as $procurement)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $procurement->title }}</td>
                            <td>{{ $procurement->procurement->name }}</td>
                            <td>{{ $procurement->departmentoffice->description }}</td>
                            <td>{{ date('d-m-Y', strtotime($procurement->opening_date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($procurement->closing_date)) }}</td>

                            <td class="text-center">
                                <a href="{{ asset('/storage/'.$procurement->tender_document) }}" download><img src="{{ url('icons/download-icon-1.png') }}" alt="Download" title="Download" /></a>
                            </td>
                            <td class="text-center">
                                <a href="{{ asset('/storage/'.$procurement->tender_notice) }}" download><img src="{{ url('icons/download-icon-1.png') }}" alt="Download" title="Download" /></a>
                            </td>
                            <td class="text-center">
                                <a href="{{ url('/procurementdetails', $procurement->id) }}"><i class="fa-solid fa-eye" title="View Details"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop


@push('scripts')
    <script></script>
@endpush
