@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mt-4">Tambah Beasiswa Ongoing</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.beasiswa-ongoing.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Jenis Beasiswa</label>
                        <select name="beasiswa_id" class="form-select" required>
                            <option value="">Pilih jenis beasiswa</option>
                            @foreach ($beasiswa as $b)
                                <option value="{{ $b->id }}" {{ old('beasiswa_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->getNamaBeasiswaLabel() }}
                                </option>
                            @endforeach
                        </select>
                        @error('beasiswa_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control" required
                            value="{{ old('tahun_ajaran') }}" placeholder="Contoh: 2024/2025">
                        @error('tahun_ajaran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" required
                                value="{{ old('tanggal_mulai') }}">
                            @error('tanggal_mulai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" required
                                value="{{ old('tanggal_selesai') }}">
                            @error('tanggal_selesai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="">Pilih status</option>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="ditutup" {{ old('status') == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten/Deskripsi</label>
                        <textarea name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <a href="{{ route('admin.beasiswa-ongoing.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
