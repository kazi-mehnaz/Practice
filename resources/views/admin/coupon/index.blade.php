@extends('layouts.dashboard_master')

@section('coupon')
    active
@endsection

@section('content')
    
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
        <span class="breadcrumb-item active">Add Coupon</span>
    </nav>

    <div class="sl-pagebody">

        <div class="row row-sm">
            <!-- {{-- @if(session('update_status'))
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
            @endif --}} -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>List Coupon</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td>SL No.</td>
                                <td>Coupon Name</td>
                                <td>Discount Amount</td>
                                <td>Validate Till</td>
                                <td>Validate Status</td>
                                <td>Created At</td>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $coupon)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->discount_amount }}%</td>
                                    <td>{{ $coupon->validity_till }}</td>
                                    <td>
                                        @if($coupon->validity_till >= \Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge badge-success">Valide</span>
                                        @else
                                            <span class="badge badge-danger">Invalid</span>
                                        @endif
                                    </td>
                                    <td>{{ $coupon->created_at }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="50" class="text-center text-danger">No date to show</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Coupon
                    </div>
                    <div class="card-body">
                        <!-- {{-- @if(session('success_message'))
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif --}} -->
                        <form action="{{ url('add/coupon/post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                              <label for="name" class="form-label">Coupon Name</label>
                              <input type="text" class="form-control" id="name" name="coupon_name">
                            </div>
                            
                            <div class="mb-3">
                              <label for="name" class="form-label">Discount Amount (%)</label>
                              <input type="text" class="form-control" id="name" name="discount_amount">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Validity Till</label>
                                <input type="date" class="form-control" id="name" name="validity_till" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                              </div>
                            
                            <button type="submit" class="btn btn-success">Add Coupon</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection