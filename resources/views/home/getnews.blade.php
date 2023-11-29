@extends('layouts.front')

@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;{{ url('img/bg-img.jpeg') }}&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">News</h2>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="mb-4">{{ $news->title }}</h2>
                    <!-- News Articles -->
                    <div class="mb-4 card">
                        <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}">
                        <div class="card-body">
                            <p class="float-right card-text"><small class="text-muted">Published on:
                                    {{ date('d F, Y', strtotime($news->created_at)) }}</small></p>
                            <h5 style="margin-top: 10px;" class="card-title">{{ $news->title }}</h5>
                            <p class="card-text">{!! substr($news->description, 0, 200) !!}...</p>
                        </div>
                    </div>


                <!-- You may also like -->


                <!-- Pagination -->


                {{-- <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                    </ul>
                </nav> --}}
            </div>
            <div class="col-lg-4">
                <h3 class="mb-4">You may also like</h3>

                <div class="card-deck">
                    @foreach ($relatedNews as $rn)
                        <div class="card">
                            <img src="{{ asset('storage/' . $rn->image) }}" class="card-img-top" alt="{{ $rn->title }}">
                            <div class="card-body">
                                <h5 style="margin-top:10px;" class="card-title">{{ $rn->title }}</h5>
                                <p class="card-text">{!! substr($rn->description, 0, 50) !!}...</p>
                                <a href="{{ url('/news/getnews/' . $rn->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@stop


@push('scripts')
    <script></script>
@endpush
