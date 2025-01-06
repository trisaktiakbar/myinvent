<x-app-layout :pageTitle="'Dashboard'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Edit Permintaan Barang
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('permintaan-barang.update', $permintaan_barang->slug) }}" method="post">
                @method('put')
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="kode_item" class="form-label">Kode
                                Item</label>
                            <input type="text" class="form-control  @error('kode_item') is-invalid @enderror"
                                id="kode_item" name="kode_item"
                                value="{{ old('kode_item', $permintaan_barang->kode_item) }}" placeholder="Kode Item"
                                required>
                            @error('kode_item')
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
                            <label for="nama_item" class="form-label">
                                Nama Item
                            </label>
                            <input type="text" class="form-control  @error('nama_item') is-invalid @enderror"
                                id="nama_item" name="nama_item"
                                value="{{ old('nama_item', $permintaan_barang->nama_item) }}" placeholder="Nama Item"
                                required>
                            @error('nama_item')
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
                            <label for="no_pp_manual" class="form-label">
                                No. PP Manual
                            </label>
                            <input type="text" class="form-control  @error('no_pp_manual') is-invalid @enderror"
                                id="no_pp_manual" name="no_pp_manual"
                                value="{{ old('no_pp_manual', $permintaan_barang->no_pp_manual) }}"
                                placeholder="No. PP Manual">
                            @error('no_pp_manual')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="no_pr" class="form-label ">No. PR</label>
                            <input type="text" class="form-control @error('no_pr') is-invalid @enderror"
                                id="no_pr" name="no_pr" value="{{ old('no_pr', $permintaan_barang->no_pr) }}"
                                placeholder="No. PR">
                            @error('no_pr')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-3">
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
                    <div class="col-sm-6 col-md-3">
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

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="estimasi_harga" class="form-label">Estimasi Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" id="estimasi_harga" name="estimasi_harga"
                                    class="form-control  @error('estimasi_harga') is-invalid @enderror"
                                    placeholder="Estimasi Harga"
                                    value="{{ old('estimasi_harga', $permintaan_barang->estimasi_harga) }}"
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
