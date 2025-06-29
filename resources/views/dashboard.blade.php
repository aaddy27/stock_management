@extends('layouts.master')

@section('title', 'Stock Dashboard')

@section('content')
<div class="row text-center">
    <div class="col-md-3">
        <a href="{{ route('stock.add') }}" class="card bg-success text-white p-4 text-decoration-none shadow">
            <h4>Add Stock</h4>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('stock.reduce') }}" class="card bg-danger text-white p-4 text-decoration-none shadow">
            <h4>Reduce Stock</h4>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('stock.allot') }}" class="card bg-warning text-dark p-4 text-decoration-none shadow">
            <h4>Allot Stock</h4>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('stock.restock') }}" class="card bg-primary text-white p-4 text-decoration-none shadow">
            <h4>Restock</h4>
        </a>
    </div>
    <div class="row text-center mt-5">
    <div class="col-md-6">
        <a href="{{ route('stock.report') }}" class="card bg-info text-white p-4 text-decoration-none shadow">
            <h4>📋 All Stock Report</h4>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('stock.history') }}" class="card bg-secondary text-white p-4 text-decoration-none shadow">
            <h4>📦 Stock Allotment History</h4>
        </a>
    </div>
</div>
<div class="col-md-4 mt-3">
    <a href="{{ route('stock.return.history') }}" class="card bg-success text-white p-4 text-decoration-none shadow">
        <h5>🔁 View Return History</h5>
    </a>
</div>

</div>
@endsection
