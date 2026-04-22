import { useState } from "react";
import logo from "../assets/logo.png";

// ─── Password Strength Helper ──────────────────────────────────────────────
function getStrength(password) {
  let score = 0;
  if (password.length >= 8) score++;
  if (/[A-Z]/.test(password)) score++;
  if (/[0-9]/.test(password)) score++;
  if (/[^A-Za-z0-9]/.test(password)) score++;
  return score;
}

const strengthColors = ["bg-red-500", "bg-orange-400", "bg-yellow-400", "bg-green-500"];
const strengthLabels = ["Lemah", "Cukup", "Kuat", "Sangat Kuat"];

// ─── Google Icon ──────────────────────────────────────────────────────────
function GoogleIcon() {
  return (
    <svg className="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
      <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
      <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
      <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
    </svg>
  );
}

// ─── Logo ─────────────────────────────────────────────────────────────────
function Logo() {
  return (
    <div className="flex items-center gap-2.5">
      <img src={logo} alt="logo" className="w-9 h-9 object-contain" />
      <span className="text-white font-semibold text-base tracking-tight">BukuIn</span>
    </div>
  );
}

// ─── Input Field ──────────────────────────────────────────────────────────
function Field({ label, type = "text", placeholder, value, onChange }) {
  return (
    <div className="flex flex-col gap-1.5">
      <label className="text-sm font-medium text-gray-600">{label}</label>
      <input
        type={type}
        placeholder={placeholder}
        value={value}
        onChange={onChange}
        className="h-11 px-3.5 rounded-lg border border-gray-200 text-sm text-gray-900 placeholder-gray-400 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all bg-white"
      />
    </div>
  );
}

// ─── Side Panel ───────────────────────────────────────────────────────────
function SidePanel({ title, description, dotIndex, bgColor }) {
  return (
    <div className={`hidden md:flex flex-col justify-between w-2/5 p-12 ${bgColor} relative overflow-hidden`}>
      {/* Decorative circles */}
      <div className="absolute w-64 h-64 rounded-full border-40 border-white/5 -bottom-20 -left-16" />
      <div className="absolute w-40 h-40 rounded-full border-30 border-white/5 -top-10 -right-10" />

      <Logo />

      <div className="relative z-10">
        <h2 className="text-white font-semibold text-xl leading-snug mb-3">{title}</h2>
        <p className="text-white/70 text-sm leading-relaxed">{description}</p>
      </div>

      <div className="flex gap-1.5">
        {[0, 1, 2].map((i) => (
          <div key={i} className={`h-1.5 rounded-full transition-all ${i === dotIndex ? "w-5 bg-white" : "w-1.5 bg-white/30"}`} />
        ))}
      </div>
    </div>
  );
}

// ─── Login Form ───────────────────────────────────────────────────────────
import { useNavigate } from "react-router-dom"; // ← tambah di paling atas file

function LoginForm({ onSwitch }) {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate(); // ← tambah ini

  const handleSubmit = (e) => {
    e.preventDefault();
    navigate("/beranda"); // ← ganti alert dengan ini
  };

  return (
    <div className="flex flex-1 flex-col justify-center px-8 md:px-12 py-10 max-w-md w-full mx-auto">
      <div className="mb-7">
        <h1 className="text-2xl font-semibold text-gray-900 mb-1.5">Masuk ke akun</h1>
        <p className="text-sm text-gray-500">
          Belum punya akun?{" "}
          <button onClick={onSwitch} className="text-blue-700 font-medium hover:underline">
            Daftar sekarang
          </button>
        </p>
      </div>

      <form onSubmit={handleSubmit} className="flex flex-col gap-4">
        <Field label="Alamat Email" type="email" placeholder="nama@email.com" value={email} onChange={(e) => setEmail(e.target.value)} />
        <div className="flex flex-col gap-1.5">
          <Field label="Kata Sandi" type="password" placeholder="Masukkan kata sandi" value={password} onChange={(e) => setPassword(e.target.value)} />
          <div className="text-right">
            <button type="button" className="text-xs text-blue-700 hover:underline">
              Lupa kata sandi?
            </button>
          </div>
        </div>

        <button type="submit" className="mt-1 h-11 bg-blue-700 hover:bg-blue-800 active:scale-[0.98] text-white font-medium rounded-lg text-sm transition-all">
          Masuk
        </button>
      </form>

      <div className="flex items-center gap-3 my-5">
        <div className="flex-1 h-px bg-gray-100" />
        <span className="text-xs text-gray-400">atau lanjutkan dengan</span>
        <div className="flex-1 h-px bg-gray-100" />
      </div>

      <button className="flex items-center justify-center gap-2.5 h-11 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
        <GoogleIcon />
        Masuk dengan Google
      </button>
    </div>
  );
}

