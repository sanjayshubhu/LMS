import { useState, useEffect } from "react";
import axios from "../api/axios";
import { useNavigate, useParams } from "react-router-dom";

export default function BookForm() {
  const [title, setTitle] = useState("");
  const [author, setAuthor] = useState("");
  const [category, setCategory] = useState("");
  const [isbn, setIsbn] = useState("");
  const [quantity, setQuantity] = useState(1);

  const navigate = useNavigate();
  const { id } = useParams(); // For edit

  useEffect(() => {
    if (id) {
      axios.get(`/api/books/${id}`).then(res => {
        const b = res.data;
        setTitle(b.title);
        setAuthor(b.author);
        setCategory(b.category);
        setIsbn(b.isbn);
        setQuantity(b.quantity);
      });
    }
  }, [id]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    const payload = { title, author, category, isbn, quantity };

    if (id) {
      await axios.put(`/api/books/${id}`, payload);
      alert("Book updated!");
    } else {
      await axios.post("/api/books", payload);
      alert("Book added!");
    }
    navigate("/");
  };

  return (
    <div className="container mt-4 col-md-6">
      <h3>{id ? "Edit" : "Add"} Book</h3>
      <form onSubmit={handleSubmit}>
        {["Title","Author","Category","ISBN"].map((field,i)=>(
          <input key={i} className="form-control mb-2"
                 placeholder={field} 
                 value={{Title:title,Author:author,Category:category,ISBN:isbn}[field]}
                 onChange={e=>{if(field==="Title") setTitle(e.target.value)
                               else if(field==="Author") setAuthor(e.target.value)
                               else if(field==="Category") setCategory(e.target.value)
                               else setIsbn(e.target.value)}} />
        ))}
        <input className="form-control mb-2" type="number" value={quantity} min={1} onChange={e=>setQuantity(e.target.value)} />
        <button className="btn btn-success w-100">{id?"Update":"Add"} Book</button>
      </form>
    </div>
  );
}
