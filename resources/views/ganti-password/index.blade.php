<x-app-layout :pageTitle="'Ganti Password'">

    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Pengaturan
            </h6>
        </div>
        <div class="card-body">
            <div class="mb-4 pb-2">
                <a href="{{ route('pengaturan.profil.index') }}" class="btn btn-outline-primary border-0">Profil</a>
                <a href="{{ route('pengaturan.ganti-password.index') }}" class="btn btn-primary border-0">
                    Ganti Password
                </a>
            </div>

            <form action="{{ route('pengaturan.ganti-password.update') }}" method="post">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="password_lama" class="form-label ">Password Lama</label>
                            <input type="password" class="form-control @error('password_lama') is-invalid @enderror"
                                id="password_lama" name="password_lama" placeholder="Password Lama" required>
                            @error('password_lama')
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
                            <label for="password_baru" class="form-label ">Password Baru</label>
                            <input type="password" class="form-control @error('password_baru') is-invalid @enderror"
                                id="password_baru" name="password_baru" placeholder="Password Baru" required>
                            @error('password_baru')
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
                                id="konfirmasi_password" name="konfirmasi_password" placeholder="Konfirmasi Password"
                                required>
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
