@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Results</h1>

        <div class="card">
            <div class="card-body">
                <h3>Filtered Results for Date: {{ $date }}</h3>

                @if ($purchases->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Purchase Date</th>
                                <th>Location</th>
                                <th>Location Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $purchase->purchase_date }}</td>
                                    <td>{{ $purchase->project->location->location_name }}</td>
                                    <td>{{ $purchase->project->location->location_details }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No results found for the selected date.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
