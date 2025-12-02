
export function showToast(message, type = 'success', duration = 3000) {
    const colors = {
        success: "linear-gradient(to right, #00b09b, #96c93d)",
        error: "linear-gradient(to right, #ff5f6d, #ffc371)",
        info: "linear-gradient(to right, #2196F3, #21CBF3)",
        warning: "linear-gradient(to right, #FF9800, #FFC107)"
    };

    Toastify({
        text: message,
        duration: duration,
        gravity: "top",
        position: "right",
        backgroundColor: colors[type] || colors.info,
    }).showToast();
}
