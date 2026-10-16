<x-app-layout :pageTitle="'Edit Pengguna Gudang Site'">

    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Edit Pengguna Gudang Site
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('manajemen-pengguna.gudang-site.update', $user->username) }}" method="post">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label ">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user->name) }}"
                                placeholder="Nama Lengkap" required>
                            @error('nama_lengkap')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="username" class="form-label ">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username', $user->username) }}"
                                placeholder="Username" required>
                            @error('username')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="d-flex gap-1">
                            <button class="btn btn-outline-primary" title="Kembali" type="button"
                                onclick="window.location.replace('{{ route('manajemen-pengguna.gudang-site.index') }}')">
                                <i class="ti ti-arrow-left"></i>
                            </button>
                            <button class="btn btn-primary" type="submit" title="Simpan">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>


        </div>
    </div>

    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Reset Password
            </h6>
        </div>
        <div class="card-body pt-0">
            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                data-bs-target="#resetPasswordModal">Reset Password</button>

            <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="resetPasswordModalLabel">Reset Password</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('manajemen-pengguna.gudang-site.reset-password', $user->username) }}"
                            method="post">
                            <div class="modal-body">
                                @csrf
                                @method('put')

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="password" class="form-label ">Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" value="{{ old('password') }}"
                                                placeholder="Password" required>
                                            @error('password')
                                                <div class="form-text text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="konfirmasi_password" class="form-label ">Konfirmasi
                                                Password</label>
                                            <input type="password"
                                                class="form-control @error('konfirmasi_password') is-invalid @enderror"
                                                id="konfirmasi_password" name="konfirmasi_password"
                                                value="{{ old('konfirmasi_password') }}"
                                                placeholder="Konfirmasi Password" required>
                                            @error('konfirmasi_password')
                                                <div class="form-text text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" title="Simpan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>

@if ($errors->has('password') || $errors->has('konfirmasi_password'))
    <script>
        new bootstrap.Modal(document.getElementById('resetPasswordModal')).show();
    </script>
@endif
