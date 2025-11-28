import { useState } from "react";
import axios from "../api/axios";
import { useNavigate } from "react-router-dom";

export default function Login({ setLoggedIn }) {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [errors, setErrors] = useState("");
  const navigate = useNavigate();

  const login = async (e) => {
    e.preventDefault();
    setErrors(""); // reset errors

    try {
      // Get CSRF cookie first
      await axios.get("/sanctum/csrf-cookie");

      // Attempt login
      await axios.post("/api/login", { email, password });

      // Success: update logged in state and redirect
      setLoggedIn(true);
      navigate("/"); // redirect to home/dashboard
    } catch (err) {
      // Laravel returns validation errors in err.response.data.errors
      if (err.response) {
        if (err.response.status === 422) {
          // Validation errors
          const messages = Object.values(err.response.data.errors)
            .flat()
            .join(" ");
          setErrors(messages);
        } else if (err.response.status === 401) {
          // Wrong credentials
          setErrors("Incorrect email or password");
        } else {
          setErrors("Login failed. Please try again.");
        }
      } else {
        setErrors("Network error. Please try again.");
      }
    }
  };

  return (
    <div className="container mt-4 col-md-4">
      <h3>Login</h3>
      {errors && <div className="alert alert-danger">{errors}</div>}
      <form onSubmit={login}>
        <input
          type="email"
          className="form-control mb-2"
          placeholder="Email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          required
        />
        <input
          type="password"
          className="form-control mb-2"
          placeholder="Password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          required
        />
        <button className="btn btn-primary w-100">Login</button>
      </form>
    </div>
  );
}
