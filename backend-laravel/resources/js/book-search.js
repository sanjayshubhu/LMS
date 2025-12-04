document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document.querySelector("meta[name=csrf-token]").content;

    // Enable edit/save/delete using event delegation
    const adminContainer = document.getElementById("booksAdminContainer");

    function enableEdit(bookId) {
        const fields = ["title", "quantity", "author", "category", "isbn"];
        fields.forEach((field) => {
            const display = document.getElementById(
                `${field}-display-${bookId}`
            );
            const input = document.getElementById(`${field}-input-${bookId}`);
            if (display && input) {
                display.classList.add("hidden");
                input.classList.remove("hidden");
            }
        });
        const editBtn = document.getElementById(`edit-btn-${bookId}`);
        const saveBtn = document.getElementById(`save-btn-${bookId}`);
        if (editBtn && saveBtn) {
            editBtn.classList.add("hidden");
            saveBtn.classList.remove("hidden");
        }
    }

    function saveEdit(bookId) {
        const payload = {
            title: document.getElementById(`title-input-${bookId}`).value,
            quantity: document.getElementById(`quantity-input-${bookId}`).value,
            author: document.getElementById(`author-input-${bookId}`).value,
            category: document.getElementById(`category-input-${bookId}`).value,
            isbn: document.getElementById(`isbn-input-${bookId}`).value,
            _token: csrfToken,
        };

        fetch(`/books/${bookId}`, {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload),
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    const fields = [
                        "title",
                        "quantity",
                        "author",
                        "category",
                        "isbn",
                    ];
                    fields.forEach((field) => {
                        const display = document.getElementById(
                            `${field}-display-${bookId}`
                        );
                        const input = document.getElementById(
                            `${field}-input-${bookId}`
                        );
                        if (display && input) {
                            display.textContent = payload[field];
                            display.classList.remove("hidden");
                            input.classList.add("hidden");
                        }
                    });
                    document
                        .getElementById(`edit-btn-${bookId}`)
                        .classList.remove("hidden");
                    document
                        .getElementById(`save-btn-${bookId}`)
                        .classList.add("hidden");
                } else {
                    alert("Failed to update book.");
                }
            })
            .catch((err) => console.error("Save error:", err));
    }

    function confirmDelete(bookId) {
        const form = document.getElementById(`delete-form-${bookId}`);
        if (form && confirm("Are you sure you want to delete this book?")) {
            form.submit();
        }
    }

    if (adminContainer) {
        adminContainer.addEventListener("click", function (e) {
            const button = e.target.closest("button[data-action]");
            if (!button) return;
            const bookId = button.dataset.id;
            const action = button.dataset.action;

            if (action === "edit") enableEdit(bookId);
            if (action === "save") saveEdit(bookId);
            if (action === "delete") confirmDelete(bookId);
        });
    }

    // Live search for admin books
    const searchAdminInput = document.getElementById("searchBookAdmin");
    if (searchAdminInput) {
        searchAdminInput.addEventListener("keyup", function () {
            const query = searchAdminInput.value;
            fetch(`/books/admin/search?q=${encodeURIComponent(query)}`)
                .then((res) => res.json())
                .then((data) => {
                    adminContainer.innerHTML = renderAdminBooks(data);
                })
                .catch((err) => console.error("Fetch error:", err));
        });
    }

    function renderAdminBooks(data) {
        if (!data || data.length === 0)
            return `<p class="text-gray-500">No books found.</p>`;
        let html = `<div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ISBN</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead><tbody class="bg-white divide-y divide-gray-200">`;

        data.forEach((book) => {
            html += `<tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <span id="title-display-${book.id}">${book.title}</span>
                    <input type="text" id="title-input-${book.id}" value="${book.title}" class="border rounded px-2 py-1 w-full hidden">
                </td>
                <td class="px-6 py-4">
                    <span id="quantity-display-${book.id}">${book.quantity}</span>
                    <input type="number" id="quantity-input-${book.id}" value="${book.quantity}" class="border rounded px-2 py-1 w-full hidden">
                </td>
                <td class="px-6 py-4">
                    <span id="author-display-${book.id}">${book.author}</span>
                    <input type="text" id="author-input-${book.id}" value="${book.author}" class="border rounded px-2 py-1 w-full hidden">
                </td>
                <td class="px-6 py-4">
                    <span id="category-display-${book.id}">${book.category}</span>
                    <input type="text" id="category-input-${book.id}" value="${book.category}" class="border rounded px-2 py-1 w-full hidden">
                </td>
                <td class="px-6 py-4">
                    <span id="isbn-display-${book.id}">${book.isbn}</span>
                    <input type="text" id="isbn-input-${book.id}" value="${book.isbn}" class="border rounded px-2 py-1 w-full hidden">
                </td>
                <td class="px-6 py-4 flex space-x-2">
                    <button type="button" data-action="edit" data-id="${book.id}" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm font-medium">Edit</button>
                    <button type="button" data-action="save" data-id="${book.id}" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded text-sm font-medium hidden">Save</button>
                    <button type="button" data-action="delete" data-id="${book.id}" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm font-medium">Delete</button>
                    <form id="delete-form-${book.id}" action="/books/${book.id}" method="POST" class="hidden">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="${csrfToken}">
                    </form>
                </td>
            </tr>`;
        });

        html += `</tbody></table></div>`;
        return html;
    }
});
