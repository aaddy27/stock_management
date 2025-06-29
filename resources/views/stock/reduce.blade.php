@extends('layouts.master')
@section('title', 'Reduce Stock')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h4>Reduce Stock</h4>
        <form method="POST" action="{{ url('/stock/reduce') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Select Item</label>
                <select name="stock_id" class="form-select" required>
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}" {{ old('stock_id') == $stock->id ? 'selected' : '' }}>
                            {{ $stock->item_name }} (Qty: {{ $stock->quantity }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Amount to Reduce</label>
                <input type="number" name="amount" class="form-control" required min="1" value="{{ old('amount') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks (optional)</label>
                <input type="text" name="remarks" class="form-control" value="{{ old('remarks') }}">
            </div>

            <button class="btn btn-danger">Reduce Stock</button>
        </form>
    </div>
</div>

@if ($errors->has('amount'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "{{ $errors->first('amount') }}",
                confirmButtonColor: '#d33'
            });
        });
    </script>
@endif
@endsection