// ─── Register Form ────────────────────────────────────────────────────────
function RegisterForm({ onSwitch }) {
  const [form, setForm] = useState({
    firstName: "",
    lastName: "",
    email: "",
    phone: "",
    password: "",
    agree: false,
  });

  const strength = getStrength(form.password);

  const set = (key) => (e) => setForm((prev) => ({ ...prev, [key]: e.target.type === "checkbox" ? e.target.checked : e.target.value }));

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!form.agree) return alert("Harap setujui syarat & ketentuan.");
    alert("Akun berhasil dibuat! (demo)");
  };

  return (
    <div className="flex flex-1 flex-col justify-center px-8 md:px-12 py-10 max-w-md w-full mx-auto overflow-y-auto">
      <div className="mb-6">
        <h1 className="text-2xl font-semibold text-gray-900 mb-1.5">Buat akun baru</h1>
        <p className="text-sm text-gray-500">
          Sudah punya akun?{" "}
          <button onClick={onSwitch} className="text-blue-700 font-medium hover:underline">
            Masuk di sini
          </button>
        </p>
      </div>

      <form onSubmit={handleSubmit} className="flex flex-col gap-4">
        {/* Name Row */}
        <div className="grid grid-cols-2 gap-3">
          <Field label="Nama Depan" placeholder="Budi" value={form.firstName} onChange={set("firstName")} />
          <Field label="Nama Belakang" placeholder="Santoso" value={form.lastName} onChange={set("lastName")} />
        </div>

        <Field label="Alamat Email" type="email" placeholder="nama@email.com" value={form.email} onChange={set("email")} />
        <Field label="Nomor Telepon" type="tel" placeholder="+62 812 3456 7890" value={form.phone} onChange={set("phone")} />

        {/* Password + Strength */}
        <div className="flex flex-col gap-1.5">
          <label className="text-sm font-medium text-gray-600">Kata Sandi</label>
          <input
            type="password"
            placeholder="Min. 8 karakter"
            value={form.password}
            onChange={set("password")}
            className="h-11 px-3.5 rounded-lg border border-gray-200 text-sm text-gray-900 placeholder-gray-400 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all bg-white"
          />
          {form.password && (
            <div className="flex flex-col gap-1">
              <div className="flex gap-1">
                {[1, 2, 3, 4].map((i) => (
                  <div key={i} className={`flex-1 h-1 rounded-full transition-all ${i <= strength ? strengthColors[strength - 1] : "bg-gray-100"}`} />
                ))}
              </div>
              <p className="text-xs text-gray-400">{strengthLabels[strength - 1]}</p>
            </div>
          )}
        </div>

        {/* Agree checkbox */}
        <label className="flex items-start gap-2.5 cursor-pointer">
          <input type="checkbox" checked={form.agree} onChange={set("agree")} className="mt-0.5 accent-blue-700" />
          <span className="text-sm text-gray-500 leading-relaxed">
            Saya menyetujui{" "}
            <a href="#" className="text-blue-700 hover:underline">
              Syarat & Ketentuan
            </a>{" "}
            dan{" "}
            <a href="#" className="text-blue-700 hover:underline">
              Kebijakan Privasi
            </a>
          </span>
        </label>

        <button type="submit" className="h-11 bg-blue-700 hover:bg-blue-800 active:scale-[0.98] text-white font-medium rounded-lg text-sm transition-all">
          Buat Akun
        </button>
      </form>

      <div className="flex items-center gap-3 my-4">
        <div className="flex-1 h-px bg-gray-100" />
        <span className="text-xs text-gray-400">atau daftar dengan</span>
        <div className="flex-1 h-px bg-gray-100" />
      </div>

      <button className="flex items-center justify-center gap-2.5 h-11 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
        <GoogleIcon />
        Daftar dengan Google
      </button>
    </div>
  );
}

// ─── Main Auth Page ───────────────────────────────────────────────────────
export default function AuthPage() {
  const [mode, setMode] = useState("login"); // "login" | "register"
  const isLogin = mode === "login";

  return (
    <div className="min-h-screen bg-blue-50 flex items-center justify-center p-4">
      <div className="w-full max-w-3xl bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex min-h-130">
        {/* Side Panel */}
        {isLogin ? (
          <SidePanel bgColor="bg-blue-700" dotIndex={0} title="Selamat datang kembali!" description="Masuk ke akun Anda untuk melanjutkan dan mengakses semua fitur yang tersedia." />
        ) : (
          <SidePanel bgColor="bg-blue-900" dotIndex={1} title="Bergabung bersama kami hari ini" description="Buat akun gratis dan nikmati semua fitur platform kami tanpa batas waktu." />
        )}

        {/* Form Area */}
        {isLogin ? <LoginForm onSwitch={() => setMode("register")} /> : <RegisterForm onSwitch={() => setMode("login")} />}
      </div>
    </div>
  );
}
