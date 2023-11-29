@extends('layouts.front')


@section('content')

    <div class="unit-5 overlay" style="background-image: url(&quot;img/bg-img.jpeg&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">Contact Us</h2>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="mb-5 col-md-12 col-lg-8">

                    @if(Session::has('success'))
                        <div style="background: #e68a19;" class="text-white alert alert-info">
                            <strong>Success!</strong> {{ Session::get('success') }}
                        </div>
                    @else
                        @if(Session::has('error'))
                            <div style="background: #dc362e;" class="text-white alert alert-danger">
                                <strong>Error!</strong> {{ Session::get('error') }}
                            </div>
                        @endif
                    @endif
                    <form action="{{ route('contact.submitmessage') }}" method="POST" class="p-5 bg-white">
                        @csrf
                        <div class="row form-group">
                            <div class="mb-3 col-md-12 mb-md-0">
                                <label class="font-weight-bold" for="fullname">Full Name</label>
                                <input style="@error('fullname') border:1px solid red; @enderror" name="fullname" value="{{ Request::old('fullname') }}" type="text" id="fullname" class="form-control" placeholder="Full Name">
                                @error('fullname')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="email">Email</label>
                                <input style="@error('email') border:1px solid red; @enderror" name="email" value="{{ Request::old('email') }}" type="email" id="email" class="form-control" placeholder="Email Address">
                                @error('email')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="email">Subject</label>
                                <input style="@error('subject') border:1px solid red; @enderror" type="text" name="subject" value="{{ Request::old('subject') }}" id="subject" class="form-control" placeholder="Enter Subject">
                                @error('subject')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="message">Message</label>
                                <textarea style="@error('message') border:1px solid red; @enderror" name="message" id="message" cols="30" rows="5" class="form-control"
                                    placeholder="Say hello to us">{{ Request::old('message') }}</textarea>
                                @error('message')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Send" class="px-4 py-2 btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="p-4 mb-3 bg-white">
                        <h3 class="mb-3 text-black h5">Contact Info</h3>
                        <p class="mb-0 font-weight-bold">Address</p>
                        <p class="mb-4">{{ $gs->global_address }}</p>
                        <p class="mb-0 font-weight-bold">Phone</p>
                        <p class="mb-4"><a href="tel:{{ $gs->global_phone_no }}">{{ $gs->global_phone_no }}</a></p>
                        <p class="mb-0 font-weight-bold">Email Address</p>
                        <p class="mb-0"><a href="mailto:{{ $gs->info_email }}">{{ $gs->info_email }}</a></p>
                    </div>
                    <div class="p-4 mb-3 bg-white">
                        <h3 class="mb-3 text-black h5">More Info</h3>
                        <p>The Gilgit Baltistan Public Procurement Regulatory Authority ensures transparent, accountable, and ethical public procurement processes. Committed to fairness and efficiency, it provides guidelines, regulations, and resources for optimal procurement practices.</p>
                        <p><a href="{{ url('/about') }}" class="px-4 py-2 btn btn-primary rounded-0">Learn More</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@push('scripts')
    <script></script>
@endpush
