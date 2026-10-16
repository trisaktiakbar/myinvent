<x-app-layout :pageTitle="'Tambah Pengguna Gudang Central'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Tambah Pengguna Gudang Central
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('manajemen-pengguna.gudang-central.store') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label ">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
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
                                id="username" name="username" value="{{ old('username') }}" placeholder="Username"
                                required>
                            @error('username')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="password" class="form-label ">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" value="{{ old('password') }}" placeholder="Password"
                                required>
                            @error('password')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="konfirmasi_password" class="form-label ">Konfirmasi Password</label>
                            <input type="password"
                                class="form-control @error('konfirmasi_password') is-invalid @enderror"
                                id="konfirmasi_password" name="konfirmasi_password"
                                value="{{ old('konfirmasi_password') }}" placeholder="Konfirmasi Password" required>
                            @error('konfirmasi_password')
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
                                onclick="window.location.replace('{{ route('manajemen-pengguna.gudang-central.index') }}')">
                                <i class="ti ti-arrow-left"></i>
                            </button>
                            <button class="btn btn-primary" type="submit" title="Simpan">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>


        </div>
    </div>

    <script>
        function rupiahFormat(input) {
            input = input.replace(/[^0-9]/g, '');
            input = new Intl.NumberFormat("id").format(input)
            return input
        }

        let estimasi_harga_el = document.getElementById('estimasi_harga')
        estimasi_harga_el.addEventListener('input', function() {
            estimasi_harga_el.value = rupiahFormat(estimasi_harga_el.value)
        })
    </script>
</x-app-layout>
