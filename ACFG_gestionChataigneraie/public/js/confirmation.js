function confirmDeletePersonne(nom, prenom, id) {
    if (confirm(`Êtes-vous certain de vouloir supprimer ${prenom} ${nom}?`)) {
        window.location.replace(`127.0.0.1:8000/supprimerPersonne/${id}`);
    } 
    
}
