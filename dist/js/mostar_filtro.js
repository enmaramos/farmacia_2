document.getElementById('filtroEstado').addEventListener('change', function() {
    var estado = this.value;
    window.location.href = '?estado=' + estado;
});

document.querySelectorAll('.reactivarUsuarioBtn').forEach(button => {
    button.addEventListener('click', function() {
        var idUsuario = this.getAttribute('data-id');
        fetch('../pages/Ctrl/reactivar_usuario.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'id_usuario=' + idUsuario
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) location.reload();
        })
        .catch(error => console.error('Error:', error));
    });
});