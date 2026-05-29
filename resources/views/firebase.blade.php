<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Dashboard Monitoring Smart Farming' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen relative flex flex-col">
    <!-- Background Decor -->
    <div class="fixed top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-600 to-transparent opacity-10 -z-10 pointer-events-none"></div>
    <div class="fixed -top-40 -right-40 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-20 animate-blob -z-10 pointer-events-none"></div>
    
    <!-- Navbar / Header -->
    <header class="bg-white/80 backdrop-blur-md shadow-sm border-b pb-4 pt-6 px-8 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center sticky top-0 z-20">
        <div class="mb-4 md:mb-0 flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">{{ $pageTitle ?? 'Smart Farming Dashboard' }}</h1>
                <p class="text-sm text-slate-500 mt-1 font-medium">{{ $pageSubtitle ?? 'Real-time Soil Nutrition & Fertilizer Recommendations' }}</p>
            </div>
        </div>
        <div class="flex flex-col items-end space-y-3 w-full md:w-auto">
            <nav class="flex flex-wrap items-center justify-end gap-2">
                <a href="{{ url('/') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Home
                </a>
                <a href="{{ url('/rekomendasi-pupuk') }}" class="inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-semibold transition {{ request()->is('rekomendasi-pupuk') ? 'border-blue-700 bg-blue-600 text-white shadow-sm' : 'border-slate-200 bg-white/50 text-slate-600 hover:border-slate-300 hover:text-slate-800 hover:bg-white' }}">
                    Rekomendasi Pupuk
                </a>
                <a href="{{ url('/kesuburan-tanah') }}" class="inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-semibold transition {{ request()->is('kesuburan-tanah') ? 'border-emerald-700 bg-emerald-600 text-white shadow-sm' : 'border-slate-200 bg-white/50 text-slate-600 hover:border-slate-300 hover:text-slate-800 hover:bg-white' }}">
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
                <span id="gps-location" class="ml-2 font-medium text-emerald-600 hidden"></span>
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

        @include('partials.soil-fertility')

        @if (($showDoseSection ?? true))
            @include('partials.fertilizer-recommendation')
        @endif

    </main>

    <script>
        let lastLat = null;
        let lastLon = null;

        function formatFertilityClass(value) {
            if (value === undefined || value === null || value === '') {
                return '--';
            }

            return String(value)
                .replace(/_/g, ' ')
                .toLowerCase()
                .replace(/\b\w/g, (character) => character.toUpperCase());
        }

        function toDisplayNumber(value, fractionDigits = 2) {
            const numericValue = Number(value);

            if (!Number.isFinite(numericValue)) {
                return '--';
            }

            return numericValue.toFixed(fractionDigits);
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

                // Mapping NPK & pH Values
                const soilSource = data.npk ?? data.npk_reg ?? data;

                const elN = document.getElementById('val-n');
                if (elN) {
                    elN.innerText = toDisplayNumber(soilSource.N, 4);
                }

                const elP = document.getElementById('val-p');
                if (elP) {
                    elP.innerText = toDisplayNumber(soilSource.P, 2);
                }

                const elK = document.getElementById('val-k');
                if (elK) {
                    elK.innerText = toDisplayNumber(soilSource.K, 2);
                }

                const elPh = document.getElementById('val-ph');
                if (elPh) {
                    elPh.innerText = toDisplayNumber(soilSource.pH ?? soilSource.ph ?? data.pH ?? data.ph, 2);
                }

                const fertilityClass = data.kelas_kesuburan ?? data.KLS;
                if (fertilityClass !== undefined && fertilityClass !== null) {
                    const elClass = document.getElementById('fertility-class');
                    if(elClass) elClass.innerText = formatFertilityClass(fertilityClass);
                }

                // Mapping Fertilizer Dose Values
                const fertilizerSource = data.fert_dose ?? data;
                const doseUrea = document.getElementById('dose-urea');
                if(doseUrea) doseUrea.innerText = fertilizerSource.UREA ?? fertilizerSource.UD ?? '--';

                const doseSp36 = document.getElementById('dose-sp36');
                if(doseSp36) doseSp36.innerText = fertilizerSource['SP-36'] ?? fertilizerSource.SP36 ?? fertilizerSource.SD ?? '--';

                const doseKcl = document.getElementById('dose-kcl');
                if(doseKcl) doseKcl.innerText = fertilizerSource.KCL ?? fertilizerSource.CD ?? '--';

                // Mapping GPS
                const hasGpsData = data.gps && data.gps.lat !== undefined && data.gps.lon !== undefined;
                const isUpdated = hasGpsData || data.gps_updated === true || data.gps?.gps_updated === true;
                
                if (data.gps || data.gps_updated !== undefined) {
                    const elGpsStatus = document.getElementById('gps-status');
                    if(elGpsStatus) {
                        elGpsStatus.innerText = isUpdated ? "Active" : "Not Updated";
                        elGpsStatus.className = isUpdated ? "font-bold text-emerald-600" : "font-bold text-red-500";
                    }
                    const elGpsUpdate = document.getElementById('gps-update-status');
                    if(elGpsUpdate) {
                        elGpsUpdate.innerText = isUpdated ? "Aktif" : "Tidak Aktif";
                        elGpsUpdate.className = isUpdated ? "text-sm font-bold text-emerald-600" : "text-sm font-bold text-red-500";
                    }
                    
                    // Fetch location details using OpenStreetMap Nominatim API if GPS lat/lon updated
                    if (hasGpsData && (data.gps.lat !== lastLat || data.gps.lon !== lastLon)) {
                        lastLat = data.gps.lat;
                        lastLon = data.gps.lon;
                        
                        const elGpsLocation = document.getElementById('gps-location');
                        if (elGpsLocation) {
                            elGpsLocation.classList.remove('hidden');
                            elGpsLocation.innerText = `(${data.gps.lat}, ${data.gps.lon})`;
                        }
                        
                        const elGpsLocationCard = document.getElementById('gps-location-card');
                        if (elGpsLocationCard) {
                            elGpsLocationCard.innerText = 'Mencari lokasi...';
                            
                            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${data.gps.lat}&lon=${data.gps.lon}`)
                                .then(res => res.json())
                                .then(locData => {
                                    if (locData && locData.display_name) {
                                        const shortName = locData.display_name.split(',').slice(0, 3).join(',');
                                        elGpsLocationCard.innerText = shortName;
                                    } else {
                                        elGpsLocationCard.innerText = 'Lokasi tidak ditemukan';
                                    }
                                })
                                .catch(err => {
                                    console.error("Geocoding Error:", err);
                                    elGpsLocationCard.innerText = `${data.gps.lat}, ${data.gps.lon}`;
                                });
                        }
                    }
                }

                // Mapping Timestamp
                const elTimestamp = document.getElementById('timestamp-info');
                if (elTimestamp) {
                    if (data.timestamp) {
                        const dateObj = new Date(data.timestamp * 1000); // Convert epoch to ms
                        elTimestamp.innerText = "Last Updated: " + dateObj.toLocaleString();
                    } else {
                        elTimestamp.innerText = "Last Updated: " + new Date().toLocaleTimeString();
                    }
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