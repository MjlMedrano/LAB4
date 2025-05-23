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
function editarestado(id) {
    var url = `form_editarestado.php?id=${id}`
	var contenedor = document.getElementById('contenido');
	fetch(url)
		.then(response => response.text())
		.then(data => contenedor.innerHTML=data);
}
function guardarEditar(){
    var datos = new FormData(document.querySelector('#form-edit'));

    fetch("editestado.php",
		{method:"POST",
		body:datos})
		.then(response => response.text())
		.then(data => document.querySelector("#contenido").innerHTML=data);
}


