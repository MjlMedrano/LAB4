function redirigir_pagina(){};

function crear_usuarios(){};


function abrir_modal() {
  document.getElementById("modalRedactar").style.display = "block";
}


function cerrar_modal() {
  document.getElementById("modalRedactar").style.display = "none";
}




function verificar_envio_a_todos(ok) {
  const modalResultado = document.getElementById("modalResultado");
  const mensaje = document.getElementById("mensaje_resultado");

  if (ok) {
    mensaje.innerText = "Mensaje enviado exitosamente a todos los usuarios.";
    cerrar_modal(); // Cierra el de redacción
  } else {
    mensaje.innerText = "Hubo un error al enviar el mensaje.";
  }

  modalResultado.style.display = "block";
}


function cerrar_modal_resultado() {
  document.getElementById("modalResultado").style.display = "none";
}




document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formRedactar");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const asunto = form.asunto.value;
    const descripcion = form.descripcion.value;

    const datos = { asunto, descripcion };

    fetch("enviar_a_todos.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(datos)
    })
    .then(res => res.json())
    .then(data => {
      verificar_envio_a_todos(data.exito);
      form.reset();
    })
    .catch(error => {
      console.error("Error:", error);
      verificar_envio_a_todos(false);
    });
  });
});

function cargarContenido(abrir) {
	var contenedor;
	contenedor = document.getElementById('contenido');
	fetch(abrir)
		.then(response => response.text())
		.then(data => contenedor.innerHTML=data);
}


// funcion de read usuarios con ajax
fetch("Entrada.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("contenido").innerHTML = data;
    });


function mostrarModalCreate() {
    const modal = document.getElementById("myModalCreate");
    document.getElementById('tituloModalCreate').innerHTML = "CREAR USUARIO";
    
    fetch("UCreateForm.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("mensajeModalCreate").innerHTML = data;
            document.getElementById('btnUltimos').style.display = "none";
            modal.style.display = "flex";
        });
}



function mostrarModalUpdate(id) {
    const modal = document.getElementById("myModalUpdate");
    document.getElementById('tituloModalUpdate').innerHTML = "EDITAR USUARIO";
    fetch(`UUpdateForm.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById("mensajeModalUpdate").innerHTML = data;
            document.getElementById('btnUltimos').style.display = "none";
            modal.style.display = "flex";
        });
}



function mostrarModalDelete(id) {
    const modal = document.getElementById("myModalDelete");
    document.getElementById('tituloModalDelete').innerHTML = "MENSAJE ELIMINADO";

    fetch(`UDelete.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById("mensajeModalDelete").innerHTML = data;
            document.getElementById('btnUltimos').style.display = "none";
            modal.style.display = "flex";
            actualizarListaMensajes();
        });
}


function MInsertar() {
    var ajax = new XMLHttpRequest();
    var formulario = document.getElementById("FormCreate");
    var parametros = new FormData(formulario);
    var datos = document.getElementById("content-mensajes");
    var datos2 = document.getElementById("mensajeModalCreate");
    datos.innerHTML = "";

    ajax.open("POST", "UCreate.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            datos.innerHTML = ajax.responseText;
            datos2.innerHTML = ajax.responseText;
            actualizarListaMensajes();
        }
    };
    ajax.send(parametros);
}

function UEditar() {
    const formulario = document.getElementById("FormUpdate");
    const parametros = new FormData(formulario);
    const datos = document.getElementById("mensajeModalUpdate");
    const id = formulario.id.value;

    datos.innerHTML = "";

    fetch(`UUpdate.php?id=${id}`, {
        method: "POST",
        body: parametros
    })
    .then(response => response.text())
    .then(data => {
        datos.innerHTML = data;
        actualizarListaMensajes();
    });
}


function actualizarListaMensajes() {
    fetch("URead.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("contenido").innerHTML = data;
        });
}

function cambiarEstado(id) {
    fetch(`UCambiarEstado.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            console.log(data); // Para depuración
            actualizarListaMensajes(); // Recarga la tabla
        })
        .catch(error => {
            console.error("Error al cambiar el estado:", error);
        });
}





function abrir_modal_mensaje() {
    // Mostrar el modal
    document.getElementById('modalMensajeIndividual').style.display = 'flex';
    // Limpiar campos
    document.getElementById('mensaje').value = "";
    document.getElementById('respuestaEnvio').innerHTML = "";



    // Cargar usuarios al select
    fetch("UUsuariosSelect.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById('destinatario').innerHTML = data;
        })
        .catch(error => console.error("Error cargando usuarios:", error));
}

// Enviar el formulario por fetch
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("formMensajeIndividual");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch("EnviarMensaje.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById("respuestaEnvio").innerHTML = data;
        actualizarListaMensajes(); // opcional
        // Cerrar el modal después de unos segundos
  setTimeout(() => {
    document.getElementById("modalMensajeIndividual").style.display = "none";
    document.getElementById("formMensajeIndividual").reset();
  }, 1500);
      })
      .catch(error => {
        console.error("Error enviando mensaje:", error);
      });
    });
  } else {
    console.warn("Formulario de mensaje individual no encontrado");
  }
});

