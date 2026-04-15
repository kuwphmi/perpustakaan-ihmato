function Login() {
  return (
    <div
      style={{
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        minHeight: "100vh",
        fontFamily: "Arial",
      }}
    >
      <div
        style={{
          width: "300px",
          textAlign: "center",
        }}
      >
        <h1>Sign in</h1>
        <p style={{ color: "gray" }}>
          Simplify your workflow in minutes.
        </p>

        <form onSubmit={(e) => e.preventDefault()}>
          {/* ID */}
          <div style={{ marginBottom: "15px", textAlign: "left" }}>
            <label>Npm / ID</label>
            <input
              type="text"
              placeholder="Masukkan NPM Anda"
              style={{
                width: "100%",
                padding: "10px",
                marginTop: "5px",
              }}
            />
          </div>

          {/* Password */}
          <div style={{ marginBottom: "15px", textAlign: "left" }}>
            <label>Password</label>
            <input
              type="password"
              placeholder="************"
              style={{
                width: "100%",
                padding: "10px",
                marginTop: "5px",
              }}
            />
          </div>

          {/* Button */}
          <button
            type="submit"
            style={{
              width: "100%",
              padding: "10px",
              backgroundColor: "#4CAF50",
              color: "white",
              border: "none",
              cursor: "pointer",
            }}
          >
            Masuk
          </button>
        </form>

        <p style={{ marginTop: "10px", fontSize: "14px" }}>
          Silahkan daftar jika belum, <a href="#">Daftar</a>
        </p>
      </div>
    </div>
  );
}

export default Login;