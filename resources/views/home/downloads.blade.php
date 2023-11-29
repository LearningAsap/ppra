@extends('layouts.front')


@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;img/bg-img.jpeg&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">Downloads</h2>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <table class="table table table-striped">
                <thead>
                    <tr>
                        <th class="">S#</th>
                        <th class="">Title</th>
                        <th class="text-center">Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach($downloads as $download)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $download->title }}</td>

                            <td class="text-center">
                                <a href="{{ asset('/storage/'.$download->file) }}" download><img src="{{ url('icons/download-icon-1.png') }}" alt="Download" title="Download" /></a>
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
