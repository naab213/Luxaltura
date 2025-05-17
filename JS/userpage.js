let originalValues = {}; 
let isModified = false; 

function editField(id) {
    const input = document.getElementById(id);
    const cancelBtn = input.parentElement.querySelector('.cancel-btn');

    input.disabled = false;
    cancelBtn.classList.add('show'); 

    document.getElementById('submitBtn').style.display = "block";
}

function cancelEdit(id) {
    const input = document.getElementById(id);
    const cancelBtn = input.parentElement.querySelector('.cancel-btn');

    input.disabled = true;
    cancelBtn.classList.remove('show'); 

 
    const anyEditing = Array.from(document.querySelectorAll('.field input')).some(inp => !inp.disabled);

    if(!anyEditing){
        document.getElementById('submitBtn').style.display = "none";
    }
}


function toggleSubmitButton() {
    const submitBtn = document.getElementById("submitBtn");
    submitBtn.style.display = isModified ? "block" : "none";
}

function checkIfModified() {
    isModified = Object.keys(originalValues).some(fieldId => {
        const field = document.getElementById(fieldId);
        return field.value !== originalValues[fieldId];
    });

    toggleSubmitButton();
}

function edit(fieldId){
    const inputField = document.getElementById(fieldId);
    inputField.disabled = !inputField.disabled;
}

function updateForm(){
    const fields = {
        lastname: document.getElementById('lastname').value,
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        age: document.getElementById('age').value,
        password: document.getElementById('pw').value
    };

    fetch('update_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(fields)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Profile updated successfully!');
        } else {
            alert('Error updating profile: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the profile.');
    });

    const inputFields = document.querySelectorAll('input');
    inputFields.forEach(field => field.disabled = true);
}

function logout(){
    fetch('logout.php', { method: 'POST' })
        .then(() => {
            window.location.href = 'sign_in.php';
        })
        .catch(error => {
            console.error('Error during logout:', error);
        });
}

document.getElementById('profileForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const data = {
        lastname: document.getElementById('lastname').value,
        name: document.getElementById('name').value,
        age: document.getElementById('age').value,
        email: document.getElementById('email').value,
        pw: document.getElementById('pw').value
    };

    const response = await fetch('update_profile.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    });

    const result = await response.json();

    if (result.success) {
        alert('Profil upadte !');
        // Optionnel : désactive les champs à nouveau
        document.querySelectorAll('#profileForm input').forEach(input => input.disabled = true);
    } else {
        alert('error : ' + result.error);
        // Optionnel : recharger les anciennes valeurs si besoin
        window.location.reload();
    }
});
