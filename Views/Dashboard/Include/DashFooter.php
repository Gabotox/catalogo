<!-- Bootstrap JS (Popper incluido) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo BASE_URL?>assets/js/config.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="<?php echo BASE_URL ?>assets/js/Dashboard/principalAdmin.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/Dashboard/Dashboard.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/Dashboard/DashboardCrud.js"></script>


<script>
    document.getElementById("toggleSidebar").addEventListener("click", function() {
        let sidebar = document.getElementById("sidebar");
        let content = document.getElementById("content");

        sidebar.classList.toggle("hidden");
        content.classList.toggle("full-width");
    });

    window.addEventListener("load", function() {
        let loaderContainer = document.getElementById("loader-container");

        // Ocultar el loader cuando todo el contenido haya cargado
        loaderContainer.style.opacity = "0";
        loaderContainer.style.transition = "opacity 0.5s ease-out";

        setTimeout(() => {
            loaderContainer.style.display = "none"; // Ocultar completamente
        }, 600); // Pequeña transición de salida
    });
</script>




</body>

</html>