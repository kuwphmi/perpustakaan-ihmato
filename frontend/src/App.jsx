import { BrowserRouter, Routes, Route } from "react-router-dom";
import Beranda from "./pages/beranda";
import Login from "./pages/login";
import HalamanUtama from "./pages/halamanutama";
import Koleksi from "./pages/koleksi";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Beranda />} />
        <Route path="/login" element={<Login />} />
        <Route path="/halamanutama" element={<HalamanUtama />} />
        <Route path="/koleksi" element={<Koleksi />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;