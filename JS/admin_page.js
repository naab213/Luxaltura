function simulateUpdate(button) {
    const row = button.closest('tr');
    row.style.backgroundColor = '#ccc';
    button.disabled = true;

    setTimeout(() => {
        row.style.backgroundColor = '';
        button.disabled = false;
        alert("Mise à jour simulée avec succès !");
    }, 5000);
}

function cancelUser(button) {
    const row = button.closest('tr');
    const nom = row.children[0].textContent;
    const prenom = row.children[1].textContent;

    if (confirm(`Voulez-vous vraiment supprimer l'utilisateur ${prenom} ${nom} ?`)) {
        row.remove();
        alert("Utilisateur supprimé.");
    }
}
