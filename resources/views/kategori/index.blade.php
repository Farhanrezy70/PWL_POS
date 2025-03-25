@extends('layouts.app')

@section('subtitle', 'Kategori')

@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Manage Kategori</h5>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Kategori
                </a>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
function deleteKategori(id) {
    if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
        $.ajax({
            url: "/kategori/" + id,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                alert(response.success);
                location.reload();
            },
            error: function(xhr) {
                alert("Terjadi kesalahan saat menghapus data.");
            }
        });
    }
}
</script>
@endsection


@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
