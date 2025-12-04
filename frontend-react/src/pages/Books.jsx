import { useEffect, useState } from "react";
import axios from "../api/axios";

export default function Books() {
  const [books, setBooks] = useState([]);

  useEffect(() => {
    const fetchBooks = async () => {
      try {
        const token = localStorage.getItem("token"); // JWT stored after login
        const res = await axios.get("/api/books", {
          headers: { Authorization: `Bearer ${token}` }
        });
        setBooks(res.data);
      } catch (err) {
        console.error("Failed to fetch books:", err);
      }
    };

    fetchBooks();
  }, []);

  return (
    <div className="container mt-4">
      <h3>Books</h3>
      <table className="table table-bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Qty</th>
          </tr>
        </thead>
        <tbody>
          {books.map(b => (
            <tr key={b.id}>
              <td>{b.title}</td>
              <td>{b.author}</td>
              <td>{b.quantity}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
