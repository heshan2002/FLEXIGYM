<?php
require("php/database.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="css/SignUp.css">
</head>
<body class="user-signup">
    <div class="signup-container">
        <form action="php/register.php" method="post">
            <h2 class="signup-title">Create Account</h2>

            <h3 class="signup-section-title">-- Personal Details --</h3>
            <div class="signup-row">
                <div class="signup-column">
                    <label for="full_name">Full Name *</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Full Name" required>
                </div>

                <div class="signup-column">
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
            </div>

            <div class="signup-row">
                <div class="signup-column">
                    <label for="phone">Phone Number *</label>
                    <input type="text" name="phone" id="phone" placeholder="Phone Number" required>
                </div>

                <div class="signup-column">
                    <label for="password">Password *</label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
            </div>

            <div class="signup-row">
                <div class="signup-column">
                    <label for="dob">Date of Birth *</label>
                    <input type="date" name="dob" id="dob" required>
                </div>

                <div class="signup-column">
                    <label for="gender" >Gender *</label>
                    <select name="gender" id="gender" required>
                        <option value="">--select--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>

            <h3 class="signup-section-title">-- Fitness Details --</h3>
            <div class="signup-row">
                <div class="signup-column">
                    <label for="height">Height (cm) *</label>
                    <input type="number" name="height" id="height" placeholder="Height (cm)" required>
                </div>
                <div class="signup-column">
                    <label for="weight">Weight (kg) *</label>
                    <input type="number" name="weight" id="weight" placeholder="Weight (kg)" required>
                </div>
            </div>

            <div class="signup-row">
                <div class="signup-column">
                    <label for="body_fat">Body Fat Percentage *</label>
                    <input type="number" name="body_fat" id="body_fat" placeholder="Body Fat (%)" required>
                </div>
                <div class="signup-column">
                    <label for="muscle_mass">Muscle Mass (%) *</label>
                    <input type="number" name="muscle_mass" id="muscle_mass" placeholder="Muscle Mass (%)" required>
                </div>
            </div>

            <div class="signup-row">
                <div class="signup-column">
                    <label for="fitness_level">Current Fitness Level *</label>
                    <select name="fitness_level" id="fitness_level" required>
                        <option value="">--select--</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
                
                    <div class="signup-column">
                        <label for="fitness_goal">Fitness Goal *</label>
                        <select name="fitness_goal" id="fitness_goal" required>
                            <option value="">--select--</option>
                            <option value="Weight Loss">Weight Loss</option>
                            <option value="Muscle Gain">Muscle Gain</option>
                            <option value="Strength">Strength</option>
                            <option value="General Fitness">General Fitness</option>
                        </select>
                    </div>
                
                
                <div class="signup-column">
                    <label for="workout_time">Preferred Workout Time *</label>
                    <select name="workout_time" id="workout_time" required>
                        <option value="">--select--</option>
                        <option value="Morning">Morning</option>
                        <option value="Afternoon">Afternoon</option>
                        <option value="Evening">Evening</option>
                    </select>
                </div>
            </div>

            <div class="signup-row">
                <div class="signup-column">
                    <label for="equipment_available">Equipment Availability *</label>
                    <select name="equipment_available" id="equipment_available" required>
                        <option value="">--select--</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="signup-column">
                    <label for="trainer_preference">Trainer Preference *</label>
                    <select name="trainer_preference" id="trainer_preference" required>
                        <option value="">--select--</option>
                        <option value="Male Trainer">Male Trainer</option>
                        <option value="Female Trainer">Female Trainer</option>
                        <option value="Any">No Preference</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="signup-submit-button"  name="sign_up">Sign Up</button>
            <p class="signup-login-link">Already have an account? <a href="Login.php">Log In</a></p>
        </form>
    </div>
</body>
</html>
