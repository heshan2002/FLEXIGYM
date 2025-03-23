// Open Popup
function openPopup() {
    document.getElementById("popup").style.display = "block";
}

// Close popup while send Message
function closePopup() {
    document.getElementById("popup").style.display = "none";
}

// Send Message 
function sendMessage() {
    let message = document.getElementById("reply-message").value;
    if (message.trim() === "") {
        alert("Please enter a message!");
        return;
    }
    alert("Message sent: " + message);
    closePopup();
}
