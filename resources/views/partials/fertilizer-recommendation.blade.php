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

<!-- ===== SHAP Analysis Section ===== -->
<div class="mt-10">
    <div class="mb-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-2 h-6 bg-gradient-to-b from-violet-500 to-indigo-600 rounded-full"></div>
            <h2 class="text-lg font-bold text-slate-700">Analisis SHAP – Kontribusi Fitur</h2>
        </div>
        <span id="shap-status-badge" class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-100 text-slate-500 border">Memuat...</span>
    </div>

    <div id="shap-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- SHAP cards will be rendered here by JS -->
        <div class="md:col-span-3 bg-white rounded-2xl border border-slate-100 p-8 flex items-center justify-center">
            <div class="flex flex-col items-center space-y-3 text-slate-400">
                <svg class="animate-spin h-8 w-8 text-violet-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span class="text-sm font-medium">Mengambil data SHAP...</span>
            </div>
        </div>
    </div>
</div>
