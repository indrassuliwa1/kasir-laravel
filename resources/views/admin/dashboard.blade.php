<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Kasir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .section-title {
            font-weight: 600;
            font-size: 20px;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Admin Kasir</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('items.index') }}">Input Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('transactions.index') }}">Transaksi</a>
                </li>
            </ul>
        </div>
        <div class="ms-auto">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h3 class="mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>

        <div class="row">
            <!-- Kolom Pilih Barang -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-title">Pilih Barang</h5>

                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="item_id" class="form-label">Nama Barang</label>
                                <select class="form-select" name="item_id" id="item_id" required>
                                    <option disabled selected>Pilih Barang</option>
                                    @foreach (\App\Models\Item::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Jumlah</label>
                                <div class="input-group">
                                    <input type="number" name="quantity" id="quantity" class="form-control" min="1"
                                        required>
                                    <span class="input-group-text">Unit</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Tambah</button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Kolom Pembayaran -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-title">Pembayaran</h5>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Total</label>
                                <input type="text" class="form-control"
                                    value="Rp {{ number_format(\App\Models\Cart::with('item')->get()->sum(fn($c) => $c->item->price * $c->quantity), 0, ',', '.') }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Bayar</label>
                                <input type="number" class="form-control" name="pay_total" required
                                    placeholder="Masukkan jumlah bayar">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Bayar</label>
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" disabled>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tabel Transaksi -->
        <div class="card">
            <div class="card-body">
                <h5 class="section-title">Tabel Keranjang</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $carts = \App\Models\Cart::with('item')->get();
                            @endphp

                            @forelse ($carts as $i => $cart)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $cart->item->name }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>Rp {{ number_format($cart->item->price, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($cart->item->price * $cart->quantity, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus?')" class="d-inline">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Keranjang kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
