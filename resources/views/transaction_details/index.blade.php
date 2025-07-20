@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Riwayat Transaksi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $d)
                    <tr>
                        <td>{{ $d->transaction->user->name }}</td>
                        <td>{{ $d->item->name }}</td>
                        <td>{{ $d->quantity }}</td>
                        <td>Rp {{ number_format($d->subtotal) }}</td>
                        <td>{{ $d->transaction->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
