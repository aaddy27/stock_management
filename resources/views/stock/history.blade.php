@extends('layouts.master')
@section('title', 'Stock Allotment History')

@section('content')
<h4 class="mb-4">🔍 Select Stock to View Allotment History</h4>

<form method="GET" action="">
    <div class="mb-3">
        <select class="form-select" onchange="window.location.href='/stock/history/' + this.value">
            <option selected disabled>-- Select Stock --</option>
            @foreach ($stocks as $stock)
                <option value="{{ $stock->id }}">{{ $stock->item_name }} (Qty: {{ $stock->quantity }})</option>
            @endforeach
        </select>
    </div>
</form>
@endsection

