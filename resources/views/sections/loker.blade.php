<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Kerja - PT. Technology Multi System</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo_tms.png') }}">
    
    <!-- CSS External -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Font Import */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        * { 
            font-family: 'Poppins', sans-serif; 
        }
        
        html { 
            scroll-behavior: smooth; 
        }

        /* Custom Animations */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideInCard {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes glowPulse {
      0%, 100% {
        box-shadow: 0 0 0 0 rgba(253, 1, 3, 0.4);
      }
      50% {
        box-shadow: 0 0 0 10px rgba(253, 1, 3, 0);
      }
    }

    .animate-fadeInDown {
      animation: fadeInDown 0.8s ease-out;
    }

    .animate-fadeInUp {
      animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .animate-slideInCard {
      animation: slideInCard 0.6s ease-out;
    }

    .card-hover {
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .card-hover:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 20px 40px rgba(253, 1, 3, 0.15);
      border-color: #FD0103;
    }

    .card-hover:hover img {
      animation: glowPulse 1.5s infinite;
      filter: brightness(1.1);
    }

    .card-hover:hover h3 {
      color: #FD0103;
    }

    .card-content {
      transition: all 0.3s ease;
    }

    .card-hover:hover .card-content {
      color: #d10002;
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.2);
      transition: left 0.5s ease;
    }

    .btn-primary:hover::before {
      left: 100%;
    }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content with padding for fixed header -->
    <div class="pt-20">

  <!-- Lowongan Section (Main) -->
  <section id="lowongan" class="flex-grow py-16 px-6 bg-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
      <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
      <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
      <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
    </div>
    
    <div class="max-w-7xl mx-auto relative z-10">
      <div class="text-center mb-16">
        <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight leading-tight mb-6 drop-shadow-lg animate-fadeInDown text-gray-900">
          Informasi <span class="text-red-600">Lowongan Kerja</span>
        </h1>
        <p class="text-lg md:text-xl max-w-3xl mx-auto font-medium leading-relaxed text-gray-700 animate-fadeInUp">
          Temukan berbagai lowongan pekerjaan yang tersedia di perusahaan kami. Kami mencari individu yang berbakat dan berdedikasi untuk bergabung dengan tim kami.
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">

        <!-- Card Lowongan -->
        <article
          class="border border-gray-200 rounded-xl shadow-md bg-white flex flex-col
                 card-hover animate-slideInCard
                 cursor-pointer group"
          >
          <div class="p-6 flex flex-col flex-grow">
            <div class="flex items-center mb-4 space-x-4">
              <img src="{{ asset('img/logo_oplok.png') }}" alt="Logo TMS" class="rounded-full w-16 h-16 object-cover border-2 border-red-300 transition-all duration-300 group-hover:brightness-110">
              <div>
                <h3 class="text-xl font-semibold text-red-700 transition-all duration-300">Frontend Developer</h3>
                <p class="text-sm text-gray-500 transition-all duration-300 group-hover:text-red-500">PT. Teknologi Nusantara</p>
              </div>
            </div>
            <p class="card-content text-gray-600 mb-4 flex-grow leading-relaxed text-sm">
              Kami mencari Frontend Developer berpengalaman yang mahir React.js untuk membangun aplikasi web berkinerja tinggi.
            </p>
            <ul class="mb-6 space-y-1 text-sm text-gray-600">
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Lokasi</span>
                <span>Jakarta</span>
              </li>
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Gaji</span>
                <span>Rp 8.000.000 - Rp 12.000.000</span>
              </li>
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Pengalaman</span>
                <span>2+ Tahun</span>
              </li>
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Pendidikan</span>
                <span>S1 Teknik Informatika</span>
              </li>
            </ul>
          </div>
          <div class="p-6 border-t border-gray-100 bg-red-50 rounded-b-xl transition-all duration-300 group-hover:bg-red-100">
            <button
              onclick="openModalLamaran('Frontend Developer')"
              class="relative w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold py-3 rounded-lg shadow-md
                     hover:shadow-2xl hover:from-red-700 hover:to-red-800 transition duration-300 ease-in-out
                     overflow-hidden hover:-translate-y-1 active:translate-y-0 before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-white/20 before:transition-all before:duration-500 hover:before:left-full"
            >
              Lamar Sekarang
            </button>
          </div>
        </article>

        <!-- Card Lowongan -->
        <article
          class="border border-gray-200 rounded-xl shadow-md bg-white flex flex-col
                 card-hover animate-slideInCard
                 cursor-pointer group"
          >
          <div class="p-6 flex flex-col flex-grow">
            <div class="flex items-center mb-4 space-x-4">
              <img src="{{ asset('img/logo_oplok.png') }}" alt="Logo TMS" class="rounded-full w-16 h-16 object-cover border-2 border-red-300 transition-all duration-300 group-hover:brightness-110">
              <div>
                <h3 class="text-xl font-semibold text-red-700 transition-all duration-300">Digital Marketing Specialist</h3>
                <p class="text-sm text-gray-500 transition-all duration-300 group-hover:text-red-500">PT. Kreatif Digital</p>
              </div>
            </div>
            <p class="card-content text-gray-600 mb-4 flex-grow leading-relaxed text-sm">
              Bertanggung jawab mengelola strategi digital marketing dan kampanye iklan di berbagai platform online.
            </p>
            <ul class="mb-6 space-y-1 text-sm text-gray-600">
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Lokasi</span>
                <span>Bandung</span>
              </li>
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Gaji</span>
                <span>Rp 6.000.000 - Rp 8.500.000</span>
              </li>
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Pengalaman</span>
                <span>1+ Tahun</span>
              </li>
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Pendidikan</span>
                <span>D3/S1</span>
              </li>
            </ul>
          </div>
          <div class="p-6 border-t border-gray-100 bg-red-50 rounded-b-xl transition-all duration-300 group-hover:bg-red-100">
            <button
              onclick="openModalLamaran('Digital Marketing Specialist')"
              class="relative w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold py-3 rounded-lg shadow-md
                     hover:shadow-2xl hover:from-red-700 hover:to-red-800 transition duration-300 ease-in-out
                     overflow-hidden hover:-translate-y-1 active:translate-y-0 before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-white/20 before:transition-all before:duration-500 hover:before:left-full"
            >
              Lamar Sekarang
            </button>
          </div>
        </article>

        <!-- Card Lowongan -->
        <article
          class="border border-gray-200 rounded-xl shadow-md bg-white flex flex-col
                 card-hover animate-slideInCard
                 cursor-pointer group"
          >
          <div class="p-6 flex flex-col flex-grow">
            <div class="flex items-center mb-4 space-x-4">
              <img src="{{ asset('img/logo_oplok.png') }}" alt="Logo TMS" class="rounded-full w-16 h-16 object-cover border-2 border-red-300 transition-all duration-300 group-hover:brightness-110">
              <div>
                <h3 class="text-xl font-semibold text-red-700 transition-all duration-300">UI/UX Designer</h3>
                <p class="text-sm text-gray-500 transition-all duration-300 group-hover:text-red-500">PT. Desain Inovatif</p>
              </div>
            </div>
            <p class="card-content text-gray-600 mb-4 flex-grow leading-relaxed text-sm">
              Mencari desainer UI/UX kreatif yang mampu membuat prototipe dan desain aplikasi dengan fokus pengalaman pengguna.
            </p>
            <ul class="mb-6 space-y-1 text-sm text-gray-600">
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Lokasi</span>
                <span>Surabaya</span>
              </li>
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Gaji</span>
                <span>Rp 7.000.000 - Rp 9.000.000</span>
              </li>
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Pengalaman</span>
                <span>2+ Tahun</span>
              </li>
              <li class="flex transition-all duration-300 group-hover:translate-x-1">
                <span class="w-28 font-semibold text-red-700">Pendidikan</span>
                <span>S1 Desain Komunikasi Visual</span>
              </li>
            </ul>
          </div>
          <div class="p-6 border-t border-gray-100 bg-red-50 rounded-b-xl transition-all duration-300 group-hover:bg-red-100">
            <button
              onclick="openModalLamaran('UI/UX Designer')"
              class="relative w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold py-3 rounded-lg shadow-md
                     hover:shadow-2xl hover:from-red-700 hover:to-red-800 transition duration-300 ease-in-out
                     overflow-hidden hover:-translate-y-1 active:translate-y-0 before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-white/20 before:transition-all before:duration-500 hover:before:left-full"
            >
              Lamar Sekarang
            </button>
          </div>
        </article>

      </div>
    </div>
  </section>

    </div>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Modal Lamaran -->
    @include('partials.modal_oplok')
</body>

</html>
