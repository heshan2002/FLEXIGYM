document.addEventListener("DOMContentLoaded", function () {
    // Select all Assign buttons
    const assignButtons = document.querySelectorAll(".assign-btn");
    const popup = document.getElementById("popup");

    assignButtons.forEach(button => {
        button.addEventListener("click", function () {
            popup.style.display = "block";
        });
    });

    // Close popup on clicking outside
    window.addEventListener("click", function (event) {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });

    // Delete button functionality
    const deleteButtons = document.querySelectorAll(".delete-btn");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            this.closest("tr").remove(); // Removes the trainer row
        });
    });

    // Add member button inside popup
    const addButtons = document.querySelectorAll(".add-btn");
    addButtons.forEach(button => {
        button.addEventListener("click", function () {
            alert("Member Assigned!");
            popup.style.display = "none";
        });
    });
});
