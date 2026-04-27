<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Dashboard Monitoring Smart Farming' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">
    <!-- Navbar / Header -->
    <header class="bg-white shadow-sm border-b pb-4 pt-6 px-8 mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">{{ $pageTitle ?? 'Smart Farming Dashboard' }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $pageSubtitle ?? 'Real-time Soil Nutrition & Fertilizer Recommendations' }}</p>
        </div>
        <div class="flex flex-col items-end space-y-3">
            <nav class="flex flex-wrap items-center justify-end gap-2">
                <a href="{{ url('/rekomendasi-pupuk') }}" class="inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-semibold transition {{ request()->is('rekomendasi-pupuk') ? 'border-slate-800 bg-slate-800 text-white' : 'border-slate-200 bg-white text-slate-600 hover:border-slate-300 hover:text-slate-800' }}">
                    Rekomendasi Pupuk
                </a>
                <a href="{{ url('/kesuburan-tanah') }}" class="inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-semibold transition {{ request()->is('kesuburan-tanah') ? 'border-emerald-700 bg-emerald-600 text-white' : 'border-slate-200 bg-white text-slate-600 hover:border-slate-300 hover:text-slate-800' }}">
                    Kesuburan Tanah
                </a>
            </nav>
            <div class="flex items-center space-x-2 bg-slate-100 px-3 py-1.5 rounded-full border">
                <div id="status-indicator" class="w-3 h-3 rounded-full bg-yellow-400 animate-pulse"></div>
                <span id="status-text" class="text-xs font-semibold text-slate-600">Connecting...</span>
            </div>
            <div class="text-xs text-slate-400 flex items-center space-x-1">
                <span>GPS:</span>
                <span id="gps-status" class="font-medium text-slate-600">Checking...</span>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 md:px-8 pb-12">
        
        <!-- Section: Soil Nutrients & pH -->
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-700">{{ $metricSectionTitle ?? 'Predictive Soil Parameters (NPK & pH)' }}</h2>
            <span class="text-xs text-slate-500 bg-white px-2 py-1 rounded-md border shadow-sm" id="timestamp-info">Updated: --</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- N Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative overflow-hidden group hover:shadow-md transition">
                <div class="absolute top-0 left-0 w-full h-1 bg-blue-500"></div>
                <div class="text-sm font-semibold text-slate-500 mb-1 tracking-wide">Nitrogen (N)</div>
                <div class="flex items-baseline space-x-2 mt-3">
                    <span class="text-4xl font-bold text-slate-800 tracking-tighter" id="val-n">--</span>
                    <span class="text-blue-500 font-bold">%</span>
                </div>
            </div>

            <!-- P Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative overflow-hidden group hover:shadow-md transition">
                <div class="absolute top-0 left-0 w-full h-1 bg-amber-500"></div>
                <div class="text-sm font-semibold text-slate-500 mb-1 tracking-wide">Phosphorus (P)</div>
                <div class="flex items-baseline space-x-2 mt-3">
                    <span class="text-4xl font-bold text-slate-800 tracking-tighter" id="val-p">--</span>
                    <span class="text-amber-500 font-bold">ppm</span>
                </div>
            </div>

            <!-- K Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative overflow-hidden group hover:shadow-md transition">
                <div class="absolute top-0 left-0 w-full h-1 bg-purple-500"></div>
                <div class="text-sm font-semibold text-slate-500 mb-1 tracking-wide">Potassium (K)</div>
                <div class="flex items-baseline space-x-2 mt-3">
                    <span class="text-4xl font-bold text-slate-800 tracking-tighter" id="val-k">--</span>
                    <span class="text-purple-500 font-bold">ppm</span>
                </div>
            </div>

            <!-- pH Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative overflow-hidden group hover:shadow-md transition">
                <div class="absolute top-0 left-0 w-full h-1 bg-emerald-500"></div>
                <div class="text-sm font-semibold text-slate-500 mb-1 tracking-wide">pH Level</div>
                <div class="flex items-baseline mt-3">
                    <span class="text-4xl font-bold text-slate-800 tracking-tighter" id="val-ph">--</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="text-sm font-semibold text-slate-500 mb-2 tracking-wide">Kelas Kesuburan</div>
                <div id="fertility-class" class="text-3xl font-extrabold text-slate-800">--</div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="text-sm font-semibold text-slate-500 mb-2 tracking-wide">GPS Update</div>
                <div id="gps-update-status" class="text-3xl font-extrabold text-slate-800">--</div>
            </div>
        </div>

        @if (($showDoseSection ?? true))
            <!-- Section: Fertilizer Doses -->
            <h2 class="text-lg font-bold text-slate-700 mb-4 border-b border-slate-200 pb-2">{{ $doseSectionTitle ?? 'Recommended Fertilizer Doses' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- UREA -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between hover:border-blue-300 transition">
                    <div class="flex justify-between items-start mb-6">
                        <div class="text-sm font-bold text-slate-500 tracking-wider">UREA DOSE</div>
                        <div class="bg-blue-50 text-blue-700 text-xs font-bold px-2 py-1 rounded">Kg / Ha</div>
                    </div>
                    <div class="text-5xl font-extrabold text-slate-800" id="dose-urea">--</div>
                </div>

                <!-- SP-36 -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between hover:border-amber-300 transition">
                    <div class="flex justify-between items-start mb-6">
                        <div class="text-sm font-bold text-slate-500 tracking-wider">SP-36 DOSE</div>
                        <div class="bg-amber-50 text-amber-700 text-xs font-bold px-2 py-1 rounded">Kg / Ha</div>
                    </div>
                    <div class="text-5xl font-extrabold text-slate-800" id="dose-sp36">--</div>
                </div>

                <!-- KCL -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between hover:border-purple-300 transition">
                    <div class="flex justify-between items-start mb-6">
                        <div class="text-sm font-bold text-slate-500 tracking-wider">KCL DOSE</div>
                        <div class="bg-purple-50 text-purple-700 text-xs font-bold px-2 py-1 rounded">Kg / Ha</div>
                    </div>
                    <div class="text-5xl font-extrabold text-slate-800" id="dose-kcl">--</div>
                </div>
            </div>
        @endif

    </main>

    <script>
        function formatFertilityClass(value) {
            if (value === undefined || value === null || value === '') {
                return '--';
            }

            return String(value)
                .replace(/_/g, ' ')
                .toLowerCase()
                .replace(/\b\w/g, (character) => character.toUpperCase());
        }

        async function fetchFirebaseData() {
            const statusInd = document.getElementById('status-indicator');
            const statusText = document.getElementById('status-text');
            const apiUrl = @json($apiEndpoint ?? '/api/rekomendasi-data');

            try {
                // Request ke proxy Backend
                const response = await fetch(apiUrl);
                if (!response.ok) throw new Error('Network response was not ok');
                
                const data = await response.json();
                console.log("Response data backend:", data); // Log debugging
                
                // Update Status Bar
                statusInd.className = "w-3 h-3 rounded-full bg-emerald-500";
                statusText.innerText = "Connected (Live)";

                // Validasi null (jika data null dari firebase)
                if (!data) return;

                // Mapping NPK Reg Values
                if (data.npk_reg) {
                    document.getElementById('val-n').innerText = (data.npk_reg.N !== undefined && data.npk_reg.N !== null) ? data.npk_reg.N.toFixed(3) : '--';
                    document.getElementById('val-p').innerText = (data.npk_reg.P !== undefined && data.npk_reg.P !== null) ? data.npk_reg.P.toFixed(2) : '--';
                    document.getElementById('val-k').innerText = (data.npk_reg.K !== undefined && data.npk_reg.K !== null) ? data.npk_reg.K.toFixed(2) : '--';
                    document.getElementById('val-ph').innerText = (data.npk_reg.ph !== undefined && data.npk_reg.ph !== null) ? data.npk_reg.ph.toFixed(2) : '--';
                }

                if (data.kelas_kesuburan !== undefined && data.kelas_kesuburan !== null) {
                    document.getElementById('fertility-class').innerText = formatFertilityClass(data.kelas_kesuburan);
                }

                // Mapping Fertilizer Dose Values
                if (data.fert_dose) {
                    document.getElementById('dose-urea').innerText = data.fert_dose.UREA ?? '--';
                    document.getElementById('dose-sp36').innerText = data.fert_dose["SP-36"] ?? '--';
                    document.getElementById('dose-kcl').innerText = data.fert_dose.KCL ?? '--';
                }

                // Mapping GPS
                const isUpdated = data.gps_updated === true || data.gps?.gps_updated === true;
                if (data.gps || data.gps_updated !== undefined) {
                    document.getElementById('gps-status').innerText = isUpdated ? "Active" : "Not Updated";
                    document.getElementById('gps-status').className = isUpdated ? "font-bold text-emerald-600" : "font-bold text-red-500";
                    document.getElementById('gps-update-status').innerText = isUpdated ? "Aktif" : "Tidak Aktif";
                    document.getElementById('gps-update-status').className = isUpdated ? "text-3xl font-extrabold text-emerald-600" : "text-3xl font-extrabold text-red-500";
                }

                // Mapping Timestamp
                if (data.timestamp) {
                    const dateObj = new Date(data.timestamp * 1000); // Convert epoch to ms
                    document.getElementById('timestamp-info').innerText = "Last Updated: " + dateObj.toLocaleString();
                } else {
                    document.getElementById('timestamp-info').innerText = "Last Updated: " + new Date().toLocaleTimeString();
                }

            } catch (error) {
                console.error("Fetch Error:", error);
                statusInd.className = "w-3 h-3 rounded-full bg-red-600";
                statusText.innerText = "Connection Error";
            }
        }

        // Fetch data saat pertama kali halaman te-load
        fetchFirebaseData();

        // Auto-refresh setiap 2 detik 
        setInterval(fetchFirebaseData, 2000);
    </script>
</body>
</html>