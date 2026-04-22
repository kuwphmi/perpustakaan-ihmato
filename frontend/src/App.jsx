import { BrowserRouter, Routes, Route } from "react-router-dom";
import Beranda from "./pages/beranda";
import Login from "./pages/login";
import HalamanUtama from "./pages/halamanutama";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Beranda />} />
        <Route path="/login" element={<Login />} />
        <Route path="/halamanutama" element={<HalamanUtama />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;