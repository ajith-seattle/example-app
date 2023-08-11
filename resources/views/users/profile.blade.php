<!-- profile.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update.profile') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" class="form-control" placeholder="Password" value="{{ $user->password }}">
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $user->phone }}">
            </div>
        </div>
                            <!-- Add more form fields for other profile data as needed... -->
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
