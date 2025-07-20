@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Daftar Transaksi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Dibayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->user->name }}</td>
                        <td>Rp {{ number_format($t->total) }}</td>
                        <td>Rp {{ number_format($t->pay_total) }}</td>
                        <td>
                            <a href="{{ route('transaction-details.index', $t->id) }}" class="btn btn-sm btn-primary">Lihat
                                Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
