import AOS from "aos"
import "aos/dist/aos.css"
import { useEffect, useState } from "react"
import { FiMenu, FiX } from "react-icons/fi"
import logo from "../assets/logo.png"
import { FiDollarSign, FiUser, FiBookOpen, FiShield } from "react-icons/fi"



import banner1 from "../assets/banner1.png"
import banner2 from "../assets/banner2.png"
import banner3 from "../assets/banner3.png"
import foto from "../assets/foto1beranda.png"

function beranda() {
  const [menuOpen, setMenuOpen] = useState(false)
  const [scrolled, setScrolled] = useState(false)
  const [currentSlide, setCurrentSlide] = useState(0)
  const [activeMenu, setActiveMenu] = useState("beranda")

  useEffect(() => {
    AOS.init({
      duration: 900,
      once: true,
      easing: "ease-out-cubic",
    })
  }, [])

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 50)
    }

    window.addEventListener("scroll", handleScroll)
    return () => window.removeEventListener("scroll", handleScroll)
  }, [])

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % 3)
    }, 4000)

    return () => clearInterval(interval)
  }, [])

  return (
    <div
      style={{
        minHeight: "100vh",
        backgroundColor: "transparent",
        transition: "0.3s",
      }}
    >

      {/* NAVBAR */}
      <div
        className={`fixed top-0 left-0 w-full flex items-center justify-between px-4 md:px-10 py-4 z-50 transition-all duration-500 ease-in-out border-b ${
          scrolled
            ? "bg-black/80 border-white/10 shadow-lg"
            : "bg-transparent border-white/20"
        }`}
      >
        {/* LOGO */}
        <div className="flex items-center gap-2">
          <img
            src={logo}
            alt="logo"
            className="w-8 h-8 md:w-10 md:h-10 object-contain"
          />
          <h1 className="font-semibold text-blue-600 text-sm md:text-base">
            BukuIn
          </h1>
        </div>

        {/* DESKTOP */}
        <div className="hidden md:flex items-center gap-6 text-white">
          <a
  href="#"
  onClick={() => setActiveMenu("beranda")}
  className={`transition ${
    activeMenu === "beranda"
      ? "text-blue-600 font-semibold"
      : "text-white hover:text-blue-600"
  }`}
>
  Beranda
</a>

<a
  href="#keunggulan"
  onClick={() => setActiveMenu("keunggulan")}
  className={`transition ${
    activeMenu === "keunggulan"
      ? "text-blue-600 font-semibold"
      : "text-white hover:text-blue-600"
  }`}
>
  Keunggulan
</a>

<a
  href="#"
  onClick={() => setActiveMenu("pustakawan")}
  className={`transition ${
    activeMenu === "pustakawan"
      ? "text-blue-600 font-semibold"
      : "text-white hover:text-blue-600"
  }`}
>
  Informasi
</a>

          <button className="bg-blue-600 text-white px-4 py-2 rounded-2xl cursor-pointer transition-all duration-300 hover:bg-blue-700 hover:scale-105">
            Login
          </button>
        </div>

        {/* MOBILE */}
        <div className="md:hidden flex items-center gap-1 text-white">
          <button className="bg-blue-600 px-3 py-1 rounded-2xl text-sm cursor-pointer transition-all duration-300 hover:bg-blue-700 hover:scale-105">
            Login
          </button>

          <button onClick={() => setMenuOpen(true)} className="text-2xl">
            <FiMenu />
          </button>
        </div>
      </div>

      <div className="h-20"></div>

      {/* MOBILE MENU */}
      <div
  className={`fixed top-0 left-0 w-full h-full z-50 transform transition-transform duration-300 ${
    menuOpen ? "translate-x-0" : "-translate-x-full"
  }`}
  style={{
    backgroundColor: "#ffffff",
    color: "#1f2937",
  }}
>
  <div className="flex items-center justify-between px-6 py-4 border-b">
    <div className="flex items-center gap-2">
      <img src={logo} className="w-8 h-8 object-contain" />
      <h1 className="font-semibold text-blue-600">BukuIn</h1>
    </div>

    <button
      onClick={() => setMenuOpen(false)}
      className="text-2xl cursor-pointer"
    >
      <FiX />
    </button>
  </div>

  <div className="flex flex-col items-start gap-6 px-6 py-10 text-lg">

    <a
      href="#"
      onClick={() => {
        setActiveMenu("beranda")
        setMenuOpen(false)
      }}
      className={`transition ${
        activeMenu === "beranda"
          ? "text-blue-600 font-semibold"
          : "hover:text-blue-600"
      }`}
    >
      Beranda
    </a>

    <a
      href="#keunggulan"
      onClick={() => {
        setActiveMenu("keunggulan")
        setMenuOpen(false)
      }}
      className={`transition ${
        activeMenu === "keunggulan"
          ? "text-blue-600 font-semibold"
          : "hover:text-blue-600"
      }`}
    >
      Keunggulan
    </a>

    <a
      href="#"
      onClick={() => {
        setActiveMenu("pustakawan")
        setMenuOpen(false)
      }}
      className={`transition ${
        activeMenu === "pustakawan"
          ? "text-blue-600 font-semibold"
          : "hover:text-blue-600"
      }`}
    >
     Informasi
    </a>

  </div>
</div>

      {/* BANNER SLIDER */}
      <div className="relative w-full h-[90vh] overflow-hidden mt-[-80px]">

        <div
          className="flex h-full transition-transform duration-700"
          style={{
            transform: `translateX(-${currentSlide * 100}%)`,
          }}
        >

          {/* SLIDE 1 */}
          <div className="min-w-full relative z-10 h-full">
            <img
              src={banner1}
              className="w-full h-full object-cover object-center bg-black"
            />
            <div className="absolute inset-0 bg-black/40"></div>

            <div className="absolute inset-0 flex items-center justify-center text-white text-center px-4 md:px-0">
              <div data-aos="fade-right">
                <h1 className="text-4xl font-bold">Sistem Perpustakaan Modern</h1>
                <p className="mt-4">Kelola buku lebih mudah</p>

                <div className="mt-6 flex gap-3 justify-center">
                  <button className="bg-blue-600 px-5 py-2 rounded-2xl hover:bg-blue-700 transition">
                    Cari Buku
                  </button>

                  <button className="bg-transparent border border-blue-500 text-blue-500 px-5 py-2 rounded-2xl hover:bg-blue-600 hover:text-white transition">
                    Daftar
                  </button>
                </div>
              </div>
            </div>
          </div>

          {/* SLIDE 2 */}
          <div className="min-w-full relative z-10 h-full">
            <img
              src={banner2}
              className="w-full h-full object-cover object-center bg-black"
            />
            <div className="absolute inset-0 bg-black/40"></div>

            <div className="absolute inset-0 flex items-center justify-center text-white text-center px-4 md:px-0">
              <div data-aos="fade-up">
                <h1 className="text-4xl font-bold">Akses Cepat & Praktis</h1>
                <p className="mt-4">Semua data dalam genggaman</p>

                <div className="mt-6 flex gap-3 justify-center">
                  <button className="bg-blue-600 px-5 py-2 rounded-2xl hover:bg-blue-700 transition">
                    Cari Buku
                  </button>

                  <button className="bg-transparent border border-blue-500 text-blue-500 px-5 py-2 rounded-2xl hover:bg-blue-600 hover:text-white transition">
                    Daftar
                  </button>
                </div>
              </div>
            </div>
          </div>

          {/* SLIDE 3 */}
          <div className="min-w-full relative z-10 h-full">
            <img
              src={banner3}
              className="w-full h-full object-cover bg-black"
            />
            <div className="absolute inset-0 bg-black/40"></div>

            <div className="absolute inset-0 flex items-center justify-center text-white text-center px-4 md:px-0">
              <div data-aos="fade-left">
                <h1 className="text-4xl font-bold">Digital Library</h1>
                <p className="mt-4">Solusi masa depan</p>

                <div className="mt-6 flex gap-3 justify-center">
                  <button className="bg-blue-600 px-5 py-2 rounded-2xl hover:bg-blue-700 transition">
                    Cari Buku
                  </button>

                  {/* 🔥 UPDATED DAFTAR BUTTON */}
                  <button className="bg-transparent border border-blue-500 text-blue-500 px-5 py-2 rounded-2xl hover:bg-blue-600 hover:text-white transition">
                    Daftar
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>

        {/* 🔥 WAVE DESKTOP */}
<div className="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-30 hidden md:block">
  <svg
    viewBox="0 0 1440 320"
    className="w-full h-[120px]"
    preserveAspectRatio="none"
  >
    <path
      fill="#ffffff"
      d="M0,0 C360,240 1080,240 1440,0 L1440,320 L0,320 Z"
    />
  </svg>
</div>

{/* 🔥 GARIS LURUS MOBILE */}
<div className="absolute bottom-0 left-0 w-full z-30 md:hidden">
  <div className="w-full h-[40px] bg-white"></div>
</div>

      </div>

      {/* 🔥 CONTENT SECTION */}
<div id="keunggulan" className="bg-blue-50 py-20 px-6 md:px-16">
  
  <div className="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">
    
   {/* 🔥 KIRI (TEXT + IMAGE) */}
<div className="md:ml-12 text-center md:text-left">
  
  <h2 className="text-3xl md:text-4xl font-bold text-gray-800 leading-snug">
    Digitalisasi Mudah untuk  <br /> Perpustakaanmu
  </h2>

{/* IMAGE */}
<div className="mt-6 flex justify-center md:justify-start">
  <img
    src={foto}
    alt="preview"
    data-aos="fade-right"
    className="custom-rotate-img w-[220px] md:w-[260px] h-[300px] md:h-[360px] object-cover rounded-2xl shadow-lg"
  />
</div>

</div>

    {/* 🔥 KANAN (CARD FITUR) */}
   <div className="grid grid-cols-1 sm:grid-cols-2 gap-6 md:-ml-50 md:mt-25">

      {/* CARD 1 */}
<div
  data-aos="fade-up"
  data-aos-delay="0"
  className="bg-white p-5 rounded-2xl shadow-md hover:shadow-lg transition"
>
  <FiDollarSign className="text-3xl text-blue-600 mb-3" />
  <h3 className="font-semibold text-gray-800">
    Hemat Biaya Operasional
  </h3>
  <p className="text-sm text-gray-500 mt-2">
    Kelola perpustakaan tanpa perlu infrastruktur rumit seperti server atau ruang khusus.
  </p>
</div>

{/* CARD 2 */}
<div
  data-aos="fade-up"
  data-aos-delay="100"
  className="bg-white p-5 rounded-2xl shadow-md hover:shadow-lg transition"
>
  <FiUser className="text-3xl text-blue-600 mb-3" />
  <h3 className="font-semibold text-gray-800">
    Mudah Digunakan
  </h3>
  <p className="text-sm text-gray-500 mt-2">
    Dirancang agar sederhana dan nyaman digunakan oleh siapa saja di berbagai perangkat.
  </p>
</div>

{/* CARD 3 */}
<div
  data-aos="fade-up"
  data-aos-delay="200"
  className="bg-white p-5 rounded-2xl shadow-md hover:shadow-lg transition"
>
  <FiBookOpen className="text-3xl text-blue-600 mb-3" />
  <h3 className="font-semibold text-gray-800">
    Koleksi Lengkap & Variatif
  </h3>
  <p className="text-sm text-gray-500 mt-2">
    Beragam pilihan konten tersedia untuk memenuhi kebutuhan bacaanmu.
  </p>
</div>

{/* CARD 4 */}
<div
  data-aos="fade-up"
  data-aos-delay="300"
  className="bg-white p-5 rounded-2xl shadow-md hover:shadow-lg transition"
>
  <FiShield className="text-3xl text-blue-600 mb-3" />
  <h3 className="font-semibold text-gray-800">
    Dukungan Penuh & Terpercaya
  </h3>
  <p className="text-sm text-gray-500 mt-2">
    Didukung oleh tim profesional yang siap membantu kelancaran operasional.
  </p>
</div>

    </div>
  </div>
</div>

    </div>
  )
}

export default beranda