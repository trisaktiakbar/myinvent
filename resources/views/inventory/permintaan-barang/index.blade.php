<x-app-layout :pageTitle="'Dashboard'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Permintaan Barang
            </h6>
        </div>
        <div class="card-body">
            {{-- <p class="mb-0">This is a sample page </p> --}}

            <a href="{{ route('permintaan-barang.create') }}" class="btn btn-primary">
                <i class="ti ti-plus"></i>
                &nbsp;
                Tambah Data
            </a>

            <div class="overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-nowrap">No.</th>
                            <th scope="col" class="text-nowrap">Kode Item</th>
                            <th scope="col" class="text-nowrap">Nama Item</th>
                            <th scope="col" class="text-nowrap">No. PP Manual</th>
                            <th scope="col" class="text-nowrap">No. PR</th>
                            <th scope="col" class="text-nowrap">Kuantitas</th>
                            <th scope="col" class="text-nowrap">Satuan (UoM)</th>
                            <th scope="col" class="text-nowrap">Estimasi Harga</th>
                            <th scope="col" class="text-nowrap">Total</th>
                            <th scope="col" class="text-nowrap">Keterangan Alokasi</th>
                            <th scope="col" class="text-nowrap">Status</th>
                            <th scope="col" class="text-nowrap">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permintaan_barang as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->kode_item }}</td>
                                <td>{{ $item->nama_item }}</td>
                                <td>{{ $item->no_pp_manual ?: '-' }}</td>
                                <td>{{ $item->no_pr ?: '-' }}</td>
                                <td>{{ $item->kuantitas }}</td>
                                <td>{{ $item->uom ?: '-' }}</td>
                                <td class="text-nowrap">
                                    {{ 'Rp ' . number_format($item->estimasi_harga, '0', ',', '.') }}
                                </td>
                                <td class="text-nowrap">
                                    {{ 'Rp ' . number_format($item->estimasi_harga * $item->kuantitas, '0', ',', '.') }}
                                </td>
                                <td>{{ $item->total }}</td>
                                <td>{{ $item->keterangan_alokasi }}</td>
                                <td>Menunggu konfirmasi dari Gudang Pusat</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('permintaan-barang.edit', $item->slug) }}"
                                            class="btn btn-warning" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" title="Hapus"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deletePermintaanBarang{{ $item->id }}Modal">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="deletePermintaanBarang{{ $item->id }}Modal" tabindex="-1"
                                aria-labelledby="deletePermintaanBarang{{ $item->id }}ModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5"
                                                id="deletePermintaanBarang{{ $item->id }}ModalLabel">
                                                Hapus Permintaan Barang ?
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data
                                            <b>{{ $item->nama_item }} ({{ $item->kode_item }})</b>
                                            dari permintaan barang?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-bs-dismiss="modal">
                                                <i class="ti ti-x"></i>&nbsp;Batal
                                            </button>
                                            <form action="{{ route('permintaan-barang.destroy', $item->slug) }}"
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
