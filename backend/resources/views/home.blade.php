<!DOCTYPE html>
<html>
<head>
  <title>Beranda</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-white">

<!-- TOP NAV -->
<div class="hidden md:flex bg-blue-600 text-white px-10 py-3 justify-end gap-6 text-sm font-medium">
  <a href="/home">Beranda</a>
  <a href="#">Koleksi</a>
  <a href="#">Belanja</a>
  <a href="#">Riwayat</a>
</div>

<!-- NAVBAR -->
<div class="bg-white shadow sticky top-0 z-50">
  <div class="max-w-6xl mx-auto flex items-center px-6 py-3">

    <!-- LOGO -->
    <img src="{{ asset('images/logo.png') }}" class="w-8 h-8 mr-4">

    <!-- SEARCH -->
    <div class="flex-1">
      <input type="text"
        placeholder="Cari buku favoritmu..."
        class="w-full px-4 py-2 border rounded-full focus:outline-blue-500">
    </div>

    <!-- ICON -->
    <div class="flex items-center gap-4 ml-4 relative">

      <!-- HEART -->
      <i data-lucide="heart" class="w-5 h-5 cursor-pointer hover:text-red-500 transition"></i>

      <!-- NOTIF -->
      <div class="relative">
        <i data-lucide="bell"
          onclick="toggleNotif()"
          class="w-5 h-5 cursor-pointer hover:text-yellow-500 transition"></i>

        <div id="notifBox"
          class="hidden absolute right-0 mt-3 w-64 bg-white rounded-xl shadow p-4">
          <p class="text-center text-gray-400">Belum ada notifikasi</p>
        </div>
      </div>

      <!-- PROFILE -->
      <div class="relative">
        <div onclick="toggleProfile()"
          class="w-9 h-9 bg-blue-600 text-white flex items-center justify-center rounded-full cursor-pointer">
          R
        </div>

        <div id="profileBox"
          class="hidden absolute right-0 mt-3 w-64 bg-white rounded-xl shadow p-4 text-center">
          <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-2 text-xl">
            R
          </div>
          <h3 class="font-semibold text-sm">REVANDA AVRILLITA</h3>
          <p class="text-xs text-gray-500">email@gmail.com</p>

          <button class="mt-3 w-full bg-blue-700 text-white py-2 rounded-lg">
            Profilku
          </button>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- SLIDER -->
<div class="relative w-full h-[500px] overflow-hidden">

  <div id="sliderTrack" class="flex h-full transition-transform duration-700">

    <!-- SLIDE 1 -->
    <div class="min-w-full h-full relative">
      <img src="{{ asset('images/banner1.png') }}" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
          Sistem Perpustakaan Modern
        </h1>
        <p class="text-white/80">
          Kelola buku lebih mudah, cepat, dan efisien
        </p>
      </div>
    </div>

    <!-- SLIDE 2 -->
    <div class="min-w-full h-full relative">
      <img src="{{ asset('images/banner2.png') }}" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
          Akses Cepat & Praktis
        </h1>
        <p class="text-white/80">
          Semua data koleksi dalam satu genggaman
        </p>
      </div>
    </div>

    <!-- SLIDE 3 -->
    <div class="min-w-full h-full relative">
      <img src="{{ asset('images/banner3.png') }}" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
          Digital Library
        </h1>
        <p class="text-white/80">
          Solusi perpustakaan masa depan
        </p>
      </div>
    </div>

  </div>

  <!-- DOT -->
  <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
    <button onclick="goSlide(0)" class="dot w-3 h-3 rounded-full bg-white"></button>
    <button onclick="goSlide(1)" class="dot w-3 h-3 rounded-full bg-white/50"></button>
    <button onclick="goSlide(2)" class="dot w-3 h-3 rounded-full bg-white/50"></button>
  </div>

</div>

<!-- BUKU -->
<div class="px-6 md:px-20 py-14">

  <h2 class="text-3xl font-bold text-blue-700 text-center mb-10">
    Buku Terpopuler
  </h2>

  <div class="flex gap-5 overflow-x-auto">

    @foreach($bestBooks as $b)
    <div class="min-w-[250px] bg-white border rounded-xl shadow hover:shadow-lg transition">

      @if($b['cover'])
      <img src="https://covers.openlibrary.org/b/id/{{ $b['cover'] }}-M.jpg"
        class="w-full h-48 object-cover rounded-t-xl">
      @else
      <img src="https://via.placeholder.com/150x200?text=No+Cover"
        class="w-full h-48 object-cover rounded-t-xl">
      @endif

      <div class="p-4">
        <h3 class="text-sm font-semibold">{{ $b['title'] }}</h3>
        <p class="text-blue-600 text-sm">{{ $b['author'] }}</p>
      </div>

    </div>
    @endforeach

  </div>

</div>

<!-- MOBILE NAV -->
<div class="md:hidden fixed bottom-0 left-0 w-full bg-blue-600 text-white flex justify-around py-3">
  <a href="/home"><i data-lucide="home" class="w-6 h-6"></i></a>
  <a href="#"><i data-lucide="book" class="w-6 h-6"></i></a>
  <a href="#"><i data-lucide="shopping-cart" class="w-6 h-6"></i></a>
  <a href="#"><i data-lucide="clock" class="w-6 h-6"></i></a>
</div>

<!-- SCRIPT -->
<script>
function toggleNotif() {
  document.getElementById("notifBox").classList.toggle("hidden");
}

function toggleProfile() {
  document.getElementById("profileBox").classList.toggle("hidden");
}

// SLIDER
let currentSlide = 0;
const track = document.getElementById("sliderTrack");
const dots = document.querySelectorAll(".dot");

function updateSlider() {
  track.style.transform = `translateX(-${currentSlide * 100}%)`;

  dots.forEach(dot => {
    dot.classList.remove("bg-white");
    dot.classList.add("bg-white/50");
  });

  dots[currentSlide].classList.remove("bg-white/50");
  dots[currentSlide].classList.add("bg-white");
}

function goSlide(i) {
  currentSlide = i;
  updateSlider();
}

setInterval(() => {
  currentSlide = (currentSlide + 1) % 3;
  updateSlider();
}, 4000);

// INIT ICON
lucide.createIcons();
</script>

</body>
</html>