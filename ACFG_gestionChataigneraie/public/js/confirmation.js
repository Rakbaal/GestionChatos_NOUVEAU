function confirmDeletePersonne(id) {
    if (confirm(`Êtes-vous certain de vouloir supprimer la personne numéro ${id}?`)) {
        window.location.replace(`/supprimerPersonne/${id}`);
        alert(`L'utilisateur ${id} a été supprimé.`)
    } 
    
}

function confirmDeleteEntreprise(id) {
    if (confirm(`Êtes-vous certain de vouloir supprimer l'entreprise numéro ${id} ?`)) {
        window.location.replace(`/supprimerEntreprise/${id}`);
        alert(`L'utilisateur ${id} a été supprimé.`)
    } 
    
}

function confirmDeleteUtilisateur(id) {
    if (confirm(`Êtes-vous certain de vouloir supprimer l'utilisateur numéro ${id} ?`)) {
        window.location.replace(`/supprimerUtilisateur/${id}`);
        alert(`L'utilisateur ${id} a été supprimé.`)
    } 
    
}