const originalValues = {};

function editField(fieldId) {
    const field = document.getElementById(fieldId);
    if (!originalValues[fieldId]) {
        originalValues[fieldId] = field.value;
    }

    field.disabled = false;
    field.classList.add('editable');

    const val = field.value;
    field.focus();
    field.value = '';
    field.value = val;

    const cancelBtn = field.parentElement.querySelector('.cancel-btn');
    if (cancelBtn) cancelBtn.style.display = 'inline-block';
}

function cancelEdit(fieldId) {
    const field = document.getElementById(fieldId);
    field.value = originalValues[fieldId] || field.value;
    field.disabled = true;
    field.classList.remove('editable');

    const cancelBtn = field.parentElement.querySelector('.cancel-btn');
    if (cancelBtn) cancelBtn.style.display = 'none';

    delete originalValues[fieldId];
}

document.getElementById('profileForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const fields = {
        lastname: document.getElementById('lastname'),
        name: document.getElementById('name'),
        age: document.getElementById('age'),
        email: document.getElementById('email'),
        pw: document.getElementById('pw')
    };

    Object.values(fields).forEach(field => {
        field.disabled = true;
        field.classList.add('loading');
    });

    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';

    const dataToSend = {
        lastname: fields.lastname.value,
        name: fields.name.value,
        age: fields.age.value,
        email: fields.email.value,
        pw: fields.pw.value
    };

    try {
        const response = await fetch('update_profile.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dataToSend)
        });

        const result = await response.json();

        if (result.success) {
            alert('Profil mis à jour !');
            Object.values(fields).forEach(field => {
                field.classList.remove('loading');
                field.disabled = true;
            });
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Update';
            fields.pw.value = '';
        } else {
            alert('Erreur : ' + result.error);
            window.location.reload();
        }
    } catch (err) {
        console.error('Erreur:', err);
        alert('Erreur lors de la mise à jour.');
        window.location.reload();
    }
});

function logout() {
    if (confirm("Voulez-vous vraiment vous déconnecter ?")) {
        window.location.href = "logout.php";
    }
}
