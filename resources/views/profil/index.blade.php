<x-app-layout :pageTitle="'Profil'">

    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Pengaturan
            </h6>
        </div>
        <div class="card-body">
            <div class="mb-4 pb-2">
                <a href="{{ route('pengaturan.profil.index') }}" class="btn btn-primary border-0">Profil</a>
                <a href="{{ route('pengaturan.ganti-password.index') }}" class="btn btn-outline-primary border-0">
                    Ganti Password
                </a>
            </div>

            <form action="{{ route('pengaturan.profil.update') }}" method="post">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label ">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                id="nama_lengkap" name="nama_lengkap"
                                value="{{ old('nama_lengkap', Auth::user()->name) }}" placeholder="Nama Lengkap"
                                required>
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
                                id="username" name="username" value="{{ old('username', Auth::user()->username) }}"
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
                                onclick="window.location.replace('{{ route('pengaturan.profil.index') }}')">
                                <i class="ti ti-arrow-left"></i>
                            </button>
                            <button class="btn btn-primary" type="submit" title="Simpan">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>


        </div>
    </div>




</x-app-layout>
