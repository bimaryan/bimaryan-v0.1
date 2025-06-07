@extends('pages.admin.index')

@section('content')
    <div class="max-w-screen-xl mx-auto p-6">
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

                <!-- RAM -->
                <div class="bg-green-50 border border-green-200 p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-green-800">RAM</h2>
                    @php
                        $memInfo = file_get_contents("/proc/meminfo");
                        preg_match("/MemTotal:\s+(\d+)/", $memInfo, $matchesTotal);
                        preg_match("/MemAvailable:\s+(\d+)/", $memInfo, $matchesFree);
                        $totalMem = isset($matchesTotal[1]) ? $matchesTotal[1] / 1024 : 0;
                        $freeMem = isset($matchesFree[1]) ? $matchesFree[1] / 1024 : 0;
                    @endphp
                    <p class="text-sm text-gray-700">
                        Free: {{ number_format($freeMem, 2) }} MB<br>
                        Total: {{ number_format($totalMem, 2) }} MB
                    </p>
                </div>

                <!-- CPU Load -->
                <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-yellow-800">CPU Load</h2>
                    @php
                        $load = sys_getloadavg();
                    @endphp
                    <p class="text-sm text-gray-700">
                        1 min: {{ $load[0] }}<br>
                        5 min: {{ $load[1] }}<br>
                        15 min: {{ $load[2] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection