@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr>
                    <td>{{ $d->barang_id }}</td>
                    <td>{{ $d->barang_nama }}</td>
                    <td>{{ $d->kategori->kategori_nama }}</td>
                    <td>{{ optional($d->supplier)->supplier_nama }}</td>
                    <td>Rp{{ number_format($d->barang_harga) }}</td>
                    <td>{{ $d->barang_stok }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
