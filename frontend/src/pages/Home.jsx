import AOS from "aos"
import "aos/dist/aos.css"
import { useEffect, useState } from "react"
import { FiMenu, FiX } from "react-icons/fi"
import logo from "../assets/logo.png"

function Home() {
  const [menuOpen, setMenuOpen] = useState(false)
  const [scrolled, setScrolled] = useState(false)
  const [currentSlide, setCurrentSlide] = useState(0)

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
        backgroundColor: "#f5f7fb",
        transition: "0.3s",
      }}
    >

      {/* 🔥 NAVBAR */}
      <div
        className="fixed top-0 left-0 w-full flex items-center justify-between px-4 md:px-10 py-4 z-50 transition-all duration-300"
        style={{
          backgroundColor: scrolled ? "#0f172a" : "transparent",
          backdropFilter: scrolled ? "blur(10px)" : "none",
        }}
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
          <a href="#" className="text-blue-600 font-semibold">
            Beranda
          </a>

          <a href="#" className="hover:text-blue-600 transition">
            Buku
          </a>

          <a href="#" className="hover:text-blue-600 transition">
            Pustakawan
          </a>

          <button className="bg-blue-600 text-white px-4 py-2 rounded-2xl">
            Login
          </button>
        </div>

        {/* MOBILE */}
        <div className="md:hidden flex items-center gap-3 text-white">

          <button className="bg-blue-600 px-3 py-1 rounded-2xl text-sm">
            Login
          </button>

          <button
            onClick={() => setMenuOpen(true)}
            className="text-2xl"
          >
            <FiMenu />
          </button>

        </div>
      </div>

      {/* SPACER */}
      <div className="h-20"></div>

      {/* 🔥 MENU MOBILE */}
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

          <button onClick={() => setMenuOpen(false)} className="text-2xl">
            <FiX />
          </button>
        </div>

        <div className="flex flex-col items-start gap-6 px-6 py-10 text-lg">
          <a href="#" className="text-blue-600 font-semibold">
            Beranda
          </a>

          <a href="#" className="hover:text-blue-600 transition">
            Buku user
          </a>

          <a href="#" className="hover:text-blue-600 transition">
            Pustakawan
          </a>
        </div>
      </div>

      {/* 🔥 BANNER SLIDER */}
      <div className="relative w-full h-[90vh] overflow-hidden">

        <div
          className="flex h-full transition-transform duration-700"
          style={{
            transform: `translateX(-${currentSlide * 100}%)`,
          }}
        >

          <div className="min-w-full flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-400 text-white">
            <div data-aos="fade-right">
              <h1 className="text-4xl font-bold">
                Sistem Perpustakaan Modern
              </h1>
              <p className="mt-4">Kelola buku lebih mudah</p>
            </div>
          </div>

          <div className="min-w-full flex items-center justify-center bg-gradient-to-r from-blue-700 to-indigo-500 text-white">
            <div data-aos="fade-up">
              <h1 className="text-4xl font-bold">
                Akses Cepat & Praktis
              </h1>
              <p className="mt-4">Semua data dalam genggaman</p>
            </div>
          </div>

          <div className="min-w-full flex items-center justify-center bg-gradient-to-r from-blue-500 to-cyan-400 text-white">
            <div data-aos="fade-left">
              <h1 className="text-4xl font-bold">
                Digital Library
              </h1>
              <p className="mt-4">Solusi masa kini</p>
            </div>
          </div>

        </div>

       {/* 🔥 TRANSISI CEKUNG KE ATAS (180°) */}
<div className="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
  <svg
    viewBox="0 0 1440 320"
    className="w-full h-[120px]"
    preserveAspectRatio="none"
  >
    <path
      fill="#ffffff"
      d="
        M0,0
        C360,240 1080,240 1440,0
        L1440,320 L0,320 Z
      "
    />
  </svg>
</div>
      </div>

      {/* 🔥 CONTENT */}
      <div className="bg-white py-20 px-6 md:px-16">
        <h2 className="text-2xl font-bold text-gray-800">
          Konten Selanjutnya
        </h2>

        <div className="h-[800px]"></div>
      </div>

    </div>
  )
}

export default Home