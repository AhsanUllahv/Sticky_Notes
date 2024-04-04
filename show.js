document.addEventListener("DOMContentLoaded", function() {
    const notesContainer = document.getElementById("notes-container");

    // Function to load and display notes date-wise
    function loadAndDisplayNotes() {
        const notes = JSON.parse(localStorage.getItem("notes")) || [];
        notes.sort((a, b) => new Date(a.dateTime) - new Date(b.dateTime));
        notes.forEach(note => {
            const noteElement = document.createElement("div");
            noteElement.classList.add("note");
            noteElement.innerHTML = `<strong>${note.dateTime}</strong>: ${note.content}`;
            notesContainer.appendChild(noteElement);
        });
    }

    // Load and display notes when the page loads
    loadAndDisplayNotes();
});
