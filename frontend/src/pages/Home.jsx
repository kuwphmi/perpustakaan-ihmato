import AOS from "aos"
import "aos/dist/aos.css"
import { useEffect, useState } from "react"
import { FiMenu, FiX } from "react-icons/fi"
import logo from "../assets/logo.png"

// 👉 gambar banner
import banner1 from "../assets/banner1.png"
import banner2 from "../assets/banner2.png"
import banner3 from "../assets/banner3.png"

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
          <a href="#" className="text-blue-600 font-semibold">
            Beranda
          </a>
          <a href="#" className="hover:text-blue-600 transition">
            Buku
          </a>
          <a href="#" className="hover:text-blue-600 transition">
            Pustakawan
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
          <a href="#" className="text-blue-600 font-semibold cursor-pointer">
            Beranda
          </a>
          <a href="#" className="hover:text-blue-600 transition cursor-pointer">
            Buku user
          </a>
          <a href="#" className="hover:text-blue-600 transition cursor-pointer">
            Pustakawan
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
              className="w-full h-full object-contain md:object-cover object-center bg-black"
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

                  {/* 🔥 UPDATED DAFTAR BUTTON */}
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
              className="w-full h-full object-contain md:object-cover object-center bg-black"
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

                  {/* 🔥 UPDATED DAFTAR BUTTON */}
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
              className="w-full h-full object-contain md:object-cover object-center bg-black"
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

        {/* WAVE */}
        <div className="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-30">
          <svg
            viewBox="0 0 1440 320"
            className="w-full h-[140px] md:h-[120px]"
            preserveAspectRatio="none"
          >
            <path
              fill="#ffffff"
              d="M0,0 C360,240 1080,240 1440,0 L1440,320 L0,320 Z"
            />
          </svg>
        </div>

      </div>

      {/* CONTENT */}
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