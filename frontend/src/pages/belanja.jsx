import { useState, useEffect } from "react";

export default function Belanja() {
  const [cart, setCart] = useState([]);
  const [currentSlide, setCurrentSlide] = useState(0);

  const banners = [
    "/banner1.png",
    "/banner2.png",
    "/banner3.png",
  ];

  const products = [
    { id: 1, name: "E-Book Pemrograman", price: 50000 },
    { id: 2, name: "E-Book Desain UI/UX", price: 75000 },
    { id: 3, name: "E-Book Data Science", price: 90000 },
  ];

  const addToCart = (product) => {
    setCart([...cart, product]);
  };

  // Auto slide
  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentSlide((prev) =>
        prev === banners.length - 1 ? 0 : prev + 1
      );
    }, 3000);

    return () => clearInterval(interval);
  }, []);

  return (
    <div className="font-sans">

      {/* Navbar */}
      <header className="absolute top-0 left-0 w-full flex justify-between items-center px-10 py-5 text-white z-20">
        <div className="flex items-center gap-2">
          <img src="/logo.png" alt="logo" className="w-10" />
        </div>

        <nav className="space-x-6 hidden md:flex">
          <a href="#">Beranda</a>
          <a href="#">Semua Produk</a>
          <a href="#">Berita</a>
          <a href="#">Cara Belanja</a>
          <a href="#">Tentang</a>
        </nav>

        <div className="text-xl">
          🛒 <span>{cart.length}</span>
        </div>
      </header>

      {/* Slider Banner */}
      <section className="relative h-[90vh] w-full overflow-hidden">
        {banners.map((img, index) => (
          <img
            key={index}
            src={img}
            alt={`banner-${index}`}
            className={`absolute w-full h-full object-cover transition-opacity duration-700 ${
              currentSlide === index ? "opacity-100" : "opacity-0"
            }`}
          />
        ))}

        {/* Overlay Text */}
        <div className="absolute inset-0 bg-black/40 flex flex-col justify-center px-10 text-white">
          <h1 className="text-5xl font-bold mb-4">
            PERPUSTAKAAN DIGITAL
          </h1>
          <p className="text-xl italic mb-6">
            Dunia Dalam Genggaman
          </p>
          <button className="bg-orange-500 px-6 py-3 rounded-full w-fit hover:bg-orange-600">
            Belanja Sekarang
          </button>
        </div>

        {/* Indicator */}
        <div className="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex gap-2">
          {banners.map((_, i) => (
            <div
              key={i}
              onClick={() => setCurrentSlide(i)}
              className={`w-3 h-3 rounded-full cursor-pointer ${
                currentSlide === i ? "bg-white" : "bg-gray-400"
              }`}
            />
          ))}
        </div>
      </section>

      {/* Produk */}
      <section className="py-16 px-10 bg-gray-100">
        <h2 className="text-3xl font-bold mb-10 text-center">
          Produk Kami
        </h2>

        <div className="grid md:grid-cols-3 gap-8">
          {products.map((item) => (
            <div
              key={item.id}
              className="bg-white p-6 rounded-xl shadow hover:shadow-lg transition"
            >
              <h3 className="text-xl font-semibold mb-2">
                {item.name}
              </h3>
              <p className="text-gray-600 mb-4">
                Rp {item.price.toLocaleString()}
              </p>
              <button
                onClick={() => addToCart(item)}
                className="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600"
              >
                Tambah ke Keranjang
              </button>
            </div>
          ))}
        </div>
      </section>

    </div>
  );
}