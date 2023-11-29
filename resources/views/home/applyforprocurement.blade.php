@extends('layouts.front')


@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;{{ url('img/bg-img.jpeg') }}&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">Apply Now</h2>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="t-h mb-5">
                <h4>Apply for <span style="color:darkgreen">"{{ $procurement->title }}"</span></h4>
            </div>
            <form method="post" action="{{ route('home.storecontractor') }}">
                @if(Session::has('message'))
                    <div class="bg-info alert alert-primary text-white" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-danger alert alert-primary text-white" role="alert">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }} </li>
                        @endforeach
                    </div>
                @endif
                {{ csrf_field() }}
                <input type="hidden" name="procurement_id"  value="{{ $procurement->id }}">
                <div>
                    <label for="exampleInputName" class="form-label">Contractor / Firm Name:</label>
                    <input value="{{ Request::old('contractor_name') }}" name="contractor_name" class="form-control " required>
                </div>
                <div class="mb-2">
                    <label for="exampleInputAddress" class="form-label">Address:</label>
                    <input value="{{ Request::old('office_address') }}" name="office_address" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone / Cell #:</label>
                    <input value="{{ Request::old('phone') }}" name="phone" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    {!! NoCaptcha::renderJs('en', false, 'onloadCallback') !!}
                    {!! NoCaptcha::display() !!}
                </div>
                <button type="submit" class="btn btn-primary">Submit and Download Challan</button>
            </form>
        </div>
    </div>
    <script>
        var onloadCallback = function() {
            alert('grecaptcha is ready!');
        }
    </script>
@stop


@push('scripts')

@endpush
