@extends('layouts.dashboard_master')

@section('product')
    active
@endsection

@section('content')
    
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
        <span class="breadcrumb-item active">Add Product</span>
    </nav>

    <div class="sl-pagebody">

        <div class="row row-sm">
            {{-- @if(session('update_status'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('update_status') }}
                    </div>
                </div>
            @endif
            @if(session('delete_status'))
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        {{ session('delete_status') }}
                    </div>
                </div>
            @endif
            @if(session('restore_status'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('restore_status') }}
                    </div>
                </div>
            @endif
            @if(session('forcedelete_status'))
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        {{ session('forcedelete_status') }}
                    </div>
                </div>
            @endif --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>List Product</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td>Serial No.</td>
                                <td>Product Name</td>
                                <td>Category Name</td>
                                <td>Product Price</td>
                                <td>Product Quantity</td>
                                <td>Product Photo</td>
                                <td>Created At</td>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->relationtocategorytable->category_name }}</td>
                                        {{-- <td>{{ App\Models\Category::find($product->category_id)->category_name }}</td> --}}
                                        <td>{{ $product->product_price }}</td>
                                        <td>{{ $product->product_quantity }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_thumbnail_photo }}" alt="not found" height="100">
                                        </td>
                                        <td>{{ $product->created_at }}</td>
                                        {{-- <td>{{ App\Models\User::find($product->user_id)->name }}</td>
                                        <td>
                                            @if($product->updated_at)
                                                {{ $product->updated_at->diffForHumans() }}
                                            @else
                                                <span class="bg-danger text-white">Not updated</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->created_at)
                                                {{ $product->created_at->diffForHumans() }}
                                            @else
                                                <span class="bg-danger text-white">No time to show</span>
                                            @endif
                                        </td> --}}
                                        {{-- <td>
                                            <img src="{{ asset('uploads/category_photos') }}/{{ $product->category_photo }}" width="100" alt="not found">
                                        </td> --}}
                                        {{-- <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('update\category') }}/{{ $product->id }}" type="button" class="btn btn-info">Update</a>
                                                <a href="{{ url('delete\category') }}/{{ $product->id }}" type="button" class="btn btn-danger">Delete</a>
                                            </div>
                                        </td> --}}
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="50" class="text-center text-danger">No data to show</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card mt-5">
                    <div class="card-header">
                        <h3>List Category(Deleted)</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td>Serial No.</td>
                                <td>Category Name</td>
                                <td>Added By</td>
                                <td>Last Updated At</td>
                                <td>Created At</td>
                                <td>Action</td>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($deleted_categories as $deleted_category)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td>{{ $deleted_category->category_name }}</td>
                                        <td>{{ App\Models\User::find($deleted_category->user_id)->name }}</td>
                                        <td>
                                            @if($deleted_category->updated_at)
                                                {{ $deleted_category->updated_at->diffForHumans() }}
                                            @else
                                                <span class="bg-danger text-white">Not updated</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($deleted_category->created_at)
                                                {{ $deleted_category->created_at->diffForHumans() }}
                                            @else
                                                <span class="bg-danger text-white">No time to show</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('restore\category') }}/{{ $deleted_category->id }}" type="button" class="btn btn-success">Restore</a>
                                                <a href="{{ url('harddelete\category') }}/{{ $deleted_category->id }}" type="button" class="btn btn-danger">DelHard</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="50" class="text-center text-danger">No data to show</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Product
                    </div>
                    <div class="card-body">
                        {{-- @if(session('success_message'))
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif --}}
                        <form action="{{ url('add/product/post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                              <label for="name" class="form-label">Product Name</label>
                              <input type="text" class="form-control" id="name" name="product_name">
                            </div>

                            <div class="mb-3">
                              <label for="name" class="form-label">Category Name</label>
                              <select class="form-control" name="category_id">
                                  <option value="">-Select One-</option>
                                  @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                  @endforeach
                              </select>
                            </div>
                            
                            <div class="mb-3">
                              <label for="name" class="form-label">Product Price</label>
                              <input type="text" class="form-control" id="name" name="product_price">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Product Quantity</label>
                                <input type="text" class="form-control" id="name" name="product_quantity">
                              </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Product Short Description</label>
                                <textarea class="form-control" name="product_short_description" rows="4"></textarea>
                              </div>
                              
                            <div class="mb-3">
                                <label class="form-label">Product Long Description</label>
                                <textarea class="form-control" name="product_long_description" rows="4"></textarea>
                              </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Product Thumbnail Photo</label>
                                <input type="file" class="form-control" id="photo" name="product_thumbnail_photo">
                                {{-- @error('category_photo')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror --}}
                            </div>
                            <button type="submit" class="btn btn-success">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection