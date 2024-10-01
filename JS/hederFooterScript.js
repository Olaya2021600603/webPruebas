function checkSession() {
    // Realiza una solicitud AJAX para verificar el estado de la sesión
    fetch('../PHP/checkSession.php')
        .then(response => response.json())
        .then(data => {
            console.log('Datos recibidos CS:', data); // Verifica los datos recibidos
            if (data.sessionActive) {
                mostrarDatosUsuario();
                openModal('userModal');
            } else {
                openModal('myModal');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

 // Función para abrir el modal
function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

// Función para cerrar el modal
function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Cerrar modal si el usuario hace clic fuera de él
window.onclick = function(event) {
    if (event.target == document.getElementById("userModal")) {
        closeModal('userModal');
    } else if (event.target == document.getElementById("myModal")) {
        closeModal('myModal');
    }
}

function logout() {
    fetch('../PHP/logout.php', {
        method: 'POST',
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirigir a la página de inicio de sesión
            closeModal('userModal');
        } else {
            alert("Error al cerrar sesión");
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

        // Función para cargar y mostrar datos del JSON
        function mostrarDatosUsuario() {
            fetch('../JSON/data.json')
            .then(response => response.json())
            .then(data => {
                console.log(data); // Verificar los datos recibidos en la consola
                // Actualizar el contenido del modal
                document.getElementById('userName').textContent = data.user || 'Nombre del Usuario';
                document.getElementById('userEmail').textContent = data.email || 'correo@ejemplo.com';
            })
            .catch(error => {
                console.error('Error al cargar datos:', error);
            });
    }

document.addEventListener("DOMContentLoaded", function() {

    // Agregar evento al enlace del modal
    document.getElementById("openModal").addEventListener("click", function(event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
        checkSession(); // Verificar la sesión y abrir el modal adecuado
    });

    // Ejecutando funciones
    document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
    document.getElementById("btn__registrarse").addEventListener("click", register);
    window.addEventListener("resize", anchoPage);

    // Declarando variables
    var formulario_login = document.querySelector(".formulario__login");
    var formulario_register = document.querySelector(".formulario__register");
    var contenedor_login_register = document.querySelector(".contenedor__login-register");
    var caja_trasera_login = document.querySelector(".caja__trasera-login");
    var caja_trasera_register = document.querySelector(".caja__trasera-register");

    function anchoPage() {
        if (window.innerWidth > 850) {
            caja_trasera_register.style.display = "block";
            caja_trasera_login.style.display = "block";
        } else {
            caja_trasera_register.style.display = "block";
            caja_trasera_register.style.opacity = "1";
            caja_trasera_login.style.display = "none";
            formulario_login.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario_register.style.display = "none";
        }
    }

    anchoPage();

    function iniciarSesion() {
        if (window.innerWidth > 850) {
            formulario_login.style.display = "block";
            contenedor_login_register.style.left = "10px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.opacity = "1";
            caja_trasera_login.style.opacity = "0";
        } else {
            formulario_login.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.display = "block";
            caja_trasera_login.style.display = "none";
        }
    }

    function register() {
        if (window.innerWidth > 850) {
            formulario_register.style.display = "block";
            contenedor_login_register.style.left = "410px";
            formulario_login.style.display = "none";
            caja_trasera_register.style.opacity = "0";
            caja_trasera_login.style.opacity = "1";
        } else {
            formulario_register.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario_login.style.display = "none";
            caja_trasera_register.style.display = "none";
            caja_trasera_login.style.display = "block";
            caja_trasera_login.style.opacity = "1";
        }
    }
});
