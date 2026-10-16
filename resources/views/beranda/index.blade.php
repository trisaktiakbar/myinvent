<x-app-layout :pageTitle="'Dashboard'">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Beranda</h5>
            <p class="mb-0">Welcome, {{ Auth::user()->name }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <img class="w-100 rounded" src="{{ asset('assets/images/ilustrasi.png') }}" alt="">
        </div>
    </div>
</x-app-layout>
