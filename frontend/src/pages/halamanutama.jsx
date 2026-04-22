import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import {
  FiSearch,
  FiBell,
  FiHeart,
  FiHome,
  FiBook,
  FiUser,
  FiShoppingCart,
  FiClock,
} from "react-icons/fi";

import banner1 from "../assets/banner1.png";
import banner2 from "../assets/banner2.png";
import banner3 from "../assets/banner3.png";
import logo from "../assets/logo.png";

export default function HalamanUtama() {
  const [currentSlide, setCurrentSlide] = useState(0);

  const slides = [
    {
      img: banner1,
      title: "Sistem Perpustakaan Modern",
      subtitle: "Kelola buku lebih mudah, cepat, dan efisien",
    },
    {
      img: banner2,
      title: "Akses Cepat & Praktis",
      subtitle: "Semua data koleksi dalam satu genggaman",
    },
    {
      img: banner3,
      title: "Digital Library",
      subtitle: "Solusi perpustakaan masa depan",
    },
  ];

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % slides.length);
    }, 4000);
    return () => clearInterval(interval);
  }, []);

  return (
    <div className="bg-white min-h-screen">

      {/* HEADER BIRU (DESKTOP ONLY) */}
      <div className="hidden md:flex bg-blue-600 text-white px-10 py-3 items-center justify-end text-sm font-medium">
        <div className="flex gap-8">
          {[
            { name: "Beranda", path: "/halamanutama" },
            { name: "Koleksi", path: "/koleksi" },
            { name: "Belanja", path: "/belanja" },
            { name: "Riwayat", path: "/riwayat" },
          ].map((item, i) => (
            <Link
              key={i}
              to={item.path}
              className="relative cursor-pointer transition-all duration-300 hover:text-blue-200 after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 hover:after:w-full"
            >
              {item.name}
            </Link>
          ))}
        </div>
      </div>

      {/* NAVBAR */}
      <div className="bg-white shadow sticky top-0 z-50">

        <div className="max-w-6xl mx-auto flex items-center px-6 py-3">

          {/* LOGO */}
          <div className="flex-shrink-0 mr-4">
            <img src={logo} alt="logo" className="w-8 h-8" />
          </div>

          {/* SEARCH */}
          <div className="flex-1 flex justify-center">
            <div className="relative w-full max-w-lg">
              <FiSearch className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
              <input
                type="text"
                placeholder="Cari buku favoritmu..."
                className="w-full pl-10 pr-4 py-2 border rounded-full focus:outline-blue-500 focus:ring-2 focus:ring-blue-100"
              />
            </div>
          </div>

          {/* ICON */}
          <div className="flex items-center gap-3 flex-shrink-0 ml-4">
            <FiHeart className="text-xl text-gray-600 cursor-pointer hover:text-red-500 transition" />
            <FiBell className="text-xl text-gray-600 cursor-pointer hover:text-yellow-500 transition" />

            <div className="w-9 h-9 bg-blue-600 text-white flex items-center justify-center rounded-full text-sm">
              R
            </div>
          </div>

        </div>
      </div>

      {/* BANNER FULLSCREEN */}
      <div className="relative w-full h-screen overflow-hidden">

        <div
          className="flex h-full transition-transform duration-700"
          style={{ transform: `translateX(-${currentSlide * 100}%)` }}
        >
          {slides.map((slide, i) => (
            <div key={i} className="min-w-full h-full relative">
              <img
                src={slide.img}
                className="w-full h-full object-cover"
              />

              <div className="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center px-4">
                <h1 className="text-3xl md:text-6xl font-bold text-white mb-4">
                  {slide.title}
                </h1>
                <p className="text-white/80 text-sm md:text-lg max-w-xl">
                  {slide.subtitle}
                </p>
              </div>
            </div>
          ))}
        </div>

        {/* MOBILE NAVBAR (ICON ONLY) */}
<div className="md:hidden fixed bottom-0 left-0 w-full bg-blue-600 text-white border-t border-blue-500 flex justify-around items-center py-3 z-50">

  <Link
    to="/halamanutama"
    className="flex items-center justify-center transition-all duration-200 active:scale-90 hover:text-white/80"
  >
    <FiHome className="text-2xl" />
  </Link>

  <Link
    to="/koleksi"
    className="flex items-center justify-center transition-all duration-200 active:scale-90 hover:text-white/80"
  >
    <FiBook className="text-2xl" />
  </Link>

  <Link
    to="/belanja"
    className="flex items-center justify-center transition-all duration-200 active:scale-90 hover:text-white/80"
  >
    <FiShoppingCart className="text-2xl" />
  </Link>

  <Link
    to="/riwayat"
    className="flex items-center justify-center transition-all duration-200 active:scale-90 hover:text-white/80"
  >
    <FiClock className="text-2xl" />
  </Link>

</div>

        {/* DOT */}
        <div className="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-2">
          {slides.map((_, i) => (
            <button
              key={i}
              onClick={() => setCurrentSlide(i)}
              className={`h-2 rounded-full transition-all ${
                i === currentSlide ? "w-8 bg-blue-500" : "w-2 bg-white/50"
              }`}
            />
          ))}
        </div>

      </div>

      {/* SECTION POPULER */}
      <div className="px-6 md:px-10 mt-10">
        <h2 className="text-xl md:text-2xl font-bold text-gray-800 mb-6">
          E-Book Terpopuler
        </h2>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
          {[1,2,3,4,5,6,7,8].map((item) => (
            <div
              key={item}
              className="bg-white shadow rounded-xl p-3 hover:shadow-lg hover:-translate-y-1 transition-all duration-300"
            >
              <div className="w-full h-32 md:h-40 bg-gray-200 rounded-lg mb-3"></div>
              <h3 className="text-sm font-semibold text-gray-700">
                Judul Buku {item}
              </h3>
              <p className="text-xs text-gray-500">Penulis</p>
            </div>
          ))}
        </div>
      </div>

      {/* SECTION REKOMENDASI */}
      <div className="px-6 md:px-10 mt-14">
        <h2 className="text-xl md:text-2xl font-bold text-gray-800 mb-6">
          Rekomendasi Untukmu
        </h2>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
          {[1,2,3,4].map((item) => (
            <div
              key={item}
              className="bg-blue-50 p-4 rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300"
            >
              <h3 className="font-semibold text-blue-700 mb-2">
                Buku Pilihan {item}
              </h3>
              <p className="text-sm text-gray-600">
                Deskripsi singkat buku rekomendasi.
              </p>
            </div>
          ))}
        </div>
      </div>

      {/* FOOTER */}
      <div className="mt-16 bg-gray-900 text-white text-center py-6">
        <p className="text-sm">© 2026 BukuIn. All rights reserved.</p>
      </div>

    </div>
  );
}