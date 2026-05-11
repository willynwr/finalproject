<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
    @if($showFertilityClass ?? true)
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <div class="text-sm font-semibold text-slate-500 mb-2 tracking-wide">Kelas Kesuburan</div>
        <div id="fertility-class" class="text-3xl font-extrabold text-slate-800">--</div>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 @if(!($showFertilityClass ?? true)) md:col-span-2 @endif">
        <div class="text-sm font-semibold text-slate-500 mb-2 tracking-wide">Lokasi Saat Ini</div>
        <div id="gps-location-card" class="text-xl md:text-2xl font-extrabold text-slate-800 mb-2">--</div>
        <div class="flex items-center space-x-2">
            <span class="text-xs font-semibold text-slate-500">Status GPS:</span>
            <div id="gps-update-status" class="text-sm font-bold">--</div>
        </div>
    </div>
</div>
