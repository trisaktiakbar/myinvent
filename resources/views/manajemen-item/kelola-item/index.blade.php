<x-app-layout :pageTitle="'Kelola Item'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Permintaan Barang
            </h6>
        </div>
        <div class="card-body">
            {{-- <p class="mb-0">This is a sample page </p> --}}

            <a href="{{ route('kelola-item.create') }}" class="btn btn-primary mb-3">
                <i class="ti ti-plus"></i>
                &nbsp;
                Tambah Data
            </a>

            <form action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari" aria-label="Cari"
                        aria-describedby="button-search" id="search" name="search"
                        value="{{ old('search', request()->query('search')) }}">
                    <button class="btn btn-outline-primary" type="submit" id="button-search"> <i
                            class="ti ti-search"></i></button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-nowrap">No.</th>
                            <th scope="col" class="text-nowrap">Kode Item</th>
                            <th scope="col" class="text-nowrap">Nama Item</th>
                            <th scope="col" class="text-nowrap">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item_codes as $item_code)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item_code->kode_item }}</td>
                                <td>{{ $item_code->nama_item }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('kelola-item.edit', $item_code->slug) }}"
                                            class="btn btn-warning" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" title="Hapus"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteItemCode{{ $item_code->id }}Modal">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteItemCode{{ $item_code->id }}Modal" tabindex="-1"
                                aria-labelledby="deleteItemCode{{ $item_code->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5"
                                                id="deleteItemCode{{ $item_code->id }}ModalLabel">
                                                Hapus Item ?
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus item
                                            <b>{{ $item_code->nama_item }} ({{ $item_code->kode_item }})</b>
                                            ? Semua data yang terkait dengan item tersebut akan dihapus.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-bs-dismiss="modal">
                                                <i class="ti ti-x"></i>&nbsp;Batal
                                            </button>
                                            <form action="{{ route('kelola-item.destroy', $item_code->slug) }}"
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
