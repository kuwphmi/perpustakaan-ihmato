function Home() {
  return (
    <div style={{ 
      fontFamily: "Arial", 
      textAlign: "center", 
      marginTop: "100px" 
    }}>
      
      <h1>📚 Perpustakaan IHMATO</h1>
      <p>Selamat datang di sistem informasi perpustakaan</p>

      <div style={{ marginTop: "20px" }}>
        <button style={{
          padding: "10px 20px",
          marginRight: "10px",
          backgroundColor: "#4CAF50",
          color: "white",
          border: "none",
          borderRadius: "5px",
          cursor: "pointer"
        }}>
          Login
        </button>

        <button style={{
          padding: "10px 20px",
          backgroundColor: "#2196F3",
          color: "white",
          border: "none",
          borderRadius: "5px",
          cursor: "pointer"
        }}>
          Lihat Buku
        </button>
      </div>

    </div>
  )
}

export default Home