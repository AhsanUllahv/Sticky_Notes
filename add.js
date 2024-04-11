document.addEventListener("DOMContentLoaded", function() {
    const noteDateInput = document.getElementById("note-date");
    const noteTimeInput = document.getElementById("note-time");
    const noteContentInput = document.getElementById("note-content");
    const addNoteButton = document.getElementById("add-note");

    addNoteButton.addEventListener("click", function() {
        const noteDate = noteDateInput.value;
        const noteTime = noteTimeInput.value;
        const noteContent = noteContentInput.value.trim();

        if (noteDate && noteTime && noteContent) {
            const noteDateTime = `${noteDate} ${noteTime}`;
            
            // Save note to Local Storage
            saveNoteToLocalStorage(noteDateTime, noteContent);
            
            alert("Note added successfully!");
            
            // Clear input fields
            noteDateInput.value = "";
            noteTimeInput.value = "";
            noteContentInput.value = "";
        } else {
            alert("Please enter date, time, and note content.");
        }
    });


        // Function to save note to Local Storage
    function saveNoteToLocalStorage(dateTime, content) {
    let notes = JSON.parse(localStorage.getItem("notes")) || [];
    // Check if notes is an array, if not, initialize it as an empty array
    if (!Array.isArray(notes)) {
        notes = [];
    }
    notes.push({ dateTime, content });
    localStorage.setItem("notes", JSON.stringify(notes));


    }


 // Add Button function
    document.getElementById("back-button").onclick = function () 
            {
                location.href = "index.html";
            };

});
