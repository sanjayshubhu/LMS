import { useState, useEffect } from "react";
import axios from "../api/axios.js";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  // Set token from localStorage on component mount
  useEffect(() => {
    const token = localStorage.getItem("token");
    if (token) {
      axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    }
  }, []);

  const login = async (e) => {
    e.preventDefault();
    try {
      const res = await axios.post("/api/login", { email, password });

      // Correct key from Laravel JWT response
      const token = res.data.access_token;

      if (!token) throw new Error("Token not received");

      // Store token in localStorage
      localStorage.setItem("token", token);

      // Set default Authorization header for all future requests
      axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

      // Fetch logged-in user
      const userRes = await axios.get("/api/me");
      console.log("Logged in user:", userRes.data);

      alert("Logged in successfully!");
    } catch (err) {
      console.error(err);
      alert("Login failed");
    }
  };

  return (
    <div className="container mt-4 col-md-4">
      <h3>Login</h3>
      <form onSubmit={login}>
        <input
          type="email"
          className="form-control mb-2"
          placeholder="Email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
        />
        <input
          type="password"
          className="form-control mb-2"
          placeholder="Password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
        />
        <button type="submit" className="btn btn-primary w-100">
          Login
        </button>
      </form>
    </div>
  );
}
