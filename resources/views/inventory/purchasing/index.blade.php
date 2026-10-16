<x-app-layout :pageTitle="'Inventory - Purchasing'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Purchasing
            </h6>
        </div>
        <div class="card-body">


            <div class="overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-nowrap">No.</th>
                            <th scope="col" class="text-nowrap">Kode Item</th>
                            <th scope="col" class="text-nowrap">Nama Item</th>
                            <th scope="col" class="text-nowrap">No. PP Manual</th>
                            <th scope="col" class="text-nowrap">No. PR</th>
                            <th scope="col" class="text-nowrap">No. PO</th>
                            <th scope="col" class="text-nowrap">Kuantitas</th>
                            <th scope="col" class="text-nowrap">Satuan (UoM)</th>
                            <th scope="col" class="text-nowrap">Estimasi Harga</th>
                            <th scope="col" class="text-nowrap">Total</th>
                            <th scope="col" class="text-nowrap">Keterangan Alokasi</th>
                            <th scope="col" class="text-nowrap">Status</th>
                            @if (Auth::user()->role === 'Purchasing')
                                <th scope="col" class="text-nowrap">Opsi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-nowrap">
                        @foreach ($permintaan_barang as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->itemCode->kode_item }}</td>
                                <td>{{ $item->itemCode->nama_item }}</td>
                                <td>{{ $item->no_pp_manual ?: '-' }}</td>
                                <td>{{ $item->no_pr ?: '-' }}</td>
                                <td>{{ $item->no_po ?: '-' }}</td>
                                <td>{{ $item->kuantitas }}</td>
                                <td>{{ $item->uom ?: '-' }}</td>
                                <td class="text-nowrap">
                                    {{ 'Rp ' . number_format($item->estimasi_harga, '0', ',', '.') }}
                                </td>
                                <td class="text-nowrap">
                                    {{ 'Rp ' . number_format($item->estimasi_harga * $item->kuantitas, '0', ',', '.') }}
                                </td>
                                <td>{{ $item->keterangan_alokasi }}</td>
                                @if ($item->waktu_konfirmasi_purchasing && $item->no_po)
                                    <td>Barang dikonfirmasi oleh <b>Purchasing</b> pada
                                        <b>
                                            {{ Carbon\Carbon::parse($item->waktu_konfirmasi_gudang_pusat)->format('j M Y, H:i') }}
                                        </b>. <br>
                                        Menunggu konfirmasi dari <b>Gudang Pusat</b>
                                    </td>
                                @else
                                    <td>Menunggu konfirmasi dari <b>Purchasing</b></td>
                                @endif
                                @if (Auth::user()->role === 'Purchasing')
                                    <td>
                                        @if (!$item->waktu_konfirmasi_purchasing)
                                            <button type="button" class="btn btn-primary" title="Hapus"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmPurchasingModal{{ $item->id }}Modal">
                                                <i class="ti ti-check"></i>&nbsp;Konfirmasi
                                            </button>

                                            <div class="modal fade" id="confirmPurchasingModal{{ $item->id }}Modal"
                                                tabindex="-1"
                                                aria-labelledby="confirmPurchasingModal{{ $item->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="confirmPurchasingModal{{ $item->id }}ModalLabel">
                                                                Konfirmasi Barang ?
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('purchasing.confirm', $item->slug) }}"
                                                            method="post">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal-body text-wrap">


                                                                <div class="mb-3">
                                                                    <label for="no_po" class="form-label">
                                                                        No. PO
                                                                    </label>
                                                                    <input type="text"
                                                                        class="form-control  @error('no_po') is-invalid @enderror"
                                                                        id="no_po" name="no_po"
                                                                        value="{{ old('no_po') }}"
                                                                        placeholder="No. PO" required>
                                                                    @error('no_po')
                                                                        <div class="form-text text-danger">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-primary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="ti ti-x"></i>&nbsp;Batal
                                                                </button>

                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="ti ti-truck-delivery"></i>&nbsp;Kirim
                                                                </button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-danger" title="Hapus"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#abortPurchasing{{ $item->id }}Modal">
                                                    <i class="ti ti-x"></i>&nbsp;Batalkan
                                                </button>
                                            </div>

                                            <div class="modal fade" id="abortPurchasing{{ $item->id }}Modal"
                                                tabindex="-1"
                                                aria-labelledby="abortPurchasing{{ $item->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="abortPurchasing{{ $item->id }}ModalLabel">
                                                                Batalkan Konfirmasi Barang ?
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-wrap">
                                                            Apakah Anda ingin membatalkan konfirmasi barang
                                                            <b>
                                                                {{ $item->itemCode->nama_item }}
                                                                ({{ $item->itemCode->kode_item }})</b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-dismiss="modal">Tidak
                                                            </button>
                                                            <form
                                                                action="{{ route('purchasing.abort', $item->slug) }}"
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
