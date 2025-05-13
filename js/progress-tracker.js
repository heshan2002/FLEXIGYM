document.addEventListener('DOMContentLoaded', function() {
    // Initialize the 3D Avatar
    initAvatar();

    // Upload photo button functionality
    document.getElementById('uploadBtn').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    document.getElementById('fileInput').addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            // Process the uploaded image
            console.log('File uploaded:', file.name);
            // Here you would typically upload the file to a server
            // For now, we'll just add a new entry with the file
            addNewProgressEntry(file);
        }
    });

    // Update progress button functionality
    document.getElementById('updateProgress').addEventListener('click', function() {
        const weight = document.getElementById('weightInput').value;
        const muscleMass = document.getElementById('muscleMassInput').value;
        const bodyFat = document.getElementById('bodyFatInput').value;
        const notes = document.getElementById('notesInput').value;

        if (weight && muscleMass && bodyFat) {
            // Update the current stats
            document.getElementById('currentWeight').textContent = weight + ' kg';
            document.getElementById('currentBodyFat').textContent = bodyFat + '%';
            
            // Clear the form
            document.getElementById('weightInput').value = '';
            document.getElementById('muscleMassInput').value = '';
            document.getElementById('bodyFatInput').value = '';
            document.getElementById('notesInput').value = '';

            // Update avatar based on new measurements
            updateAvatarMeasurements(weight, bodyFat, muscleMass);

            alert('Progress updated successfully!');
        } else {
            alert('Please fill in all measurement fields.');
        }
    });

    // Add event listeners to edit and delete buttons
    setupEventListeners();
});

function setupEventListeners() {
    // Add event listeners to all edit buttons
    document.querySelectorAll('.edit-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const entry = this.closest('.entry');
            // Implementation for editing entry would go here
            console.log('Edit entry');
        });
    });

    // Add event listeners to all delete buttons
    document.querySelectorAll('.delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const entry = this.closest('.entry');
            if (confirm('Are you sure you want to delete this progress entry?')) {
                entry.remove();
                console.log('Entry deleted');
            }
        });
    });
}

