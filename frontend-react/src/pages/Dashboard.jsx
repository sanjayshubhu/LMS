import { useEffect, useState } from "react";
import axios from "../api/axios";

export default function Dashboard() {
  const [books, setBooks] = useState([]);
  const [borrowed, setBorrowed] = useState([]);

  const token = localStorage.getItem("token"); // Get JWT token

  // Axios instance with Authorization header
  axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  useEffect(() => {
   axios
      .get("/api/books")
      .then((res) => setBooks(res.data))
      .catch((err) => console.error("Failed to fetch books:", err));

    axios
      .get("/api/borrow")
      .then((res) => setBorrowed(res.data))
      .catch((err) => console.error("Failed to fetch borrowed books:", err));
  }, []);

  return (
    <div className="container mt-4">
      <h3>Dashboard</h3>
      <p>Total Books: {books.length}</p>
      <p>
        Currently Borrowed:{" "}
        {borrowed.filter((b) => b.status === "borrowed").length}
      </p>
    </div>
  );
}
