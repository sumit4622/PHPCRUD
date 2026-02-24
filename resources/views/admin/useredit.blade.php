@extends('admin.layout')

@section('content')
    <div class="container mt-4">
            <h4 class="mb-4">Edit Profile</h4>
            
            <form action="{{ route('user.update.profile', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group text-left mb-3">
                    <label class="font-weight-bold text-uppercase">First Name</label>
                    <input type="text" name="first_name" class="form-control form-control-lg" 
                           value="{{ $firstName }}" placeholder="First name">
                </div>

                <div class="form-group text-left mb-3">
                    <label class="font-weight-bold text-uppercase">Last Name</label>
                    <input type="text" name="last_name" class="form-control form-control-lg" 
                           value="{{ $lastName }}" placeholder="Last name">
                </div>

                <div class="form-group text-left mb-3">
                    <label class="font-weight-bold text-uppercase">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg" 
                           value="{{ $user->email }}" placeholder="Example@gmail.com">
                </div>

                <button type="submit" class="btn btn-primary text-white font-weight-bold py-2">
                    Save Changes
                </button>
            </form>
    </div>
@endsection