@extends('layouts.front')


@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;img/bg-img.jpeg&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">Publications</h2>
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
                    @foreach($publications as $publication)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $publication->title }}</td>

                            <td class="text-center">
                                <a href="{{ asset('/storage/'.$publication->file) }}" download><img src="{{ url('icons/download-icon-1.png') }}" alt="Download" title="Download" /></a>
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
