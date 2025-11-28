import { useEffect, useState } from "react";
import axios from "../api/axios";

export default function Dashboard() {
  const [books, setBooks] = useState([]);
  const [borrowed, setBorrowed] = useState([]);

  useEffect(()=>{
    axios.get("/api/books").then(res=>setBooks(res.data));
    axios.get("/api/borrow").then(res=>setBorrowed(res.data));
  },[]);

  return (
    <div className="container mt-4">
      <h3>Dashboard</h3>
      <p>Total Books: {books.length}</p>
      <p>Currently Borrowed: {borrowed.filter(b=>b.status==="borrowed").length}</p>
    </div>
  );
}
