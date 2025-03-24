const cerrarSesion = document.querySelector("#cerrarSesion");

cerrarSesion.addEventListener("click", function(e) {
    e.preventDefault();

    fetch(base_url + "Admin/cerrarSesion", {
        method: "POST",
        headers: { "Content-Type": "application/json" }
    })
    .then(response => response.json())
    .then(res => {

        Toastify({
            text: res.message,
            className: res.status === "success" ? "success" : "error",
            duration: 2000,
            gravity: "bottom",
            position: "left",
            style: {
                background: res.status === "success"
                    ? "linear-gradient(to right, #00b09b, #96c93d)"
                    : "linear-gradient(to right, #ff416c, #ff4b2b)"
            }
        }).showToast();

        if (res.status === "success") {
            setTimeout(() => {
                window.location.href = base_url;
            }, 2000);
        }
    })
    .catch(error => {
        console.error("Error en la petición:", error);
    });
});