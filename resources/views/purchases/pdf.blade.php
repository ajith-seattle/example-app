<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add any necessary styling for the table here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Purchases Table</h1>
    @if ($purchases->count() > 0)
    <table>
        <tr>
            <th>No</th>
            <th>Purchase Date</th>
            <th>Project Name</th>
            <th>Project Location</th>
            <th>Purchase Category</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subcontractor</th>
            <th>State</th>
            <th>Total Amount</th>
        </tr>
        @foreach ($purchases as $purchase)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $purchase->purchase_date }}</td>
            <td>{{ $purchase->project->project_name }}</td>
            <td>{{ $purchase->location->location_name }}</td>
            <td>{{ $purchase->purchaseCategory->purchase_category }}</td>
            <td>{{ $purchase->first_name }}</td>
            <td>{{ $purchase->last_name }}</td>
            <td>{{ $purchase->email }}</td>
            <td>{{ $purchase->phone }}</td>
            <td>{{ $purchase->User->name }}</td>
            <td>{{ $purchase->State->state_name }}</td>
            <td>{{ $purchase->total_amount }}</td>
        </tr>
        @endforeach
    </table>
    @else
    <p>No purchases available.</p>
    @endif
</body>
</html>
