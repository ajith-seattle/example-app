@extends('layouts.app')

@section('content')
    <div class="container">

     <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('purchases.index') }}"> Back</a>
        </div>
        <h1>Purchase Details</h1>

        <div class="card">
            <div class="card-header">{{ __('Filtered Results') }}</div>
            <div class="card-body">
                @if (!empty($date))
                    <h3>Filtered Results for Date: {{ $date }}</h3>
                @endif

                @if (!empty($category))
                    @php
                        $selectedCategory = $purchasecategory->firstWhere('id', $category);
                    @endphp
                    <h3>Filtered Results for Purchase Category: {{ $selectedCategory->purchase_category }}</h3>
                @endif

                @if ($purchases->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Purchase Date</th>
                                <th>Project Name</th>
                                <th>Location</th>
                                <th>Purchase Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purchase->purchase_date }}</td>
                                    <td>{{ $purchase->project->project_name }}</td>
                                    <td>{{ $purchase->location->location_name }}</td>
                                    <td>{{ $purchase->purchaseCategory->purchase_category }}</td>
                                    <td>
                                        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST">
                                            <a class="btn btn-primary" href="{{ route('purchases.edit', $purchase->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No results found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
