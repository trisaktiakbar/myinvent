<table>

    <tr>
        <td colspan="10"><b>DATA INVENTARIS BERDASARKAN KODE ITEM</b></td>
    </tr>
    <tr>
        <td>Kode Item</td>
        <td>{{ $item_code->kode_item }}</td>
    </tr>
    <tr>
        <td>Nama Item</td>
        <td>{{ $item_code->nama_item }}</td>
    </tr>
    <tr></tr>

    <tr>
        <th style="border: 5px solid black; background-color: #FFFF00">No.</th>
        <th style="border: 5px solid black; background-color: #FFFF00">Kode Item</th>
        <th style="border: 5px solid black; background-color: #FFFF00">Nama Item</th>
        <th style="border: 5px solid black; background-color: #FFFF00">No. PP Manual</th>
        <th style="border: 5px solid black; background-color: #FFFF00">No. PR</th>
        <th style="border: 5px solid black; background-color: #FFFF00">No. PO</th>
        <th style="border: 5px solid black; background-color: #FFFF00">Kuantitas</th>
        <th style="border: 5px solid black; background-color: #FFFF00">Satuan (UoM)</th>
        <th style="border: 5px solid black; background-color: #FFFF00">Estimasi Harga</th>
        <th style="border: 5px solid black; background-color: #FFFF00">Total</th>
        <th style="border: 5px solid black; background-color: #FFFF00">Keterangan Alokasi</th>
        <th style="border: 5px solid black; background-color: #FFFF00">No. Pengiriman</th>
        <th style="border: 5px solid black; background-color: #FFFF00">Status</th>
    </tr>
    @foreach ($item_code->inventories as $inventory)
        <tr>
            <td style="border: 5px solid black">{{ $loop->iteration }}</td>
            <td style="border: 5px solid black">{{ $inventory->itemCode->kode_item }}</td>
            <td style="border: 5px solid black">{{ $inventory->itemCode->nama_item }}</td>
            <td style="border: 5px solid black">{{ $inventory->no_pp_manual ?: '-' }}</td>
            <td style="border: 5px solid black">{{ $inventory->no_pr ?: '-' }}</td>
            <td style="border: 5px solid black">{{ $inventory->no_po ?: '-' }}</td>
            <td style="border: 5px solid black">{{ $inventory->kuantitas }}</td>
            <td style="border: 5px solid black">{{ $inventory->uom ?: '-' }}</td>
            <td style="border: 5px solid black" class="text-nowrap">
                {{ 'Rp ' . number_format($inventory->estimasi_harga, '0', ',', '.') }}
            </td>
            <td style="border: 5px solid black" class="text-nowrap">
                {{ 'Rp ' . number_format($inventory->estimasi_harga * $inventory->kuantitas, '0', ',', '.') }}
            </td>
            <td style="border: 5px solid black">{{ $inventory->keterangan_alokasi ?: '-' }}</td>
            <td style="border: 5px solid black">{{ $inventory->no_pengiriman ?: '-' }}</td>

            @if (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_gudang_site)
                <td style="border: 5px solid black">Barang dikonfirmasi oleh Gudang Site pada
                    {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_site)->format('j M Y, H:i') }}.
                </td>
            @elseif (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_gudang_central)
                <td style="border: 5px solid black">Barang dikonfirmasi oleh Gudang Central pada
                    {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_central)->format('j M Y, H:i') }}.
                    Menunggu konfirmasi dari Gudang Site
                </td>
            @elseif (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_gudang_pusat)
                @if ($inventory->no_pengiriman && $inventory->pengiriman_langsung_gudang_site)
                    <td style="border: 5px solid black">Barang dikonfirmasi oleh Gudang Pusat pada
                        {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_pusat)->format('j M Y, H:i') }}.
                        Menunggu konfirmasi dari Gudang Site
                    </td>
                @elseif ($inventory->no_pengiriman && !$inventory->pengiriman_langsung_gudang_site)
                    <td style="border: 5px solid black">Barang dikonfirmasi oleh Gudang Pusat pada
                        {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_pusat)->format('j M Y, H:i') }}.
                        Menunggu konfirmasi dari Gudang Central
                    </td>
                @else
                    <td style="border: 5px solid black">Barang dikonfirmasi oleh Gudang Pusat pada
                        {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_gudang_pusat)->format('j M Y, H:i') }}.
                        Menunggu Gudang Pusat mengatur pengiriman menuju Gudang Central
                    </td>
                @endif
            @elseif (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_purchasing)
                <td style="border: 5px solid black">Barang dikonfirmasi oleh Purchasing pada
                    {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_purchasing)->format('j M Y, H:i') }}. Menunggu
                    konfirmasi dari Gudang Pusat
                </td>
            @elseif (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_time_planner_ho)
                <td style="border: 5px solid black">Barang dikonfirmasi oleh Time Planner HO pada
                    {{ Carbon\Carbon::parse($inventory->waktu_konfirmasi_purchasing)->format('j M Y, H:i') }}
                    .
                    Menunggu konfirmasi dari Purchasing
                </td>
            @elseif(!$inventory->pembelian_lokal)
                <td style="border: 5px solid black">Permintaan barang telah dikonfirmasi pada
                    {{ Carbon\Carbon::parse($inventory->updated_at)->format('j M Y, H:i') }}.
                    Menunggu konfirmasi dari Time Planner HO.
                </td>
            @elseif($inventory->pembelian_lokal)
                <td style="border: 5px solid black">Pembelian Lokal telah dikonfirmasi pada
                    {{ Carbon\Carbon::parse($inventory->updated_at)->format('j M Y, H:i') }} oleh Gudang Site.
                </td>
            @endif
        </tr>
    @endforeach
</table>
