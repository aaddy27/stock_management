@extends('layouts.master')
@section('title', 'Restock Item')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h4>Restock Item</h4>
        <form method="POST" action="{{ url('/stock/restock') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Select Item</label>
                <select name="stock_id" class="form-select" required>
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}">{{ $stock->item_name }} (Qty: {{ $stock->quantity }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Restock Amount</label>
                <input type="number" name="amount" class="form-control" required min="1">
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks (optional)</label>
                <input type="text" name="remarks" class="form-control">
            </div>

            <button class="btn btn-primary">Restock</button>
        </form>
    </div>
</div>
@endsection
