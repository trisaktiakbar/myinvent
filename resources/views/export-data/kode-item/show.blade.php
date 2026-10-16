<x-app-layout :pageTitle="'Export Data'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Export Data (Berdasarkan Kode Item)
            </h6>
        </div>
        <div class="card-body">
            <div class="d-flex gap-1 mb-3">
                <form action="{{ route('export-by-kode-item.export', $item_code->slug) }}" method="post">
                    @csrf
                    <button class="btn btn-success" type="submit">Export Excel (.xlsx)</button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-striped text-center text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Item</th>
                            <th scope="col">Nama Item</th>
                            <th scope="col">No. PP Manual</th>
                            <th scope="col">No. PR</th>
                            <th scope="col">No. PO</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Satuan (UoM)</th>
                            <th scope="col">Estimasi Harga</th>
                            <th scope="col">Total</th>
                            <th scope="col">Keterangan Alokasi</th>
                            <th scope="col">No. Pengiriman</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $inventory->itemCode->kode_item }}</td>
                                <td>{{ $inventory->itemCode->nama_item }}</td>
                                <td>{{ $inventory->no_pp_manual ?: '-' }}</td>
                                <td>{{ $inventory->no_pr ?: '-' }}</td>
                                <td>{{ $inventory->no_po ?: '-' }}</td>
                                <td>{{ $inventory->kuantitas }}</td>
                                <td>{{ $inventory->uom ?: '-' }}</td>
                                <td class="text-nowrap">
                                    {{ 'Rp ' . number_format($inventory->estimasi_harga, '0', ',', '.') }}
                                </td>
                                <td class="text-nowrap">
                                    {{ 'Rp ' . number_format($inventory->estimasi_harga * $inventory->kuantitas, '0', ',', '.') }}
                                </td>
                                <td>{{ $inventory->keterangan_alokasi ?: '-' }}</td>
                                <td>{{ $inventory->no_pengiriman ?: '-' }}</td>

                                @if (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_gudang_site)
                                    <td>Barang dikonfirmasi oleh <b>Gudang Site</b> pada
                                        <b>
                                            {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_site)->format('j M Y, H:i') }}
                                        </b>.
                                    </td>
                                @elseif (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_gudang_central)
                                    <td>Barang dikonfirmasi oleh <b>Gudang Central</b> pada
                                        <b>
                                            {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_central)->format('j M Y, H:i') }}
                                        </b>.<br>
                                        Menunggu konfirmasi dari <b>Gudang Site</b>
                                    </td>
                                @elseif (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_gudang_pusat)
                                    @if ($inventory->no_pengiriman)
                                        @if ($inventory->pengiriman_langsung_gudang_site)
                                            <td>Barang dikonfirmasi oleh <b>Gudang Pusat</b> pada
                                                <b>
                                                    {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_pusat)->format('j M Y, H:i') }}
                                                </b>. <br>
                                                Menunggu konfirmasi dari <b>Gudang Site</b>
                                            </td>
                                        @else
                                            <td>Barang dikonfirmasi oleh <b>Gudang Pusat</b> pada
                                                <b>
                                                    {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_pusat)->format('j M Y, H:i') }}
                                                </b>. <br>
                                                Menunggu konfirmasi dari <b>Gudang Central</b>
                                            </td>
                                        @endif
                                    @else
                                        <td>Barang dikonfirmasi oleh <b>Gudang Pusat</b> pada
                                            <b>{{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_pusat)->format('j M Y, H:i') }}</b>.
                                            <br>
                                            Menunggu <b>Gudang Pusat</b> mengatur pengiriman menuju <b>Gudang
                                                Central</b>
                                        </td>
                                    @endif
                                @elseif (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_purchasing)
                                    <td>Barang dikonfirmasi oleh <b>Purchasing</b> pada
                                        <b>
                                            {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_purchasing)->format('j M Y, H:i') }}
                                        </b>.<br>
                                        Menunggu konfirmasi dari <b>Gudang Pusat</b>
                                    </td>
                                @elseif (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_time_planner_ho)
                                    <td>Barang dikonfirmasi oleh <b>Time Planner HO</b> pada
                                        <b>
                                            {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_purchasing)->format('j M Y, H:i') }}
                                        </b>.<br>
                                        Menunggu konfirmasi dari <b>Purchasing</b>
                                    </td>
                                @elseif(!$inventory->pembelian_lokal)
                                    <td>Permintaan barang telah dikonfirmasi pada
                                        <b>{{ Carbon\Carbon::parse($inventory->updated_at)->format('j M Y, H:i') }}</b>.
                                        Menunggu
                                        konfirmasi dari <b>Time Planner HO</b>.
                                    </td>
                                @elseif($inventory->pembelian_lokal)
                                    <td>Pembelian lokal telah dikonfirmasi pada
                                        <b>{{ Carbon\Carbon::parse($inventory->updated_at)->format('j M Y, H:i') }}</b>
                                        oleh <b>Gudang Site</b>
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
