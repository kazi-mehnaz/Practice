@extends('layouts.dashboard_master')

@section('home')
    active
@endsection

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
        <span class="breadcrumb-item active">Edit Profile</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row row-sm">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Change Name</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success_message'))
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif
                        <form action="{{ url('profile/post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                              <label for="name" class="form-label">Name</label>
                              <input type="text" class="form-control" id="name" Placeholder="Enter your name" name="name" value="{{ Str::title(Auth::user()->name) }}">
                              @error('name')
                                  <span class="text-danger">
                                      {{ $message }}
                                  </span>
                              @enderror
                            </div>
                            <button type="submit" class="btn btn-info">Change Name</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-sm mt-5">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif
                        
                        @if (session('password_change'))
                            <div class="alert alert-success">
                                {{ session('password_change') }}
                            </div>
                        @endif
                        <form action="{{ url('password/post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                              <label for="name" class="form-label">Current Password</label>
                              <input type="password" class="form-control" id="name" Placeholder="Enter your current password" name="old_password" value="{{ old('old_password') }}">
                              @error('old_password')
                                  <span class="text-danger">
                                      {{ $message }}
                                  </span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="name" class="form-label">New Password</label>
                              <input type="password" class="form-control" id="name" Placeholder="Enter your new password" name="password" value="{{ old('password') }}">
                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                              <label for="name" class="form-label">Confirm Password</label>
                              <input type="password" class="form-control" id="name" Placeholder="Enter your confirm password" name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-secondary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection