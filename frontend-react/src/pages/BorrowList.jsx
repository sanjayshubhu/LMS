import { useEffect, useState } from "react";
import axios from "../api/axios";

export default function BorrowList() {
  const [records, setRecords] = useState([]);

  useEffect(() => {
    axios.get("/api/borrow").then(res => setRecords(res.data));
  }, []);

  return (
    <div className="container mt-4">
      <h3>Borrowed Books</h3>
      <table className="table table-bordered">
        <thead>
          <tr><th>Book</th><th>User</th><th>Status</th></tr>
        </thead>
        <tbody>
          {records.map(r => (
            <tr key={r.id}>
              <td>{r.book.title}</td>
              <td>{r.user.name}</td>
              <td>{r.status}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
