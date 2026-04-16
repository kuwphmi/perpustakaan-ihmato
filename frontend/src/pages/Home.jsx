import AOS from "aos"
import "aos/dist/aos.css"
import { useEffect, useState } from "react"
import { FiMoon, FiSun, FiMenu, FiX } from "react-icons/fi"
import logo from "../assets/logo.png"

function Home() {
  const [darkMode, setDarkMode] = useState(false)
  const [menuOpen, setMenuOpen] = useState(false)

  useEffect(() => {
    AOS.init({
      duration: 900,                 // sedikit lebih lama biar smooth
      easing: "ease-out-cubic",      // lebih natural dari fade
      once: true,                    // biar gak spam animasi (ini penting buat anti lag)
      offset: 80,                    // trigger lebih natural
      mirror: false,                 // hindari re-trigger scroll (biar gak nyendat)
      anchorPlacement: "top-bottom",
      disableMutationObserver: true, // FIX utama scroll lag AOS
    })

    // optional tapi penting biar smooth di beberapa device
    window.addEventListener("load", () => {
      AOS.refresh()
    })
  }, [])

  return (
    <div
      style={{
        minHeight: "100vh",
        backgroundColor: darkMode ? "#0f172a" : "#f5f7fb",
        transition: "0.3s",
      }}
    >

      {/* NAVBAR */}
      <div
        className="flex items-center justify-between px-4 md:px-10 py-4 shadow-sm"
        style={{
          backgroundColor: darkMode ? "#1e293b" : "#ffffff",
        }}
      >

        {/* LOGO + TEXT */}
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

        {/* MENU DESKTOP */}
        <div
          className="hidden md:flex items-center gap-6"
          style={{ color: darkMode ? "#fff" : "#4b5563" }}
        >
          <a href="#">Beranda</a>
          <a href="#">Buku user</a>
          <a href="#">Pustakawan</a>

          <button
            onClick={() => setDarkMode(!darkMode)}
            className="text-xl"
            style={{ color: darkMode ? "#fff" : "#111" }}
          >
            {darkMode ? <FiSun /> : <FiMoon />}
          </button>

          <button className="bg-blue-600 text-white px-4 py-2 rounded-md">
            Login
          </button>
        </div>

        {/* MOBILE */}
        <div className="md:hidden flex items-center gap-3">
          <button className="bg-blue-600 text-white px-3 py-1 rounded-md text-sm">
            Login
          </button>

          <button
            onClick={() => setDarkMode(!darkMode)}
            className="text-xl"
            style={{ color: darkMode ? "#fff" : "#111" }}
          >
            {darkMode ? <FiSun /> : <FiMoon />}
          </button>

          <button
            onClick={() => setMenuOpen(!menuOpen)}
            className="text-2xl"
            style={{ color: darkMode ? "#fff" : "#111" }}
          >
            {menuOpen ? <FiX /> : <FiMenu />}
          </button>
        </div>
      </div>

      {/* MOBILE MENU */}
      {menuOpen && (
        <div
          className="md:hidden flex flex-col gap-4 px-6 py-4"
          style={{
            backgroundColor: darkMode ? "#1e293b" : "#ffffff",
            color: darkMode ? "#fff" : "#4b5563",
          }}
        >
          <a href="#">Beranda</a>
          <a href="#">Buku user</a>
          <a href="#">Pustakawan</a>
        </div>
      )}

      {/* HERO */}
      <div className="flex flex-col md:flex-row items-center justify-between px-6 md:px-16 py-10 md:py-16 gap-10">

        {/* LEFT */}
        <div
          className="max-w-xl text-left"
          data-aos="zoom-in-up"   // 🔥 ini yang bikin lebih hidup, bukan fade
        >
          <h1
            className="text-2xl md:text-4xl font-bold leading-tight"
            style={{ color: darkMode ? "#fff" : "#1f2937" }}
          >
            Selamat Datang Di <br />
            <span style={{ color: darkMode ? "#fff" : "#000" }}>
              DIGLIB
            </span> <br />
            <span className="text-blue-600">STMIK</span> <br />
            <span className="text-blue-600">AMIKBANDUNG.</span>
          </h1>

          <p
            className="mt-4 md:mt-5"
            style={{ color: darkMode ? "#cbd5e1" : "#6b7280" }}
          >
            Anda dapat mencari seluruh koleksi yang tersedia di perpustakaan kami.
          </p>

          {/* BUTTONS */}
          <div className="mt-6 flex gap-4" data-aos="zoom-in">
            <button className="bg-blue-600 text-white px-6 py-3 rounded-md">
              Cari Buku →
            </button>

            <button
              className="px-6 py-3 rounded-md"
              style={{
                backgroundColor: darkMode ? "#334155" : "#dbeafe",
                color: darkMode ? "#fff" : "#1d4ed8",
              }}
            >
              Daftar
            </button>
          </div>
        </div>

        {/* RIGHT */}
        <div
          className="w-full flex justify-center"
          data-aos="zoom-in-left"   // 🔥 lebih smooth dari fade
        >
          <img
            src="/img/hero.png"
            alt="hero"
            className="w-[220px] md:w-[500px] h-auto"
          />
        </div>

      </div>
    </div>
  )
}

export default Home