@extends('layouts.dashboard_master')

@section('contact')
    active
@endsection

@section('content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
        <span class="breadcrumb-item active">Contact List</span>
    </nav>

    <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Contact List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td>Serial No.</td>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Gmail</td>
                                <td>Subject</td>
                                <td>Message</td>
                                <td>Created At</td>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->message }}</td>
                                        <!-- <td>{{ $contact->created_at }}</td> -->
                                        <td>
                                            @if($contact->created_at)
                                                {{ $contact->created_at->diffForHumans() }}
                                            @else
                                                <span class="bg-danger text-white">No time to show</span>
                                            @endif
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
            </div>
        </div>
    </div>
</div>

@endsection