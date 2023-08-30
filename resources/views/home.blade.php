@extends('layouts.app')

@section('content')
    <div class="container">


<div class="chart-wrap">
    <div class="purchase-chart">

        <canvas  id="purchaseChart" class="chart1"  ></canvas>
    </div>
    <div class="donought-chart">

        <canvas id="donutChart"></canvas>
    </div>
    </div>


        <div class="row ">
            
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
                        <th>Project Name</th>
            <th>Location</th>
            <th>Purchase Category</th>
                        <th>Total Amount</th>
                    </tr>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $purchase->purchase_date }}</td>
                            <td>{{ $purchase->project->project_name }}</td>
                            <td>{{ $purchase->location->location_name }}</td>
                            <td>{{ $purchase->purchaseCategory->purchase_category }}</td>

                            <td>{{ $purchase->total_amount }}</td>
                        </tr>
                    @endforeach
                </table>
                {{ $purchases->appends(request()->input())->links() }}
            @else
                <p>No results found.</p>
            @endif
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('purchaseChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($purchase_dates) !!},
                datasets: [{
                    label: 'Purchase Amount',
                    data: {!! json_encode($purchase_amounts) !!},
                    backgroundColor: 'rgba(100, 100, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var donutCtx = document.getElementById('donutChart').getContext('2d');
        var donutChart = new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($purchase_dates) !!},
                datasets: [{
                    data: {!! json_encode($purchase_amounts) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
            legend: {
                display: false,
               
            }
        }
            }
        });
    });
</script>
