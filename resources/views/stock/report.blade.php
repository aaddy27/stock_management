@extends('layouts.master')
@section('title', 'Stock Report')

@section('content')
<h4 class="mb-4">📋 All Stock Summary</h4>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Item Name</th>
            <th>Category</th>
            <th>Current Quantity</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($stocks as $stock)
            <tr>
                <td>{{ $stock->item_name }}</td>
                <td>{{ $stock->category ?? '—' }}</td>
                <td>{{ $stock->quantity }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No stock available.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
