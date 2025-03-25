@extends('adminlte::page')

{{-- Extend and customize the browser title --}}
@section('title')
    {{ config('adminlte.title') }} @hasSection('subtitle') | @yield('subtitle') @endif
@stop

@vite('resources/js/app.js')

{{-- Extend and customize the page content header --}}
@section('sidebar')
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Sidebar Menu -->
            <li class="nav-item">
                <a href="{{ route('kategori.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Manage Kategori</p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Kategori</p>   
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
@stop

{{-- Rename section content to content_body --}}
@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}
@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>
    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My Company') }}
        </a>
    </strong>
@stop

{{-- Add common JavaScript/JQuery code --}}
@push('js')
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
@endpush
@stack('scripts')

{{-- Add common CSS customizations --}}
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <style type="text/css">
        /* You can add AdminLTE customizations here */
        .card-header {
            border-bottom: none;
        }
        .card-title {
            font-weight: 600;
        }
    </style>
@endpush

@yield('scripts')
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

