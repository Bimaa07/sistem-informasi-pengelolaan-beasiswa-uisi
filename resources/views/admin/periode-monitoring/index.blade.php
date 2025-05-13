@extends('layouts.admin')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Manajemen Periode Monitoring
                    </h1>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative">
                                <select class="form-select" id="filter_beasiswa">
                                    <option value="">Semua Beasiswa</option>
                                    @foreach($beasiswa as $item)
                                    <option value="{{ $item->id }}" {{ request('beasiswa_id')==$item->id ? 'selected' :
                                        '' }}>
                                        {{ $item->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>Beasiswa</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse($periodeMonitoring as $periode)
                                <tr>
                                    <td>{{ $periode->beasiswa->nama }}</td>
                                    <td>{{ $periode->tahun_ajaran }}</td>
                                    <td>{{ ucfirst($periode->semester) }}</td>
                                    <td>
                                        <div
                                            class="badge badge-light-{{ $periode->status === 'aktif' ? 'success' : 'warning' }}">
                                            {{ ucfirst($periode->status) }}
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-icon btn-light-danger delete-periode"
                                            data-id="{{ $periode->id }}" data-bs-toggle="tooltip" title="Hapus Periode">
                                            <i class="ki-outline ki-trash fs-2"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500">
                                        Tidak ada data periode monitoring
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end mt-6">
                            {{ $periodeMonitoring->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    // Filter change handler
    $('#filter_beasiswa').change(function() {
        const beasiswaId = $(this).val();
        const url = new URL(window.location.href);

        if (beasiswaId) {
            url.searchParams.set('beasiswa_id', beasiswaId);
        } else {
            url.searchParams.delete('beasiswa_id');
        }

        window.location.href = url.toString();
    });

    // Delete handler
    $('.delete-periode').click(function() {
        if (!confirm('Apakah Anda yakin ingin menghapus periode ini?')) {
            return;
        }

        const button = $(this);
        const id = button.data('id');

        $.ajax({
            url: `/admin/periode-monitoring/${id}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert(xhr.responseJSON?.message || 'Terjadi kesalahan');
            }
        });
    });
});
</script>
@endpush