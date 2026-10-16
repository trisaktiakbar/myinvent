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
                            <th scope="col" class="text-nowrap">Kode Item</th>
                            <th scope="col" class="text-nowrap">Nama Item</th>
                            <th scope="col" class="text-nowrap">Jumlah Item</th>
                            <th scope="col" class="text-nowrap">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item_codes as $item_code)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item_code->kode_item }}</td>
                                <td>{{ $item_code->nama_item }}</td>
                                <td>{{ $item_code->inventories->count() }}</td>
                                <td>
                                    <a href="{{ route('export-by-kode-item.show', $item_code->slug) }}"
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
