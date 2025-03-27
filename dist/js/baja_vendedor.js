document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".eliminarVendedorBtn").forEach(button => {
        button.addEventListener("click", function() {
            let idVendedor = this.getAttribute("data-id");

            if (confirm("¿Estás seguro de dar de baja este vendedor?")) {
                fetch("../pages/Ctrl/baja_vendedor.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "id_vendedor=" + idVendedor
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload(); // Recargar la página después de la baja
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});
