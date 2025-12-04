import { useState, useEffect } from "react";
import axios from "../api/axios"; // make sure baseURL is set to your backend API
import { useNavigate, useParams } from "react-router-dom";

export default function BookForm() {
  const [title, setTitle] = useState("");
  const [author, setAuthor] = useState("");
  const [category, setCategory] = useState("");
  const [isbn, setIsbn] = useState("");
  const [quantity, setQuantity] = useState(1);

  const navigate = useNavigate();
  const { id } = useParams(); // for editing

  // Get JWT token from localStorage
  const token = localStorage.getItem("token");

  // Create an Axios instance with Authorization header
  const authAxios = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  // Fetch book if editing
  useEffect(() => {
    if (id) {
      axios.get(`/api/books/${id}`).then(res => {
        const b = res.data;
        setTitle(b.title);
        setAuthor(b.author);
        setCategory(b.category);
        setIsbn(b.isbn);
        setQuantity(b.quantity);
      }).catch(err => {
        console.error("Failed to fetch book:", err);
      });
    }
  }, [id]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    const payload = { title, author, category, isbn, quantity };

    try {
      if (id) {
        await authAxios.put(`/books/${id}`, payload);
        alert("Book updated!");
      } else {
        await authAxios.post("/books", payload);
        alert("Book added!");
      }
      navigate("/");
    } catch (err) {
      console.error("Error saving book:", err.response || err);
      alert(err.response?.data?.message || "Failed to save book");
    }
  };

  return (
    <div className="container mt-4 col-md-6">
      <h3>{id ? "Edit" : "Add"} Book</h3>
      <form onSubmit={handleSubmit}>
        <input
          className="form-control mb-2"
          placeholder="Title"
          value={title}
          onChange={e => setTitle(e.target.value)}
        />
        <input
          className="form-control mb-2"
          placeholder="Author"
          value={author}
          onChange={e => setAuthor(e.target.value)}
        />
        <input
          className="form-control mb-2"
          placeholder="Category"
          value={category}
          onChange={e => setCategory(e.target.value)}
        />
        <input
          className="form-control mb-2"
          placeholder="ISBN"
          value={isbn}
          onChange={e => setIsbn(e.target.value)}
        />
        <input
          className="form-control mb-2"
          type="number"
          value={quantity}
          min={1}
          onChange={e => setQuantity(e.target.value)}
        />
        <button className="btn btn-success w-100">{id ? "Update" : "Add"} Book</button>
      </form>
    </div>
  );
}
