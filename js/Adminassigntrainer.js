document.addEventListener("DOMContentLoaded", function () {
    loadTrainers();
    loadMembers();

    function loadTrainers() {
        fetch("php/get_trainers.php")
            .then(response => response.json())
            .then(data => {
                let trainerTable = document.querySelector("tbody");
                trainerTable.innerHTML = "";
                data.forEach(trainer => {
                    let row = `<tr>
                        <td><span class="status ${trainer.availability ? 'green' : 'red'}"></span></td>
                        <td>${trainer.name}</td>
                        <td>${trainer.email}</td>
                        <td>${trainer.specialty}</td>
                        <td><button class="delete-btn" data-id="${trainer.trainer_id}">DELETE</button></td>
                        <td><button class="assign-btn" data-id="${trainer.trainer_id}">ASSIGN</button></td>
                    </tr>`;
                    trainerTable.innerHTML += row;
                });
                setupEventListeners();
            });
    }

    function loadMembers() {
        fetch("php/get_members.php")
            .then(response => response.json())
            .then(data => {
                let memberList = document.querySelector(".popup-content ul");
                memberList.innerHTML = "";
                data.forEach(member => {
                    let item = `<li>${member.name} <button class="add-btn" data-id="${member.member_id}">ADD</button></li>`;
                    memberList.innerHTML += item;
                });
                setupAssignEventListeners();
            });
    }

    function setupEventListeners() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                let trainerId = this.getAttribute("data-id");
    
                console.log("Deleting trainer with ID:", trainerId); // Debugging
    
                fetch("php/delete_trainer.php", {
                    method: "POST",
                    body: new URLSearchParams({ trainer_id: trainerId }),
                    headers: { "Content-Type": "application/x-www-form-urlencoded" }
                })
                .then(response => response.text())
                .then(data => {
                    console.log("Response from server:", data); // Debugging
    
                    if (data.trim() === "success") {
                        alert("Trainer deleted successfully!");
                        loadTrainers(); // Refresh trainer list
                    } else {
                        alert("Error deleting trainer: " + data);
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });

        document.querySelectorAll(".assign-btn").forEach(button => {
            button.addEventListener("click", function () {
                document.getElementById("popup").style.display = "block";
                let trainerId = this.getAttribute("data-id");
                document.querySelectorAll(".add-btn").forEach(addBtn => {
                    addBtn.addEventListener("click", function () {
                        let memberId = this.getAttribute("data-id");
                        fetch("php/assign_trainer.php", {
                            method: "POST",
                            body: new URLSearchParams({ member_id: memberId, trainer_id: trainerId }),
                            headers: { "Content-Type": "application/x-www-form-urlencoded" }
                        }).then(response => response.text()).then(data => {
                            if (data === "success") {
                                document.getElementById("popup").style.display = "none";
                                loadTrainers();
                                loadMembers();
                            }
                        });
                    });
                });
            });
        });
    }
});
