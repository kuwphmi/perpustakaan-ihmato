import { BrowserRouter, Routes, Route } from "react-router-dom";
import Beranda from "./pages/beranda";
import Login from "./pages/login";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Beranda />} />
        <Route path="/login" element={<Login />} />
        <Route path="/beranda" element={<Beranda />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
