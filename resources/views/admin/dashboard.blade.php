@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row mb-3 ">
        <div class="col-md-6 ">
            <div class="card bg-primary text-white h-100 ">
                <div class="card-body text-center btn btn-primary">
                    <h5 class="card-title">Active Users</h5>
                    <p class="card-text h2">5</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-primary text-white h-100">
                <div class="card-body text-center btn btn-primary">
                    <h5 class="card-title">Pending Tasks</h5>
                    <p class="card-text h2">12</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-info text-white">
                <div class="card-body text-center btn btn-primary">
                    <h5 class="card-title">System Status</h5>
                    <p class="card-text h2">Healthy</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection