let selectedTrainerId = null;

document.querySelectorAll(".assign-btn").forEach(button => {
    button.addEventListener("click", function () {
        selectedTrainerId = this.getAttribute("data-trainerid");
        document.getElementById("popup").style.display = "block";
    });
});

document.querySelectorAll("#memberList li").forEach(member => {
    member.addEventListener("click", function () {
        const memberId = this.getAttribute("data-memberid");

        // Send assignment via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "assign_trainer_action.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (this.status == 200) {
                alert("Trainer assigned successfully!");
                location.reload();
            }
        };

        xhr.send(`trainer_id=${selectedTrainerId}&member_id=${memberId}`);
    });
});
