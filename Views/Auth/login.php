<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/Dashboard/login.css'; ?>">

    <link rel="apple-touch-icon" href="<?php echo BASE_URL . 'assets/img/apple-icon.png'; ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL . 'assets/img/favicon.ico'; ?>">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


</head>

<body>

    <div class="auth-container">
        <div class="auth-card">
            <!-- Pestañas para Login y Registro -->
            <div class="tabs">
                <button class="tab-button active" data-tab="login">Iniciar Sesión</button>
                <button class="tab-button" data-tab="register">Registrarse</button>
            </div>

            <!-- Contenedor de formularios -->
            <div class="form-wrapper">

                <!-- Formulario de Inicio de Sesión -->
                <form id="login-form" class="auth-form">
                    <div class="input-group mb-3">
                        <label class="form-label">Usuario</label>

                        <div class="input-field">
                            <i class="bi bi-envelope"></i>
                            <input type="text" class="form-control" placeholder="username" id="usuario">
                        </div>

                    </div>

                    <div class="input-group">
                        <label class="form-label">Contraseña</label>
                        <div class="input-field">
                            <i class="bi bi-lock"></i>
                            <input type="password" class="form-control" placeholder="********" id="contra">
                        </div>
                    </div>

                    <button type="submit" class="btn-custom">Ingresar</button>
                    <p class="text-center mt-3"><a href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</a></p>
                </form>

                <!-- Formulario de Registro -->
                <form id="register-form" class="auth-form">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="input-group">
                                <label class="form-label">Nombre</label>
                                <div class="input-field">
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Gabriel" required id="nombre">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <label class="form-label">Apellido</label>
                                <div class="input-field">
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Meza" required id="apellido">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <label class="form-label">Usuario</label>
                                <div class="input-field">
                                    <i class="bi bi-envelope"></i>
                                    <input type="text" class="form-control" placeholder="Username" required id="usuarioRegistro">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <label class="form-label">Contraseña</label>
                                <div class="input-field">
                                    <i class="bi bi-lock"></i>
                                    <input type="password" class="form-control" placeholder="********" required id="contraRegistro">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-custom">Registrarse</button>
                </form>
            </div>

        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="<?php echo BASE_URL?>assets/js/config.js"></script>
    <script src="<?php echo BASE_URL ?>assets/js/Dashboard/login.js"></script>
    
</body>

</html>