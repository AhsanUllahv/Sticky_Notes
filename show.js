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

            // Create a delete button for each note and append it to the end of the note box
            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Delete";
            deleteButton.classList.add("delete-button"); // Add a class to style delete buttons in CSS
            deleteButton.addEventListener("click", () => {
                deleteNoteFromStorage(note);
                noteElement.remove();
            });
            noteElement.appendChild(deleteButton);
        });
    }

    // Function to delete a note from storage
    function deleteNoteFromStorage(noteToDelete) {
        const notes = JSON.parse(localStorage.getItem("notes")) || [];
        const updatedNotes = notes.filter(note => note !== noteToDelete);
        localStorage.setItem("notes", JSON.stringify(updatedNotes));
    }

    // Function to filter notes by date
    function filterNotesByDate() {
        const selectedDate = document.getElementById("filter-date").value;
        const notes = document.getElementsByClassName("note");
        Array.from(notes).forEach(note => {
            const noteDate = note.querySelector("strong").textContent;
            if (selectedDate !== "" && noteDate !== selectedDate) {
                note.style.display = "none";
            } else {
                note.style.display = "block";
            }
        });
    }

    // Load and display notes when the page loads
    loadAndDisplayNotes();

    // Add event listener to the filter button
    document.getElementById("filter-button").addEventListener("click", filterNotesByDate);

    // Function to delete all notes
    document.getElementById("delete-all-notes").addEventListener("click", () => {
        localStorage.removeItem("notes");
        notesContainer.innerHTML = ""; // Clear the notes container
    });

    // Add Button function
    document.getElementById("back-button").onclick = function () {
        location.href = "index.html";
    };
});
