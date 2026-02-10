@extends('authentication.layout')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Register-page</h2>

            </div>

        </div>

    </div>

    @if ($errors->any())
        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <div class = "container">

        <div class = "content">
            <form action = "{{ 'register.' }}" method="POST">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="First name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Last name">
                    </div>
                </div>
            </form>

        </div>
    </div>

    <a class="btn btn-primary" href="{{ route('authentication.login') }}">have account</a>

    </div>
@endsection
