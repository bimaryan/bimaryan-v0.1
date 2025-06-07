@extends('pages.admin.index')

@section('content')
    <div class="max-w-screen-xl mx-auto p-6 mt-14 pt-10">
        <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
            <h1 class="text-2xl font-semibold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600">Selamat datang di halaman admin. Berikut informasi sistem saat ini:</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Storage -->
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg shadow">
    <h2 class="text-lg font-semibold text-blue-800">Storage (Storage Folder)</h2>
    @php
        $storagePath = storage_path();
        $free = disk_free_space($storagePath);
        $total = disk_total_space($storagePath);
    @endphp
    <p class="text-sm text-gray-700">
        Free: {{ number_format($free / 1024 / 1024 / 1024, 2) }} GB<br>
        Total: {{ number_format($total / 1024 / 1024 / 1024, 2) }} GB
    </p>
</div>

                <!-- CPU & RAM -->
<div class="bg-green-50 border border-green-200 p-4 rounded-lg shadow">
    <h2 class="text-lg font-semibold text-green-800">Informasi Server</h2>
    <p class="text-sm text-gray-700">
        PHP Version: {{ phpversion() }} <br>
        Server OS: {{ php_uname() }} <br>
        Memory Limit (PHP): {{ ini_get('memory_limit') }} <br>
        Max Execution Time: {{ ini_get('max_execution_time') }} detik
    </p>
</div>
            </div>
        </div>
    </div>
@endsection