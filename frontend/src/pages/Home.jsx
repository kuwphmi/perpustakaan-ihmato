export default function Home() {
  return (
    <div className="min-h-screen bg-linear-to-br from-blue-100 to-blue-300 flex flex-col items-center justify-center px-4">
      {/* Hero Section */}
      <div className="text-center max-w-2xl">
        <h1 className="text-4xl md:text-5xl font-bold text-blue-900 mb-4">📚 Perpustakaan IHMATO</h1>

        <p className="text-lg text-gray-700 mb-8">Selamat datang di sistem informasi perpustakaan. Temukan buku favoritmu dengan mudah dan cepat 🚀</p>

        {/* Button */}
        <div className="flex gap-4 justify-center">
          <button className="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-xl shadow-md transition">Login</button>

          <button className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl shadow-md transition">Lihat Buku</button>
        </div>
      </div>

      {/* Info Section */}
      <div className="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl">
        <div className="bg-white p-6 rounded-2xl shadow-md text-center">
          <h2 className="text-xl font-semibold text-blue-800 mb-2">📖 Banyak Buku</h2>
          <p className="text-gray-600 text-sm">Koleksi buku lengkap dari berbagai kategori.</p>
        </div>

        <div className="bg-white p-6 rounded-2xl shadow-md text-center">
          <h2 className="text-xl font-semibold text-blue-800 mb-2">⚡ Cepat & Mudah</h2>
          <p className="text-gray-600 text-sm">Cari dan pinjam buku dengan sistem yang cepat.</p>
        </div>

        <div className="bg-white p-6 rounded-2xl shadow-md text-center">
          <h2 className="text-xl font-semibold text-blue-800 mb-2">🔐 Aman</h2>
          <p className="text-gray-600 text-sm">Data pengguna dan transaksi aman.</p>
        </div>
      </div>
    </div>
  );
}
