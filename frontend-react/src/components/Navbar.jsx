import { Link } from "react-router-dom";

export default function Navbar() {
  return (
    <nav className="navbar navbar-dark bg-dark px-3">
      <Link to="/" className="navbar-brand">
        Library
      </Link>
      <div>
        <Link className="btn btn-light me-2" to="/">
          Books
        </Link>
        <Link className="btn btn-light me-2" to="/add-book">
          Add Book
        </Link>
        <Link className="btn btn-light me-2" to="/dashboard">
          Dashboard
        </Link>

        <Link className="btn btn-light me-2" to="/borrow">
          Borrowed
        </Link>
        <Link className="btn btn-warning" to="/login">
          Login
        </Link>
        <Link className="btn btn-light me-2" to="/register">
          Register
        </Link>
      </div>
    </nav>
  );
}
