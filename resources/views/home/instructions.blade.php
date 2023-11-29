@extends('layouts.front')


@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;{{ url('img/bg-img.jpeg') }}&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">{{ $pages[$page] }}</h2>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            @if($page == 'rules_regulations')
                {!! $gs->rules_reg_page_content !!}
            @elseif($page == 'tender_guidelines')
                {!! $gs->tender_guidelines_page_content !!}
            @elseif($page == 'bidding_documents')
                {!! $gs->bidding_documents_page_content !!}
            @elseif($page == 'tender_instructions')
                {!! $gs->tender_instructions_page_content !!}
            @elseif($page == 'public_procurement')
                {!! $gs->public_procurement_page_content !!}
            @elseif($page == 'standing_instructions')
                {!! $gs->standing_instructions_page_content !!}
            @else
                <h3>Page not found</h3>
            @endif
        </div>
    </div>

@stop


@push('scripts')
    <script></script>
@endpush
