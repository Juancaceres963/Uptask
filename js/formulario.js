eventListener();

function eventListener() {
  document
    .querySelector("#formulario")
    .addEventListener("submit", validarRegistro);
}

function validarRegistro(e) {
  e.preventDefault();

  var usuario = document.querySelector("#usuario").value,
    password = document.querySelector("#password").value,
    tipo = document.querySelector("#tipo").value;

  if (usuario == "" || password == "") {
    // Validacion fallo
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Ambos campos son obligatorios",
    });
  } else {
    // Ambos campos fueron completados correctamente

    // Datos que se envian al servidor
    var datos = new FormData();
    datos.append("usuario", usuario);
    datos.append("password", password);
    datos.append("accion", tipo);

    // Creando el Llamado a Ajax
    var xhr = new XMLHttpRequest();

    // Abrir la conexcion
    xhr.open("POST", "/inc/modelos/modelo-admin.php", true);

    // Retorno de datos
    xhr.onload = function() {
      if (this.status === 200) {
        var respuesta = JSON.parse(xhr.responseText);
        // Si la respuesta es correcta
        if (respuesta.respuesta === "correcto") {
          // Si es un nuevo usuario
          if (respuesta.tipo === "crear") {
            alert("El usuario se creo");
          }
        }
      }
    };

    // Enviar la peticion
    xhr.send(datos);
  }
}
