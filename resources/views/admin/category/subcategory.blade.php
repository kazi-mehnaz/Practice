@extends('layouts.dashboard_master')

@section('category')
    active
@endsection
@section('content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
        <span class="breadcrumb-item active">Add Sub Category</span>
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
            {{-- <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>List Category(Active)</h3>
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
                                <td>Category Photo</td>
                                <td>Action</td>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ App\Models\User::find($category->user_id)->name }}</td>
                                        <td>
                                            @if($category->updated_at)
                                                {{ $category->updated_at->diffForHumans() }}
                                            @else
                                                <span class="bg-danger text-white">Not updated</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($category->created_at)
                                                {{ $category->created_at->diffForHumans() }}
                                            @else
                                                <span class="bg-danger text-white">No time to show</span>
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" width="100" alt="not found">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('update\category') }}/{{ $category->id }}" type="button" class="btn btn-info">Update</a>
                                                <a href="{{ url('delete\category') }}/{{ $category->id }}" type="button" class="btn btn-danger">Delete</a>
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
                </div>
                <div class="card mt-5">
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
                </div>
            </div> --}}
            <div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Add Sub Category
                    </div>
                    <div class="card-body">
                        @if(session('success_message'))
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif
                        <form action="{{ url('/add/subcategory/post') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="category" class="form-label">Parent Category</label>
                                <select class="form-control" id="category" name="category_id">
                                    <option value="">None</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                              <label for="name" class="form-label">Sub Category Name</label>
                              <input type="text" class="form-control" id="name" Placeholder="Enter sub category" name="subcategory_name">
                              @error('subcategory_name')
                                  <span class="text-danger">
                                      {{ $message }}
                                  </span>
                              @enderror
                            </div>
                            
                            {{-- <div class="mb-3">
                                <label for="photo" class="form-label">Category Photo</label>
                                <input type="file" class="form-control" id="photo" name="category_photo">
                                @error('category_photo')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div> --}}
                            <button type="submit" class="btn btn-success">Add SubCategory</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






