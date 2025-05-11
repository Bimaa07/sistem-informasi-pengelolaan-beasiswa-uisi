@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mt-4">Manajemen Pengguna</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-plus"></i> Tambah Pengguna
            </button>
        </div>

        <!-- Search Bar -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.users.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Program Studi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span>
                                        {{ $user->role ? $user->role->name_idn : 'No Role' }}
                                    </span>
                                </td>
                                <td>{{ $user->programStudi ? $user->programStudi->nama : '-' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-user" data-user="{{ $user->id }}"
                                        data-bs-toggle="modal" data-bs-target="#editUserModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            class="d-inline delete-user-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <select name="program_studi_id" class="form-select">
                                <option value="">Pilih Program Studi</option>
                                @foreach ($programStudi as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role_id" class="form-select" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name_idn }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Similar fields as Add User Modal -->
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <select name="program_studi_id" class="form-select">
                                <option value="">Pilih Program Studi</option>
                                @foreach ($programStudi as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role_id" class="form-select" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name_idn }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Handle Edit User
        $('.edit-user').click(function() {
            const userId = $(this).data('user');
            const user = @json($users->keyBy('id'));
            const userData = user[userId];

            const form = $('#editUserForm');
            form.attr('action', `/admin/users/${userId}`);
            form.find('[name=name]').val(userData.name);
            form.find('[name=email]').val(userData.email);
            form.find('[name=role_id]').val(userData.role_id);
            form.find('[name=program_studi_id]').val(userData.program_studi_id);
        });

        // Handle Delete User
        $('.delete-user-form').submit(function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                this.submit();
            }
        });

        // Show validation errors in modal if any
        @if ($errors->any())
            const modal = new bootstrap.Modal(document.getElementById('addUserModal'));
            modal.show();
        @endif
    </script>
@endpush
