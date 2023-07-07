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
                @foreach ($userroles as $userrole)
                    <tr>
                        <td>{{ $userrole->id }}</td>
                        <td>{{ $userrole->name }}</td>
                        <!-- Add more table cells with corresponding user role properties -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
