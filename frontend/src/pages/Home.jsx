function Home() {
  return (
    <div className="min-h-screen bg-[#f5f7fb]">

      {/* NAVBAR */}
      <div className="flex justify-between items-center px-10 py-5 bg-white shadow-sm">

        <h1 className="font-semibold text-blue-600">
          📚 STMIK Digital Library
        </h1>

        <div className="flex gap-6 items-center text-gray-600">
          <a href="#">Beranda</a>
          <a href="#">Buku user</a>
          <a href="#">Pustakawan</a>

          <button className="bg-blue-600 text-white px-4 py-2 rounded-md">
            Login
          </button>
        </div>
      </div>

      {/* HERO */}
      <div className="flex items-center justify-between px-16 py-16">

        {/* KIRI */}
        <div className="max-w-xl">

          <h1 className="text-4xl font-bold leading-tight text-gray-800">
            Selamat Datang Di <br />
            <span className="text-black">DIGLIB</span> <br />
            <span className="text-blue-600">STMIK</span> <br />
            <span className="text-blue-600">AMIKBANDUNG.</span>
          </h1>

          <p className="mt-5 text-gray-500">
            Anda dapat mencari seluruh koleksi yang tersedia di perpustakaan kami.
          </p>

          <div className="mt-6 flex gap-4">
            <button className="bg-blue-600 text-white px-6 py-3 rounded-md">
              Cari Buku →
            </button>

            <button className="bg-blue-100 text-blue-600 px-6 py-3 rounded-md">
              Daftar
            </button>
          </div>

        </div>

        {/* KANAN */}
        <div>
          <img
            src="/img/hero.png"
            alt="hero"
            className="w-[500px]"
          />
        </div>

      </div>

    </div>
  )
}

export default Home