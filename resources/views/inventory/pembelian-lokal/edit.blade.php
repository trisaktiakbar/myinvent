<x-app-layout :pageTitle="'Inventory - Edit Pembelian Lokal'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Edit Pembelian Lokal
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pembelian-lokal.update', $permintaan_barang->slug) }}" method="post">
                @method('put')
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="item_code_id" class="form-label">
                                Item
                            </label>
                            <select class="form-select" id="item_code_id" placeholder="Item" name="item_code_id"
                                required>
                                <option value="" disabled
                                    {{ !old('item_code_id', $permintaan_barang->itemCode->id) ? 'selected' : '' }}>
                                    -- Pilih Item --
                                </option>
                                @foreach ($item_codes as $item_code)
                                    <option value="{{ $item_code->id }}"
                                        {{ old('item_code_id', $permintaan_barang->itemCode->id) == $item_code->id ? 'selected' : '' }}>
                                        {{ $item_code->nama_item }}&ensp;—&ensp;{{ $item_code->kode_item }}</option>
                                @endforeach
                            </select>
                            @error('item_code_id')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>



                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="mb-3">
                            <label for="kuantitas" class="form-label ">Kuantitas</label>
                            <input type="number" max="99999"
                                class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas"
                                name="kuantitas" value="{{ old('kuantitas', $permintaan_barang->kuantitas) }}"
                                placeholder="Kuantitas" required>
                            @error('kuantitas')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="mb-3">
                            <label for="uom" class="form-label ">Satuan
                                (UoM)</label>
                            <input type="text" class="form-control @error('uom') is-invalid @enderror" id="uom"
                                name="uom" value="{{ old('uom', $permintaan_barang->uom) }}"
                                placeholder="Satuan (UoM)">
                            @error('uom')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="estimasi_harga" class="form-label">Estimasi Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" id="estimasi_harga" name="estimasi_harga"
                                    class="form-control  @error('estimasi_harga') is-invalid @enderror"
                                    placeholder="Estimasi Harga"
                                    value="{{ old('estimasi_harga', number_format($permintaan_barang->estimasi_harga, '0', ',', '.')) }}"
                                    maxlength="13" required>
                            </div>
                            @error('estimasi_harga')
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
                            <label for="keterangan_alokasi" class="form-label">Keterangan Alokasi</label>
                            <textarea class="form-control @error('keterangan_alokasi') is-invalid @enderror" id="keterangan_alokasi"
                                name="keterangan_alokasi" rows="4" placeholder="Keterangan Alokasi">{{ old('keterangan_alokasi', $permintaan_barang->keterangan_alokasi) }}</textarea>
                            @error('keterangan_alokasi')
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
                                onclick="window.location.replace('{{ route('permintaan-barang.index') }}')">
                                <i class="ti ti-arrow-left"></i>
                            </button>
                            <button class="btn btn-primary" type="submit" title="Simpan">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>


        </div>
    </div>

    <script>
        function rupiahFormat(input) {
            input = input.replace(/[^0-9]/g, '');
            input = new Intl.NumberFormat("id").format(input)
            return input
        }

        let estimasi_harga_el = document.getElementById('estimasi_harga')
        estimasi_harga_el.addEventListener('input', function() {
            estimasi_harga_el.value = rupiahFormat(estimasi_harga_el.value)
        })
    </script>
</x-app-layout>
