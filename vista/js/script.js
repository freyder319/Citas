$(document).ready(function(){
 $("#frmPaciente").dialog({
 autoOpen: false,
 height: 310,
 width: 400,
 modal: true,
 buttons: {
 "Insertar":insertarPaciente,
 "Cancelar":cancelar
 }
 });
 $("#frmConsultorio").dialog({
 autoOpen: false,
 height: 310,
 width: 400,
 modal: true,
 buttons: {
 "Insertar":insertarConsultorio,
 "Cancelar":cancelar
 }
 });
});
function consultarPaciente(){
 var url = "index.php?accion=consultarPaciente&documento=" + 
$("#asignarDocumento").val();
 $("#paciente").load(url,function(){
 });
}
function validar(){
 var url = "index.php?accion=consultarPaciente&documento=" + 
$("#asignarDocumento").val();
 $("#paciente").load(url,function(){
 });
}
function mostrarFormulario(){
 documento = "" + $("#asignarDocumento").val();
 $("#PacDocumento").attr("value",documento);
 $("#frmPaciente").dialog('open');
}
function insertarPaciente(){
 queryString = $("#agregarPaciente").serialize();
 url = "index.php?accion=ingresarPaciente&" + queryString ;
 $("#paciente").load(url);
 $("#frmPaciente").dialog('close'); 
}
function cancelar(){
 $(this).dialog('close'); 
}
function cargarHoras(){
 if( ($("#medico").val() == -1 ) || ($("#fecha").val() == "")|| ($("#consultorio").val() == "-1")){
 $("#hora").html("<option value='-1' selected='selected'>--Selecione la hora </option>")
 } else {
 queryString = "medico="+$("#medico").val()+"&fecha="+$("#fecha").val();
 url = "index.php?accion=consultarHora&" + queryString ;
 $("#hora").load(url);
 }
}
function seleccionarHora(){
 if($("#medico").val() == -1 ){
 alert("Debe seleccionar un médico");
 } else if ($("#fecha").val() == ""){
 alert("Debe seleccionar una fecha");
 }
 }
 function consultarCita(){
    
 url = "index.php?accion=consultarCita&consultarDocumento=" + 
 $("#consultarDocumento").val() ;
 $("#paciente2").load(url);
}
function confirmarCancelar(numero){
 if(confirm("Esta seguro de cancelar la cita " + numero)){
 $.get("index.php",{accion:'confirmarCancelar',numero:numero},function(mensaje){
 alert(mensaje);
 });
 }
 $("#cancelarConsultar").trigger("click");
}
function cancelarCita(){
 url = "index.php?accion=cancelarCita&cancelarDocumento=" + 
$("#cancelarDocumento").val() ;
 $("#paciente3").load(url); 
}
function mostrarFormulario2(){
 documento = "" + $("#asignarDocumento").val();
 $("#ConNumero").attr("value",documento);
 $("#frmConsultorio").dialog('open');
}
function insertarConsultorio(){
  let conNumero = $("#ConNumero").val();
  let conNombre = $("#ConNombre").val();

  console.log("Valores antes de enviar:", conNumero, conNombre);

  $.ajax({
    type: "POST",
    url: "index.php?accion=agregarConsultorio",
    data: { ConNumero: conNumero, ConNombre: conNombre }, // Enviar como objeto en lugar de serialize()
    success: function(response) {
      console.log("Respuesta del servidor:", response);
      $("#frmConsultorio").dialog('close'); 
      $("#consultorio").html(response);
    },
    error: function(xhr, status, error) {
      console.error("Error en la petición AJAX:", error);
    }
  });
}

