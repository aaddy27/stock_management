@extends('layouts.master')
@section('title', 'Add Stock')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h4>Add New Stock</h4>
        <form method="POST" action="{{ url('/stock/add') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Item Name</label>
                <input type="text" name="item_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" required min="1">
            </div>

            <button class="btn btn-success">Add Stock</button>
        </form>
    </div>
</div>
@endsection
