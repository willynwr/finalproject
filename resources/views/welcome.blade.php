<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMART SOIL - Prologue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col relative overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-600 to-transparent opacity-20 -z-10"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob -z-10"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 -z-10"></div>

    <!-- Header / Navbar Minimalist -->
    <header class="w-full px-8 py-6 flex justify-between items-center z-10">
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
            <span class="text-xl font-bold text-slate-800 tracking-tight">SMART <span class="text-emerald-600">SOIL</span></span>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center px-4 z-10 text-center -mt-16">
        <div class="max-w-3xl">
            <div class="inline-flex items-center space-x-2 bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-semibold mb-6">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Sistem Monitoring Real-Time</span>
            </div>
            
            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                Masa Depan Pertanian <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Ada di Tangan Anda</span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-600 mb-12 max-w-2xl mx-auto leading-relaxed">
                Platform pintar untuk memonitor kesuburan tanah secara real-time dan memberikan rekomendasi dosis pupuk yang presisi untuk hasil panen optimal.
            </p>

            <!-- Cards / Buttons Options -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-2xl mx-auto mt-4">
                <!-- Option 1 -->
                <a href="{{ url('/rekomendasi-pupuk') }}" class="group relative bg-white border border-slate-200 p-8 rounded-3xl shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 transform hover:-translate-y-1 text-left flex flex-col h-full">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">Rekomendasi Pupuk</h3>
                    <p class="text-sm text-slate-500 mb-6 flex-grow">Dapatkan takaran dosis pupuk NPK (Urea, SP-36, KCL) yang presisi sesuai kondisi tanah.</p>
                    <div class="inline-flex items-center text-blue-600 font-semibold text-sm">
                        Masuk Dasbor <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </div>
                </a>

                <!-- Option 2 -->
                <a href="{{ url('/kesuburan-tanah') }}" class="group relative bg-white border border-slate-200 p-8 rounded-3xl shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 transform hover:-translate-y-1 text-left flex flex-col h-full">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">Kesuburan Tanah</h3>
                    <p class="text-sm text-slate-500 mb-6 flex-grow">Pantau nilai Nitrogen (N), Fosfor (P), Kalium (K), dan pH tanah secara real-time.</p>
                    <div class="inline-flex items-center text-emerald-600 font-semibold text-sm">
                        Masuk Dasbor <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </div>
                </a>
            </div>
        </div>
    </main>

    <!-- Footer Minimalist -->
    <footer class="w-full py-6 text-center text-xs text-slate-400 z-10">
        &copy; {{ date('Y') }} SMART SOIL. All rights reserved.
    </footer>
</body>
</html>
