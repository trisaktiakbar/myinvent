<x-app-layout :pageTitle="'Dashboard'">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Beranda</h5>
            <p class="mb-0">Hi, {{ Auth::user()->name }}</p>
        </div>
    </div>
</x-app-layout>
