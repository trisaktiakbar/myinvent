<x-app-layout :pageTitle="'Dashboard'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Gudang Pusat
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
                            @if (Auth::user()->role === 'Gudang Pusat')
                                <th scope="col" class="text-nowrap">Opsi</th>
                            @endif
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
                                <td>{{ $item->keterangan_alokasi }}</td>
                                @if ($item->waktu_konfirmasi_gudang_pusat)
                                    <td>Barang dikonfirmasi oleh Gudang Pusat pada
                                        <b>
                                            {{ Carbon\Carbon::parse($item->waktu_konfirmasi_gudang_pusat)->format('j M Y, H:i') }}
                                        </b>. <br>
                                        Menunggu konfirmasi dari Gudang Central
                                    </td>
                                @else
                                    <td>Menunggu konfirmasi dari Gudang Pusat</td>
                                @endif
                                @if (Auth::user()->role === 'Gudang Pusat')
                                    <td>
                                        @if (!$item->waktu_konfirmasi_gudang_pusat)
                                            <button type="button" class="btn btn-primary" title="Hapus"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmGudangPusat{{ $item->id }}Modal">
                                                <i class="ti ti-check"></i>&nbsp;Konfirmasi
                                            </button>

                                            <div class="modal fade" id="confirmGudangPusat{{ $item->id }}Modal"
                                                tabindex="-1"
                                                aria-labelledby="confirmGudangPusat{{ $item->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="confirmGudangPusat{{ $item->id }}ModalLabel">
                                                                Konfirmasi Penerimaan Barang ?
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda ingin mengonfirmasi penerimaan barang <b>
                                                                {{ $item->nama_item }} ({{ $item->kode_item }})</b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-primary"
                                                                data-bs-dismiss="modal">
                                                                <i class="ti ti-x"></i>&nbsp;Batal
                                                            </button>
                                                            <form
                                                                action="{{ route('gudang-pusat.confirm', $item->slug) }}"
                                                                method="post">
                                                                @method('put')
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="ti ti-check"></i>&nbsp;Konfirmasi
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <button type="button" class="btn btn-danger" title="Hapus"
                                                data-bs-toggle="modal"
                                                data-bs-target="#abortGudangPusat{{ $item->id }}Modal">
                                                <i class="ti ti-check"></i>&nbsp;Batalkan
                                            </button>

                                            <div class="modal fade" id="abortGudangPusat{{ $item->id }}Modal"
                                                tabindex="-1"
                                                aria-labelledby="abortGudangPusat{{ $item->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="abortGudangPusat{{ $item->id }}ModalLabel">
                                                                Batalkan Konfirmasi Penerimaan Barang ?
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda ingin membatalkan konfirmasi penerimaan barang
                                                            <b>
                                                                {{ $item->nama_item }} ({{ $item->kode_item }})</b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-dismiss="modal">Tidak
                                                            </button>
                                                            <form
                                                                action="{{ route('gudang-pusat.abort', $item->slug) }}"
                                                                method="post">
                                                                @method('put')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">
                                                                    Ya, batalkan
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
