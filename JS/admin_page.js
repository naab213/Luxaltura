function cancelUser(button) {
    const row = button.closest('tr');
    const nom = row.children[0].textContent;
    const prenom = row.children[1].textContent;

    if (confirm(`Voulez-vous vraiment supprimer l'utilisateur ${prenom} ${nom} ?`)) {
        row.remove();
        alert("Utilisateur supprimé.");
    }
}

function createCell(content, isUpdating) {
    const td = document.createElement('td');
    if (isUpdating) {
        td.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        td.style.backgroundColor = '#e0e0e0';
        td.style.textAlign = 'center';
    } else {
        td.textContent = content;
    }
    return td;
}

function loadUsers() {
    fetch('refresh_users.php')
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error('Erreur :', data.error);
                return;
            }

            const tbody = document.getElementById('userTableBody');
            tbody.innerHTML = '';

            const now = Math.floor(Date.now() / 1000);

            data.users.forEach(user => {
                const row = document.createElement('tr');

                const updatedRecently = (now - user.last_updated < 5);

                if (updatedRecently) {
                    row.style.backgroundColor = '#e0e0e0';
                } else {
                    row.style.backgroundColor = '';
                }

                row.appendChild(createCell(user.lastname, updatedRecently));
                row.appendChild(createCell(user.name, updatedRecently));
                row.appendChild(createCell(user.email, updatedRecently));
                row.appendChild(createCell(user.age, updatedRecently));

                const actionTd = document.createElement('td');
                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = 'Supprimer';
                deleteBtn.onclick = () => cancelUser(deleteBtn);
                actionTd.appendChild(deleteBtn);
                row.appendChild(actionTd);

                tbody.appendChild(row);
            });
        })
        .catch(err => console.error('Fetch error:', err));
}

setInterval(loadUsers, 5000);
document.addEventListener('DOMContentLoaded', loadUsers);
