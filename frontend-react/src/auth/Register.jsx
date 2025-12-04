import { useState } from "react";
import axios from "../api/axios";

export default function Register() {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");

  const handleRegister = async (e) => {
    e.preventDefault();
    setError(""); setSuccess("");

    try {
      await axios.post("/api/register", { name, email, password });
      setSuccess("Registration successful! You can log in.");
      setName(""); setEmail(""); setPassword("");
    } catch (err) {
      const messages = err.response?.data?.errors
        ? Object.values(err.response.data.errors).flat().join(" ")
        : err.response?.data?.message || "Registration failed";
      setError(messages);
    }
  };

  return (
    <div className="container mt-4 col-md-4">
      <h3>Register</h3>
      {error && <div className="alert alert-danger">{error}</div>}
      {success && <div className="alert alert-success">{success}</div>}
      <form onSubmit={handleRegister}>
        <input className="form-control mb-2" placeholder="Name" value={name} onChange={e=>setName(e.target.value)} />
        <input className="form-control mb-2" placeholder="Email" value={email} onChange={e=>setEmail(e.target.value)} />
        <input type="password" className="form-control mb-2" placeholder="Password" value={password} onChange={e=>setPassword(e.target.value)} />
        <button className="btn btn-success w-100">Register</button>
      </form>
    </div>
  );
}
