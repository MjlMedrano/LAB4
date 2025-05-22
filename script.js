function redirigir_pagina(){};

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


