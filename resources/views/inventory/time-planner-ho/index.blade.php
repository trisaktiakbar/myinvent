<x-app-layout :pageTitle="'Inventory - Time Planner HO'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Time Planner HO
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
                            <th scope="col" class="text-nowrap">Kuantitas</th>
                            <th scope="col" class="text-nowrap">Satuan (UoM)</th>
                            <th scope="col" class="text-nowrap">Estimasi Harga</th>
                            <th scope="col" class="text-nowrap">Total</th>
                            <th scope="col" class="text-nowrap">Keterangan Alokasi</th>
                            <th scope="col" class="text-nowrap">No. Pengiriman</th>
                            <th scope="col" class="text-nowrap">Status</th>
                            @if (Auth::user()->role === 'Time Planner HO')
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
                                <td>{{ $item->kuantitas }}</td>
                                <td>{{ $item->uom ?: '-' }}</td>
                                <td class="text-nowrap">
                                    {{ 'Rp ' . number_format($item->estimasi_harga, '0', ',', '.') }}
                                </td>
                                <td class="text-nowrap">
                                    {{ 'Rp ' . number_format($item->estimasi_harga * $item->kuantitas, '0', ',', '.') }}
                                </td>
                                <td>{{ $item->keterangan_alokasi }}</td>
                                <td>{{ $item->no_pengiriman ?: '-' }}</td>
                                @if ($item->waktu_konfirmasi_time_planner_ho && $item->no_pr)
                                    <td>Barang dikonfirmasi oleh <b>Time Planner HO</b> pada
                                        <b>
                                            {{ Carbon\Carbon::parse($item->waktu_konfirmasi_gudang_pusat)->format('j M Y, H:i') }}
                                        </b>. <br>
                                        Menunggu konfirmasi dari <b>Purchasing</b>
                                    </td>
                                @else
                                    <td>Menunggu konfirmasi dari <b>Time Planner HO</b></td>
                                @endif
                                @if (Auth::user()->role === 'Time Planner HO')
                                    <td>
                                        @if (!$item->waktu_konfirmasi_time_planner_ho)
                                            <button type="button" class="btn btn-primary" title="Hapus"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmTimePlannerHOModal{{ $item->id }}Modal">
                                                <i class="ti ti-check"></i>&nbsp;Konfirmasi
                                            </button>

                                            <div class="modal fade"
                                                id="confirmTimePlannerHOModal{{ $item->id }}Modal" tabindex="-1"
                                                aria-labelledby="confirmTimePlannerHOModal{{ $item->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="confirmTimePlannerHOModal{{ $item->id }}ModalLabel">
                                                                Konfirmasi Barang ?
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form
                                                            action="{{ route('time-planner-ho.confirm', $item->slug) }}"
                                                            method="post">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal-body text-wrap">


                                                                <div class="mb-3">
                                                                    <label for="no_pr" class="form-label">
                                                                        No. PR
                                                                    </label>
                                                                    <input type="text"
                                                                        class="form-control  @error('no_pr') is-invalid @enderror"
                                                                        id="no_pr" name="no_pr"
                                                                        value="{{ old('no_pr') }}"
                                                                        placeholder="No. PR" required>
                                                                    @error('no_pr')
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
                                                    data-bs-target="#abortTimePlannerHO{{ $item->id }}Modal">
                                                    <i class="ti ti-x"></i>&nbsp;Batalkan
                                                </button>
                                            </div>

                                            <div class="modal fade" id="abortTimePlannerHO{{ $item->id }}Modal"
                                                tabindex="-1"
                                                aria-labelledby="abortTimePlannerHO{{ $item->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="abortTimePlannerHO{{ $item->id }}ModalLabel">
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
                                                                action="{{ route('time-planner-ho.abort', $item->slug) }}"
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
