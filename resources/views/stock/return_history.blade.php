@extends('layouts.master')
@section('title', 'Return History')

@section('content')
<h4 class="mb-4">🔁 Returned Stock History</h4>

@if($logs->isEmpty())
    <p>No stock has been returned yet.</p>
@else
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Item Name</th>
                <th>Returned Qty</th>
                <th>Remarks</th>
                <th>Returned On</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($logs as $log)
    @php
        // Extract allotment ID from remark string
        preg_match('/allotment ID: (\d+)/', $log->remarks, $matches);
        $allotmentId = $matches[1] ?? null;
        $allotmentRemark = null;

        if ($allotmentId) {
            $allotmentLog = \App\Models\StockLog::find($allotmentId);
            $allotmentRemark = $allotmentLog->remarks ?? null;
        }
    @endphp

    <tr>
        <td>{{ $log->stock->item_name ?? '—' }}</td>
        <td>{{ $log->amount }}</td>
        <td>{{ $allotmentRemark ?? '—' }}</td>
        <td>{{ $log->created_at->format('d M Y h:i A') }}</td>
    </tr>
@endforeach

        </tbody>
    </table>
@endif
@endsection
