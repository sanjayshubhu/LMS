// public/js/mark-return.js

document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.mark-return');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const recordId = button.dataset.id;

            fetch(`/admin/books/${recordId}/return`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Replace button with return date
                    const returnDateSpan = document.createElement('span');
                    returnDateSpan.classList.add('return-date', 'text-gray-700');
                    returnDateSpan.textContent = data.return_date;

                    button.replaceWith(returnDateSpan);

                    const siblingText = returnDateSpan.parentElement.querySelector('.return-text');
                    if(siblingText) siblingText.remove();
                }
            })
            .catch(error => {
                alert('Something went wrong! Please try again.');
                console.error(error);
            });
        });
    });
});
