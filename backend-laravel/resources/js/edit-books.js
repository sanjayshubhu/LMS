import { showToast } from '../js/toastify';
window.showToast = showToast;

// Get CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

// Enable inline editing
window.enableEdit = function (id) {
    const fields = ["title", "quantity", "author", "category", "isbn"];
    fields.forEach(field => {
        document.getElementById(`${field}-display-${id}`).classList.add("hidden");
        document.getElementById(`${field}-input-${id}`).classList.remove("hidden");
    });

    document.getElementById(`edit-btn-${id}`).classList.add("hidden");
    document.getElementById(`save-btn-${id}`).classList.remove("hidden");
};

// Save edits via AJAX
window.saveEdit = async function (id) {
    const fields = ["title", "quantity", "author", "category", "isbn"];
    const data = {};

    fields.forEach(field => {
        data[field] = document.getElementById(`${field}-input-${id}`).value;
    });

    data._token = csrfToken;
    data._method = "PUT";

    try {
        const response = await fetch(`/books/${id}`, {
            method: "POST", // Laravel expects POST with _method=PUT
            headers: { "Accept": "application/json" },
            body: new URLSearchParams(data)
        });

        const result = await response.json();

        if (!response.ok) {
            // Laravel validation errors
            if (result.errors) {
                for (const field in result.errors) {
                    showToast(result.errors[field][0], 'error');
                }
            } else if (result.message) {
                showToast(result.message, 'error');
            } else {
                showToast('Failed to save changes!', 'error');
            }
            return;
        }

        // Success: update table
        fields.forEach(field => {
            const displayEl = document.getElementById(`${field}-display-${id}`);
            const inputEl = document.getElementById(`${field}-input-${id}`);
            displayEl.textContent = result[field];
            displayEl.classList.remove("hidden");
            inputEl.classList.add("hidden");
        });

        document.getElementById(`edit-btn-${id}`).classList.remove("hidden");
        document.getElementById(`save-btn-${id}`).classList.add("hidden");

        showToast('Book updated successfully!', 'success');
    } catch (error) {
        console.error(error);
        showToast('Server error: Could not save changes.', 'error');
    }
};

// Confirm delete using hidden form
window.confirmDelete = function (id) {
    if (confirm('Are you sure you want to delete this book?')) {
        document.getElementById(`delete-form-${id}`).submit();
    }


};
