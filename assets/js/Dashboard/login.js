document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-button");
    const formWrapper = document.querySelector(".form-wrapper");

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            // Remover la clase active de los botones
            tabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            // Mover el contenedor a la izquierda o derecha según la pestaña seleccionada
            if (this.getAttribute("data-tab") === "login") {
                formWrapper.style.transform = "translateX(0%)";
            } else {
                formWrapper.style.transform = "translateX(-50%)";
            }
        });
    });


    const login = document.querySelector("#login-form");
    const usuarioLogin = document.querySelector("#usuario");
    const contraLogin = document.querySelector("#contra");

    login.addEventListener("submit", async function (e) {
        e.preventDefault();

        if (usuarioLogin.value == "" || contraLogin.value == "") {
            Toastify({
                text: "Por favor, rellene todos los campos",
                className: "info",
                duration: 1500, // Duración en milisegundos
                gravity: "bottom", // Posición vertical (arriba o abajo)
                position: "left",
                style: {
                    background: "linear-gradient(to right, #ff416c, #ff4b2b)",
                }
            }).showToast();
        } else {
            const formData = {
                usuario: usuarioLogin.value,
                contra: contraLogin.value
            };
            

            try {
                const response = await fetch(base_url + "Admin/loginAdmin", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(formData)
                });

                const res = await response.json();

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
                        window.location.href = base_url + "Dashboard/index";
                    }, 2000);
                }
            } catch (error) {
                console.error("Error en la petición:", error);
            }
        }

    });

    const registroForm = document.querySelector("#register-form");
    const nombreRegistro = document.querySelector("#nombre")
    const apellidoRegistro = document.querySelector("#apellido")
    const usuarioRegistro = document.querySelector("#usuarioRegistro")
    const contraRegistro = document.querySelector("#contraRegistro");

    registroForm.addEventListener("submit", function (e) {
        e.preventDefault();

        if (nombreRegistro.value == "" || apellidoRegistro.value == "" || usuarioRegistro.value == "" || contraRegistro.value == "") {
            Toastify({
                text: "Por favor, rellene todos los campos",
                className: "info",
                duration: 1500, // Duración en milisegundos
                gravity: "bottom", // Posición vertical (arriba o abajo)
                position: "left",
                style: {
                    background: "linear-gradient(to right, #ff416c, #ff4b2b)",
                }
            }).showToast();
        } else {

            const formData = {
                nombre: nombreRegistro.value,
                apellido: apellidoRegistro.value,
                usuario: usuarioRegistro.value,
                contra: contraRegistro.value
            };

            const url = base_url + "Admin/registrar";
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.setRequestHeader("Content-Type", "application/json"); // IMPORTANTE
            http.send(JSON.stringify(formData));

            http.onreadystatechange = function () {
                if (this.readyState == 4) {
                    console.log("Respuesta completa del servidor:", this.responseText);

                    if (this.status == 200) {
                        try {
                            const res = JSON.parse(this.responseText);
                            console.log("Respuesta JSON parseada:", res);

                            if (res.status == "success") {
                                Toastify({
                                    text: "Registro exitoso",
                                    className: "success",
                                    duration: 2000,
                                    gravity: "bottom",
                                    position: "left",
                                    style: {
                                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                                    }
                                }).showToast();

                                setTimeout(() => {
                                    window.location.href = base_url + "Admin/login";
                                }, 2000);
                            } else {
                                Toastify({
                                    text: res.message || "Error al registrar usuario",
                                    className: "error",
                                    duration: 2000,
                                    gravity: "bottom",
                                    position: "left",
                                    style: {
                                        background: "linear-gradient(to right, #ff416c, #ff4b2b)",
                                    }
                                }).showToast();
                            }
                        } catch (error) {
                            console.error("Error al parsear JSON:", error);
                            console.error("Contenido recibido:", this.responseText);
                        }
                    }
                }
            };


        }
    });  

});
