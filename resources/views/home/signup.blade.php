@extends('layouts.front')

@section('content')
    <div class="unit-5 overlay" style="background-image: url(&quot;{{ url('img/bg-img.jpeg') }}&quot;);">
        <div class="container text-center">
            <h2 class="mb-0">Signup</h2>
        </div>
    </div>
    <br><br><br>
    <!-- Your form content goes here -->
    
    <div style="width:70% !important;" class="signup-form">
        @if(Session::has('success'))
            <div class="text-white alert alert-info">
                <strong>Success!</strong> {{ Session::get('success') }}
            </div>
        @else
            @if(Session::has('error'))
                <div class="text-white alert alert-danger">
                    <strong>Error!</strong> {{ Session::get('error') }}
                </div>
            @endif
        @endif
        <form action="{{ route('signup.store') }}" method="post">
            @csrf
            <div class="upper">
                <h2>Sign Up</h2>
                <p>Please fill in this form to create an account!</p>
                <hr>

            </div>

            <div class="form-group">
                <div style="@error('username') border:1px solid red; @enderror" class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{ Request::old('username') }}">

                </div>
                @error('username')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <div style="@error('ddo_code') border:1px solid red; @enderror" class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <select name="ddo_code" class="form-control" id="ddo_code_select">
                        <option value="" disabled selected>Select DDO Code</option>
                        @foreach ($ddoCodes as $code => $description)
                            @if(Request::old('ddo_code') == $code)
                                <option value="{{ $code }}" selected>{{ $description }}</option>
                            @else
                                <option value="{{ $code }}">{{ $description }}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
                @error('ddo_code')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <div style="@error('email') border:1px solid red; @enderror" class="input-group">
                    <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                    <input value="{{ Request::old('email') }}" type="email" class="form-control" name="email" placeholder="Email Address">

                </div>
                @error('email')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <div style="@error('password') border:1px solid red; @enderror" class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Password">

                </div>
                @error('password')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <div style="@error('password_confirmation') border:1px solid red; @enderror" class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        <i class="fa fa-check"></i>
                    </span>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                </div>
                @error('password_confirmation')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="user_role" value="1">

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
            </div>
        </form>
        <div class="text-center text-white">Already have an account? <a href="/admin/login">Login here</a></div>
    </div>
    <br><br><br>

    <script>
        $(document).ready(function() {
            $('#ddo_code_select').select2({
                placeholder: 'Search DDO Codes', // Placeholder text
                allowClear: true, // Option to clear selected value
            });
        });
    </script>
@endsection
