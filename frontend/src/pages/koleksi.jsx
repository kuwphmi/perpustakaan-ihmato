import { useState } from "react";
import { Link } from "react-router-dom";
import {
  FiSearch,
  FiBell,
  FiHeart,
  FiHome,
  FiBook,
  FiShoppingCart,
  FiClock,
} from "react-icons/fi";

import logo from "../assets/logo.png";

export default function Koleksi() {
  const [search, setSearch] = useState("");
  const [openFilter, setOpenFilter] = useState(null);

  // 🔥 tambahan untuk mobile filter
  const [showFilter, setShowFilter] = useState(false);

  const books = [
    { id: 1, title: "Algoritma Dasar", author: "Budi" },
    { id: 2, title: "React untuk Pemula", author: "Andi" },
    { id: 3, title: "UI UX Design", author: "Sinta" },
    { id: 4, title: "Database MySQL", author: "Rizky" },
    { id: 5, title: "Pemrograman Web", author: "Dewi" },
    { id: 6, title: "Node JS Guide", author: "Farhan" },
  ];

  const filteredBooks = books.filter((b) =>
    b.title.toLowerCase().includes(search.toLowerCase())
  );

  return (
    <div className="min-h-screen bg-gray-100">

      {/* HEADER BIRU */}
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

          <img src={logo} alt="logo" className="w-8 h-8 mr-4" />

          <div className="flex-1 flex justify-center">
            <div className="relative w-full max-w-lg">
              <FiSearch className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
              <input
                value={search}
                onChange={(e) => setSearch(e.target.value)}
                type="text"
                placeholder="Cari buku..."
                className="w-full pl-10 pr-4 py-2 border rounded-full focus:outline-blue-500 focus:ring-2 focus:ring-blue-100"
              />
            </div>
          </div>

          <div className="flex items-center gap-3 ml-4">
            <FiHeart className="text-xl text-gray-600 hover:text-red-500 cursor-pointer" />
            <FiBell className="text-xl text-gray-600 hover:text-yellow-500 cursor-pointer" />
            <div className="w-9 h-9 bg-blue-600 text-white flex items-center justify-center rounded-full text-sm">
              R
            </div>
          </div>

        </div>
      </div>

      {/* MAIN */}
      <div className="max-w-7xl mx-auto flex gap-6 px-6 mt-6">

        {/* FILTER DESKTOP (TIDAK DIUBAH) */}
        <div className="hidden md:block w-72">
          <div className="bg-white rounded-2xl shadow-md p-5 sticky top-24">

            <h2 className="font-bold text-lg mb-4">Filter Buku</h2>

            {[
              {
                title: "Genre",
                options: ["Teknologi", "UI/UX", "Database", "Web Dev"],
              },
              {
                title: "Penerbit",
                options: ["Gramedia", "Informatika", "Erlangga"],
              },
              {
                title: "Rating",
                options: ["⭐ 5", "⭐ 4 ke atas", "⭐ 3 ke atas"],
              },
            ].map((item, i) => (
              <div key={i} className="mb-3 border rounded-xl overflow-hidden">

                <button
                  onClick={() => setOpenFilter(openFilter === i ? null : i)}
                  className="w-full flex items-center justify-between px-4 py-3 bg-gray-50 hover:bg-gray-100 transition"
                >
                  <span className="font-medium text-sm">{item.title}</span>
                </button>

                {openFilter === i && (
                  <div className="p-3 flex flex-col gap-2 text-sm text-gray-600">
                    {item.options.map((opt, idx) => (
                      <label key={idx} className="flex items-center gap-2">
                        <input type="checkbox" className="accent-blue-600" />
                        {opt}
                      </label>
                    ))}
                  </div>
                )}

              </div>
            ))}

          </div>
        </div>

        {/* CONTENT */}
        <div className="flex-1">

          <h1 className="text-2xl font-bold mb-2">E-Book</h1>

          {/* tombol filter mobile */}
          <button
            onClick={() => setShowFilter(true)}
            className="md:hidden mb-3 px-4 py-2 bg-blue-600 text-white rounded-lg"
          >
            Filter
          </button>

          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

            {filteredBooks.map((book) => (
              <div
                key={book.id}
                className="bg-white rounded-xl shadow hover:shadow-lg transition p-3"
              >
                <div className="h-40 bg-gray-200 rounded-lg mb-3"></div>
                <h3 className="font-semibold text-sm">{book.title}</h3>
                <p className="text-xs text-gray-500">{book.author}</p>
              </div>
            ))}

          </div>

        </div>
      </div>

      {/* FILTER MOBILE OVERLAY */}
      {showFilter && (
        <div className="fixed inset-0 z-50 bg-black/40 flex md:hidden">

          <div className="w-80 bg-white h-full p-5 overflow-y-auto">

            <div className="flex justify-between items-center mb-4">
              <h2 className="font-bold text-lg">Filter Buku</h2>

              <button
                onClick={() => setShowFilter(false)}
                className="text-red-500 font-bold"
              >
                ✕
              </button>
            </div>

            {[
              {
                title: "Genre",
                options: ["Teknologi", "UI/UX", "Database", "Web Dev"],
              },
              {
                title: "Penerbit",
                options: ["Gramedia", "Informatika", "Erlangga"],
              },
              {
                title: "Rating",
                options: ["⭐ 5", "⭐ 4 ke atas", "⭐ 3 ke atas"],
              },
            ].map((item, i) => (
              <div key={i} className="mb-3 border rounded-xl overflow-hidden">

                <button
                  onClick={() => setOpenFilter(openFilter === i ? null : i)}
                  className="w-full flex items-center justify-between px-4 py-3 bg-gray-50"
                >
                  <span className="font-medium text-sm">{item.title}</span>
                </button>

                {openFilter === i && (
                  <div className="p-3 flex flex-col gap-2 text-sm text-gray-600">
                    {item.options.map((opt, idx) => (
                      <label key={idx} className="flex items-center gap-2">
                        <input type="checkbox" className="accent-blue-600" />
                        {opt}
                      </label>
                    ))}
                  </div>
                )}

              </div>
            ))}

          </div>
        </div>
      )}

      {/* MOBILE NAVBAR */}
      <div className="md:hidden fixed bottom-0 left-0 w-full bg-blue-600 text-white border-t border-blue-500 flex justify-around items-center py-3">

        <Link to="/halamanutama"><FiHome className="text-2xl" /></Link>
        <Link to="/koleksi"><FiBook className="text-2xl" /></Link>
        <Link to="/belanja"><FiShoppingCart className="text-2xl" /></Link>
        <Link to="/riwayat"><FiClock className="text-2xl" /></Link>

      </div>

      {/* FOOTER */}
      <div className="mt-16 bg-gray-900 text-white text-center py-6">
        <p className="text-sm">© 2026 BukuIn. All rights reserved.</p>
      </div>

    </div>
  );
}