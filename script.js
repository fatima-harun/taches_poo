// Fonction pour ouvrir le modal
function openModal() {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('modal-background').style.display = 'block';
  }
  
  // Fonction pour fermer le modal
  function closeModal() {
    document.getElementById('modal').style.display = 'none';
    document.getElementById('modal-background').style.display = 'none';
  }
  // Fonction pour fermer le modal lorsqu'on clique en dehors
document.getElementById('modal-background').addEventListener('click', function(event) {
    if (event.target === this) {
      closeModal();
    }
  });
  