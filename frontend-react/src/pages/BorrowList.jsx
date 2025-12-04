import { useEffect, useState } from "react";
import axios from "../api/axios";

export default function BorrowList() {
  const [records, setRecords] = useState([]);

  // Get JWT token from localStorage
  const token = localStorage.getItem("token");

  // Create Axios instance with Authorization header
  axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  useEffect(() => {
    axios.get("/api/borrow")
      .then(res => setRecords(res.data))
      .catch(err => console.error("Failed to fetch borrow records:", err));
  }, []);

  return (
    <div className="container mt-4">
      <h3>Borrowed Books</h3>
      <table className="table table-bordered">
        <thead>
          <tr>
            <th>Book</th>
            <th>User</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          {records.map(r => (
            <tr key={r.id}>
              <td>{r.book?.title}</td>
              <td>{r.user?.name}</td>
              <td>{r.status}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