function addNewProgressEntry(file) {
    const today = new Date();
    const dateString = today.toISOString().split('T')[0];
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const template = `
        <div class="entry">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>${dateString}</h5>
                    <div>
                        <button class="btn btn-sm btn-outline-primary edit-btn">✏️</button>
                        <button class="btn btn-sm btn-outline-danger delete-btn">🗑️</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="${e.target.result}" alt="Progress Image" class="img-fluid rounded">
                        </div>
                        <div class="col-md-6">
                            <p><strong>Stats:</strong></p>
                            <ul class="list-unstyled">
                                <li>Weight: ${document.getElementById('weightInput').value || '??'} kg</li>
                                <li>Muscle Mass: ${document.getElementById('muscleMassInput').value || '??'} kg</li>
                                <li>Body Fat: ${document.getElementById('bodyFatInput').value || '??'}%</li>
                            </ul>
                            <p class="mt-3"><strong>Notes:</strong></p>
                            <p>${document.getElementById('notesInput').value || 'No notes added.'}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        
        const progressEntries = document.getElementById('progressEntries');
        progressEntries.insertAdjacentHTML('afterbegin', template);
        
        // Update event listeners for the new buttons
        setupEventListeners();
    };
    
    reader.readAsDataURL(file);
}

// 3D Avatar Functions

function initAvatar() {
    const canvas = document.getElementById('avatarCanvas');
    
    if (!canvas) {
        console.error('Canvas element not found!');
        return;
    }

    // Ensure the canvas fills its container
    function resizeCanvas() {
        const container = canvas.parentElement;
        canvas.style.width = container.clientWidth + 'px';
        canvas.style.height = container.clientHeight + 'px';
        drawPlaceholderAvatar(canvas.getContext('2d'));
    }

    // Check if browser supports WebGL
    if (!window.WebGLRenderingContext) {
        console.error('WebGL not supported');
        showFallbackAvatar();
        return;
    }

    try {
        const ctx = canvas.getContext('2d');
        
        // Draw initial avatar
        drawPlaceholderAvatar(ctx);
        
        // Handle window resize
        window.addEventListener('resize', resizeCanvas);
        
        // Set up avatar control buttons
        setupAvatarControls();
        
        console.log('3D Avatar initialized');
    } catch (error) {
        console.error('Error initializing avatar:', error);
        showFallbackAvatar();
    }
}

function drawPlaceholderAvatar(ctx, width, height) {
    // Set canvas dimensions with proper scaling
    const dpr = window.devicePixelRatio || 1;
    const rect = ctx.canvas.getBoundingClientRect();
    
    ctx.canvas.width = rect.width * dpr;
    ctx.canvas.height = rect.height * dpr;
    ctx.scale(dpr, dpr);
    
    // Background gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, rect.height);
    gradient.addColorStop(0, "#f8f9ff");
    gradient.addColorStop(1, "#eef1fa");
    ctx.fillStyle = gradient;
    ctx.fillRect(0, 0, rect.width, rect.height);
    
    // Create a more visually appealing avatar
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    
    // Draw shadow
    ctx.beginPath();
    ctx.ellipse(centerX, rect.height * 0.85, rect.width * 0.2, 10, 0, 0, Math.PI * 2);
    ctx.fillStyle = 'rgba(0, 0, 0, 0.1)';
    ctx.fill();
    
    // Draw legs
    const legWidth = rect.width * 0.06;
    const legHeight = rect.height * 0.25;
    const legSpacing = rect.width * 0.06;
    
    // Left leg
    ctx.fillStyle = '#233EDE';
    ctx.beginPath();
    ctx.roundRect(centerX - legSpacing - legWidth/2, centerY + rect.height * 0.1, legWidth, legHeight, [0, 0, 10, 10]);
    ctx.fill();
    
    // Right leg
    ctx.beginPath();
    ctx.roundRect(centerX + legSpacing - legWidth/2, centerY + rect.height * 0.1, legWidth, legHeight, [0, 0, 10, 10]);
    ctx.fill();
    
    // Body
    ctx.fillStyle = '#233EDE';
    ctx.beginPath();
    ctx.roundRect(centerX - rect.width * 0.15, centerY - rect.height * 0.15, rect.width * 0.3, rect.height * 0.25, 10);
    ctx.fill();
    
    // Arms
    const armWidth = rect.width * 0.05;
    const armHeight = rect.height * 0.18;
    const armOffset = rect.width * 0.17;
    
    // Left arm
    ctx.save();
    ctx.translate(centerX - armOffset, centerY - rect.height * 0.05);
    ctx.rotate(-Math.PI / 16);
    ctx.beginPath();
    ctx.roundRect(-armWidth/2, 0, armWidth, armHeight, [5, 5, 5, 5]);
    ctx.fill();
    ctx.restore();
    
    // Right arm
    ctx.save();
    ctx.translate(centerX + armOffset, centerY - rect.height * 0.05);
    ctx.rotate(Math.PI / 16);
    ctx.beginPath();
    ctx.roundRect(-armWidth/2, 0, armWidth, armHeight, [5, 5, 5, 5]);
    ctx.fill();
    ctx.restore();
    
    // Neck
    ctx.fillStyle = '#233EDE';
    ctx.beginPath();
    ctx.roundRect(centerX - rect.width * 0.04, centerY - rect.height * 0.22, rect.width * 0.08, rect.height * 0.07, 5);
    ctx.fill();
    
    // Head
    ctx.fillStyle = '#233EDE';
    ctx.beginPath();
    ctx.arc(centerX, centerY - rect.height * 0.3, rect.width * 0.1, 0, Math.PI * 2);
    ctx.fill();
    
    // Details on body (fitness logo)
    ctx.fillStyle = 'white';
    ctx.font = 'bold 20px Arial';
    ctx.textAlign = 'center';
    ctx.fillText('F', centerX, centerY);
    
    // Text label with shadow
    ctx.shadowColor = 'rgba(0, 0, 0, 0.3)';
    ctx.shadowBlur = 5;
    ctx.shadowOffsetY = 2;
    ctx.font = 'bold 16px Arial';
    ctx.fillStyle = '#233EDE';
    ctx.fillText('FLEXIGYM AVATAR', centerX, rect.height * 0.15);
    ctx.shadowBlur = 0;
    
    ctx.font = '14px Arial';
    ctx.fillStyle = '#666';
    ctx.fillText('Update measurements to see changes', centerX, rect.height * 0.92);
}

function showFallbackAvatar() {
    const canvas = document.getElementById('avatarCanvas');
    const ctx = canvas.getContext('2d');
    
    ctx.fillStyle = '#f2f2f2';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    ctx.fillStyle = '#333';
    ctx.font = '16px Arial';
    ctx.textAlign = 'center';
    ctx.fillText('3D Avatar not available', canvas.width / 2, canvas.height / 2);
    ctx.fillText('Please update your browser', canvas.width / 2, canvas.height / 2 + 30);
}

function setupAvatarControls() {
    document.getElementById('rotateLeft').addEventListener('click', function() {
        console.log('Rotate avatar left');
        // In a real implementation, this would rotate the 3D model
    });
    
    document.getElementById('viewFront').addEventListener('click', function() {
        console.log('View front');
        // In a real implementation, this would show the front view
    });
    
    document.getElementById('viewSide').addEventListener('click', function() {
        console.log('View side');
        // In a real implementation, this would show the side view
    });
    
    document.getElementById('viewBack').addEventListener('click', function() {
        console.log('View back');
        // In a real implementation, this would show the back view
    });
    
    document.getElementById('avatarViewSwitch').addEventListener('change', function() {
        if (this.checked) {
            console.log('Switch to 3D view');
            // In a real implementation, this would switch between 2D/3D views
        } else {
            console.log('Switch to 2D view');
        }
    });
}

function updateAvatarMeasurements(weight, bodyFat, muscleMass) {
    console.log('Updating avatar with new measurements:', weight, bodyFat, muscleMass);
    
    // For demonstration, let's redraw the avatar with slight modifications based on measurements
    const canvas = document.getElementById('avatarCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    
    // Parse input values to numbers
    weight = parseFloat(weight);
    bodyFat = parseFloat(bodyFat);
    muscleMass = parseFloat(muscleMass);
    
    // Calculate avatar body proportions based on measurements
    // Higher muscle mass = broader shoulders, thicker arms
    // Higher body fat = wider waist
    // This is a simplified example
    
    // Clear canvas and redraw with new proportions
    drawPlaceholderAvatar(ctx, canvas.width, canvas.height);
    
    // Update metrics with calculated values
    const metrics = document.querySelectorAll('.avatar-metrics .metric-value');
    
    // Calculate mock measurements based on the input values with improved formulas
    const chest = (40 + (muscleMass / 8) - (bodyFat / 20)).toFixed(1) + ' in';
    const waist = (32 + (bodyFat / 3) - (muscleMass / 20)).toFixed(1) + ' in';
    const hips = (38 + (bodyFat / 8)).toFixed(1) + ' in';
    const arms = (13 + (muscleMass / 10) - (bodyFat / 30)).toFixed(1) + ' in';
    
    if (metrics.length >= 4) {
        metrics[0].textContent = chest;
        metrics[1].textContent = waist;
        metrics[2].textContent = hips;
        metrics[3].textContent = arms;
    }
    
    // Add animation effect when measurements update
    const avatarContainer = document.querySelector('.avatar-container');
    avatarContainer.style.transform = 'scale(1.02)';
    setTimeout(() => {
        avatarContainer.style.transform = 'scale(1)';
    }, 300);
}
