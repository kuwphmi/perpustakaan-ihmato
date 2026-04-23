import { BrowserRouter, Routes, Route } from "react-router-dom";
import Beranda from "./pages/beranda";
import Login from "./pages/login";
import HalamanUtama from "./pages/halamanutama";
import Koleksi from "./pages/koleksi";
import Belanja from "./pages/belanja"; 

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Beranda />} />
        <Route path="/login" element={<Login />} />
        <Route path="/halamanutama" element={<HalamanUtama />} />
        <Route path="/koleksi" element={<Koleksi />} />
        <Route path="/belanja" element={<Belanja />} /> {/* ⬅️ route baru */}
      </Routes>
    </BrowserRouter>
  );
}

export default App;