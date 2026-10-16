<x-app-layout :pageTitle="'Edit Item'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Tambah Permintaan Barang
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('kelola-item.update', $item_code->slug) }}" method="post">
                @method('put')
                @csrf

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="kode_item" class="form-label ">Kode Item</label>
                            <input type="text" class="form-control @error('kode_item') is-invalid @enderror"
                                id="kode_item" name="kode_item" value="{{ old('kode_item', $item_code->kode_item) }}"
                                placeholder="Kode Item" required>
                            @error('kode_item')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="nama_item" class="form-label ">Nama Item</label>
                            <input type="text" class="form-control @error('nama_item') is-invalid @enderror"
                                id="nama_item" name="nama_item" value="{{ old('nama_item', $item_code->nama_item) }}"
                                placeholder="Nama Item">
                            @error('nama_item')
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
                                onclick="window.location.replace('{{ route('kelola-item.index') }}')">
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
