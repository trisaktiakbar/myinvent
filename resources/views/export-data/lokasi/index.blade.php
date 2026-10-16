<x-app-layout :pageTitle="'Export Data'">
    <div class="card border">
        <div class="card-header">
            <h6 class="card-title">
                Export Data
            </h6>
        </div>
        <div class="card-body">

            <form action="{{ route('export-by-kode-item.index') }}" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Cari"
                        value="{{ old('search', request('search')) }}">
                    <button class="btn btn-outline-primary" type="submit"><i class="ti ti-search"></i></button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col" class="text-nowrap">No.</th>
                            <th scope="col" class="text-nowrap">Lokasi Barang</th>
                            <th scope="col" class="text-nowrap">Jumlah Item</th>
                            <th scope="col" class="text-nowrap">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $lokasi => $jumlah)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $lokasi }}</td>
                                <td>{{ $jumlah }}</td>
                                <td>
                                    <a href="{{ route('export-by-lokasi.show', Str::slug($lokasi)) }}"
                                        class="btn btn-primary" title="Lihat">
                                        <i class="ti ti-eye"></i>&ensp;Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
