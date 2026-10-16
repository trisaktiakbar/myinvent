<x-app-layout :pageTitle="'Manajemen Pengguna Gudang Site'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Manajemen Pengguna Gudang Site
            </h6>
        </div>
        <div class="card-body">

            <a href="{{ route('manajemen-pengguna.gudang-site.create') }}" class="btn btn-primary">
                <i class="ti ti-plus"></i>
                &nbsp;
                Tambah Akun
            </a>

            <div class="overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-nowrap">No.</th>
                            <th scope="col" class="text-nowrap">Nama Lengkap</th>
                            <th scope="col" class="text-nowrap">Username</th>
                            <th scope="col" class="text-nowrap">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('manajemen-pengguna.gudang-site.edit', $user->username) }}"
                                            class="btn btn-warning" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" title="Hapus"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteUser{{ $user->username }}Modal">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteUser{{ $user->username }}Modal" tabindex="-1"
                                aria-labelledby="deleteUser{{ $user->username }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteUser{{ $user->username }}ModalLabel">
                                                Hapus Item ?
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus pengguna
                                            <b>{{ $user->name }} ({{ $user->username }})</b>
                                            ? Semua data yang terkait dengan pengguna tersebut akan dihapus.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-bs-dismiss="modal">
                                                <i class="ti ti-x"></i>&nbsp;Batal
                                            </button>
                                            <form
                                                action="{{ route('manajemen-pengguna.gudang-site.destroy', $user->username) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="ti ti-trash"></i>&nbsp;Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
