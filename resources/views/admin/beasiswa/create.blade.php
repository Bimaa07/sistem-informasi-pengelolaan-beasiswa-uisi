@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mt-4">Tambah Beasiswa</h1>
        </div>

        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.beasiswa.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label required">Jenis Beasiswa</label>
                        <select name="nama" class="form-select @error('nama') is-invalid @enderror" required>
                            <option value="">Pilih jenis beasiswa</option>
                            @foreach (App\Models\Beasiswa::$namaToTitle as $value => $title)
                                <option value="{{ $value }}" {{ old('nama') == $value ? 'selected' : '' }}>
                                    {{ $title }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <a href="{{ route('admin.beasiswa.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
