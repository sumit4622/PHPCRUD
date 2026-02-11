@extends('authentication.layout')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="card shadow-lg border-0" style="width: 450px; border-radius: 15px; overflow: hidden;">

                <div class="card-header bg-white pt-4 pb-2 border-0">
                    <h2 style="font-weight: 700; color: #333; margin-bottom: 5px;">Create Account</h2>
                </div>

                <div class="card-body px-5 pb-5">

                    @if ($errors->any())
                        <div class="alert alert-danger text-left small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{route('authentication.login1')}}" method="POST" class = "px-4 py-2">
                        @csrf

                        <div class="form-group text-left mb-3">
                            <label class="font-weight-bold text-uppercase">First Name</label>
                            <input type="text" name="first_name"class="form-control form-control-lg" placeholder="First name">
                        </div>

                        <div class="form-group text-left mb-3">
                            <label class ="font-weight-bold text-uppercase">Last Name</label>
                            <input type="text" name="last_name"class="form-control form-control-lg" placeholder="last name">
                        </div>

                        <div class="form-group text-left mb-3">
                            <label class="font-weight-bold text-uppercase">Email Address</label>
                            <input type="text" name="email"class="form-control form-control-lg" placeholder="Example@gmail.com">

                        </div>

                        <div class="form-group text-left mb-4">
                            <label class="font-weight-bold text-uppercase">Password</label>
                            <input type="password"name="password" class="form-control form-control-lg" placeholder="********">

                        </div>

                        <button type="submit" class="btn btn-primary text-white font-weight-bold py-2">
                            REGISTER NOW
                        </button>
                    </form>

                        <p class="font-weight-bold text-primary">
                            Already have an account?
                            <a href="{{ route('authentication.login') }}">Login Here</a>
                        </p>
                </div>
            </div>
        </div>
    </div>
@endsection
