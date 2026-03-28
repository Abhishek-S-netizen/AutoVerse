function updateClock() {
    const now = new Date();
    const time = now.toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
    }).toUpperCase();
    document.getElementById("clock").innerText = time;
}

setInterval(updateClock, 1000);
updateClock();

function confirmDelete() {
    return confirm("Are you sure you want to delete this car? This is deletion is permanent and cannot be undone");
}