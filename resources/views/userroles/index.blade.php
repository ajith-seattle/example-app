@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <!-- Add more table headers if needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($userRoles as $userRole)
                    <tr>
                        <td>{{ $userRole->id }}</td>
                        <td>{{ $userRole->name }}</td>
                        <!-- Add more table cells with corresponding user role properties -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
