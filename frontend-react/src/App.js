import { BrowserRouter, Routes, Route } from "react-router-dom";
import { useState } from "react";
import Navbar from "./components/Navbar";
import Login from "./auth/Login";
import Register from "./auth/Register";
import Books from "./pages/Books";
import BorrowList from "./pages/BorrowList";
import ProtectedRoute from "./components/ProtectedRoute";
import Dashboard from "./pages/Dashboard";
import BookForm from "./pages/Booksform";
function App() {
  const [isLoggedIn, setLoggedIn] = useState(false);
  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route
          path="/"
          element={
            <ProtectedRoute isLoggedIn={isLoggedIn}>
              <Books />
            </ProtectedRoute>
          }
        />
        <Route
          path="/borrow"
          element={
            <ProtectedRoute isLoggedIn={isLoggedIn}>
              <BorrowList />
            </ProtectedRoute>
          }
        />
        <Route
          path="/add-book"
          element={
            <ProtectedRoute isLoggedIn={isLoggedIn}>
              <BookForm />
            </ProtectedRoute>
          }
        />
        <Route
          path="/edit-book/:id"
          element={
            <ProtectedRoute isLoggedIn={isLoggedIn}>
              <BookForm />
            </ProtectedRoute>
          }
        />
        <Route
          path="/dashboard"
          element={
            <ProtectedRoute isLoggedIn={isLoggedIn}>
              <Dashboard />
            </ProtectedRoute>
          }
        />
        <Route path="/login" element={<Login setLoggedIn={setLoggedIn} />} />

        <Route path="/register" element={<Register />} />
      </Routes>
    </BrowserRouter>
  );
}
export default App;
