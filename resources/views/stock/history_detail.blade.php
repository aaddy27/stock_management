@extends('layouts.master')
@section('title', 'Allotment History')

@section('content')
<h4 class="mb-3">📦 Allotment History for: <strong>{{ $stock->item_name }}</strong></h4>

@if ($logs->isEmpty())
    <p>No allotment history found.</p>
@else
  <table class="table table-striped">
    <thead>
        <tr>
            <th>Allotted Amount</th>
            <th>Returned</th>
            <th>Left</th>
            <th>Remarks</th>
            <th>Allotted On</th>
            <th>Return</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logs as $log)
            @php
                $returnTotal = \App\Models\StockLog::where('type', 'return')
                    ->where('stock_id', $log->stock_id)
                    ->where('remarks', 'like', '%allotment ID: ' . $log->id . '%')
                    ->sum('amount');

                $leftQty = $log->amount - $returnTotal;
            @endphp

            @if ($leftQty <= 0)
                @continue
            @endif

            <tr>
                <td>{{ $log->amount }}</td>
                <td>{{ $returnTotal }}</td>
                <td><strong>{{ $leftQty }}</strong></td>
                <td>{{ $log->remarks ?? '—' }}</td>
                <td>{{ $log->created_at->format('d M Y h:i A') }}</td>
                <td>
                    <form method="POST" action="{{ route('stock.return', $log->id) }}" class="d-flex gap-2">
                        @csrf
                        <input type="number" name="return_amount" class="form-control form-control-sm w-50"
                               placeholder="Qty" min="1" max="{{ $leftQty }}" required>
                        <button class="btn btn-success btn-sm">Return</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endif

<a href="{{ route('stock.history') }}" class="btn btn-secondary mt-3">⬅ Back</a>
@endsection
