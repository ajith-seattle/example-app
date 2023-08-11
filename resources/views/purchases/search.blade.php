@extends('layouts.app')

@section('content')
    <div class="container create-content">

     <div class="pull-right">
            <a class="btn btn-primary btn-reverse" href="{{ route('purchases.index') }}"> Back</a>
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
                                <th width="90px">Edit</th>
            <th width="90px">Delete</th>
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
                                            <a  href="{{ route('purchases.edit', $purchase->id) }}"><span><svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10 3.12134H3C2.46957 3.12134 1.96086 3.33205 1.58579 3.70712C1.21071 4.0822 1 4.5909 1 5.12134V19.1213C1 19.6518 1.21071 20.1605 1.58579 20.5356C1.96086 20.9106 2.46957 21.1213 3 21.1213H17C17.5304 21.1213 18.0391 20.9106 18.4142 20.5356C18.7893 20.1605 19 19.6518 19 19.1213V12.1213" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17.5 1.62132C17.8978 1.2235 18.4374 1 19 1C19.5626 1 20.1022 1.2235 20.5 1.62132C20.8978 2.01915 21.1213 2.55871 21.1213 3.12132C21.1213 3.68393 20.8978 4.2235 20.5 4.62132L11 14.1213L7 15.1213L8 11.1213L17.5 1.62132Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span></a>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn"  onclick="return confirm('Are you sure?')"><svg width="23" height="23" viewBox="0 0 800 800" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_17_9)">
<path d="M800 517.419C800 673.548 673.548 800 517.419 800H282.581C126.452 800 0 673.548 0 517.419V282.581C0 126.452 126.452 0 282.581 0H517.419C673.548 0 800 126.452 800 282.581V517.419Z" fill="#CE0909"/>
<path d="M0 282.581C0 126.452 126.452 0 282.581 0H517.419C673.548 0 800 126.452 800 282.581V517.419C800 673.548 673.548 800 517.419 800" fill="#B70000"/>
<path d="M517.422 0C673.551 0 800.003 126.452 800.003 282.581V517.419C800.003 673.548 673.551 800 517.422 800" fill="#960000"/>
<path d="M427.098 423.226L535.485 314.839C543.227 307.097 543.227 295.484 535.485 287.742C527.743 280 516.13 280 508.388 287.742L400.001 396.129L291.614 287.742C283.872 280 272.259 280 264.517 287.742C256.775 295.484 256.775 307.097 264.517 314.839L372.904 423.226L264.517 531.613C256.775 539.355 256.775 550.968 264.517 558.71C268.388 562.581 273.55 563.871 277.421 563.871C281.292 563.871 286.453 562.581 290.324 558.71L398.711 450.323L507.098 558.71C510.969 562.581 516.13 563.871 520.001 563.871C523.872 563.871 529.033 562.581 532.904 558.71C540.646 550.968 540.646 539.355 532.904 531.613L427.098 423.226Z" fill="#960000"/>
<path d="M427.098 400L535.485 291.613C543.227 283.871 543.227 272.258 535.485 264.516C527.743 256.774 516.13 256.774 508.388 264.516L400.001 372.903L291.614 264.516C283.872 256.774 272.259 256.774 264.517 264.516C256.775 272.258 256.775 283.871 264.517 291.613L372.904 400L264.517 508.387C256.775 516.129 256.775 527.742 264.517 535.484C268.388 539.355 273.55 540.645 277.421 540.645C281.292 540.645 286.453 539.355 290.324 535.484L398.711 427.097L507.098 535.484C510.969 539.355 516.13 540.645 520.001 540.645C523.872 540.645 529.033 539.355 532.904 535.484C540.646 527.742 540.646 516.129 532.904 508.387L427.098 400Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_17_9">
<rect width="800" height="800" fill="white"/>
</clipPath>
</defs>
</svg></button>
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
