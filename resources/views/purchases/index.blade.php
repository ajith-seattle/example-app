@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="mb-3">
    <a href="{{ route('purchases.pdf') }}" class="btn btn-primary">Export Purchase</a>
</div>

        <div class="row justify-content-center">
            <div class="col-lg-10 margin-tb">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Purchase Management') }}</div>
                    <div class="card-body">
                        <div class="filter-block">
                            <div class="mb-3">
                                <form action="{{ route('purchases.search') }}" method="POST" class="form-inline">
                                    @csrf
                                    <div class="form-group mr-2">
                                        <label for="date">Filter by Date:</label>
                                        <input type="date" name="date" id="date" class="form-control" value="{{ request()->input('date') }}">
                                    </div>
                              
                                    <div class="form-group mr-2">
                                        <label for="category">Filter by Purchase Category:</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">All Categories</option>
                                            @foreach ($purchasecategory as $purchasecategories)
                                                <option value="{{ $purchasecategories->id }}">{{ $purchasecategories->purchase_category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                             
                                    <div class="form-group mr-2">
                                        <label for="location">Filter by Location:</label>
                                        <select name="location" id="location" class="form-control">
                                            <option value="">All Locations</option>
                                            @foreach ($locationnames as $location)
                                                <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                        </div>

                        @if ($purchases->count() > 0)
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Purchase Date</th>
                                    <th>Product Image</th>
                                    <th>Total Amount</th>
                                    <th width="280px">Action</th>
                                </tr>
                                @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $purchase->purchase_date }}</td>
                                        <td><img src="{{ $purchase->product_image }}" width="100"></td>
                                        <td>{{ $purchase->total_amount }}</td>
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
                            </table>
                        @else
                            <p>No results found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{ $purchases->appends(request()->input())->links() }}
    </div>
@endsection
