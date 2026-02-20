@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2>Item List</h2>
            <hr>
        </div>
        
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($view_product as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        
                        <td>
                                <img src="{{ asset('storage/' . $product->image) }}" width="100" class="img-thumbnail">
                        </td>
                        
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->details }}</td>
                        <td>
                            <form action="{{ route('AdminDashboard.destroy', $product->id) }}" method="POST">
                                <a href="{{ route('AdminDashboard.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit post</a>
                                
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete post</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <div class="alert alert-info m-0">No products found in the database.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection