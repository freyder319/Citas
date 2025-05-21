<?php
class Controlador {
 public function verPagina($ruta){
 require_once $ruta;
 } 
 public function agregarCita($doc, $med, $fec, $hor, $con) {
    $conexion = new Conexion();
    $conexion->abrir();
    $gestorCita = new GestorCita($conexion);

    if (!$gestorCita->verificarPaciente($doc)) {
        echo "<script>alert('El documento ingresado no existe en la base de datos. Por Favor Registrese.'); window.history.back();</script>";
        return;
    }

    $cita = new Cita(null, $fec, $hor, $doc, $med, $con, "Solicitada", "Ninguna");
    $id = $gestorCita->agregarCita($cita);
    $result = $gestorCita->consultarCitaPorId($id);
    require_once 'Vista/html/confirmarCita.php';
    
}

 public function consultarCitas($doc){
 $gestorCita = new GestorCita();
 $result = $gestorCita->consultarCitasPorDocumento($doc);
 require_once 'Vista/html/consultarCitas.php';
 }
 public function cancelarCitas($doc){
 $gestorCita = new GestorCita();
 $result = $gestorCita->consultarCitasPorDocumento($doc);
 require_once 'Vista/html/cancelarCitas.php';
 }
 public function consultarPaciente($doc){
 $gestorCita = new GestorCita();
 $result = $gestorCita->consultarPaciente($doc);
 require_once 'Vista/html/consultarPaciente.php';
 }
 public function agregarPaciente($doc,$nom,$ape,$fec,$sex){
 $paciente = new Paciente($doc, $nom, $ape, $fec, $sex);
 $gestorCita = new GestorCita();
 $registros = $gestorCita->agregarPaciente($paciente);
 if($registros > 0){echo "Se insertó el paciente con exito";
 } else {
 echo "Error al grabar el paciente";
 }
 }
 public function cargarAsignar(){
 $gestorCita = new GestorCita();
 $result = $gestorCita->consultarMedicos();
 $result2 = $gestorCita->consultarConsultorios();
 require_once 'Vista/html/asignar.php';
 }
  public function consultarHorasDisponibles($medico,$fecha){
 $gestorCita = new GestorCita();
 $result = $gestorCita->consultarHorasDisponibles($medico, 
 $fecha);
 require_once 'Vista/html/consultarHoras.php';
 }
  public function confirmarCancelarCita($cita){
 $gestorCita = new GestorCita();
 $registros = $gestorCita->cancelarCita($cita);
 if($registros > 0){
 echo "La cita se ha cancelado con éxito";
 } else {
 echo "Hubo un error al cancelar la cita";
 }
 }
  public function verCita($cita){
 $gestorCita = new GestorCita();
 $result = $gestorCita->consultarCitaPorId($cita);
 require_once 'Vista/html/confirmarCita.php';
 }
 public function valida($doc){
 $gestorCita = new GestorCita();
 $result = $gestorCita->validacion($doc);
 require_once 'Vista/html/consultarPaciente.php';
 }
 public function verConsultorio(){
 $gestorCita = new GestorCita();
 $resultado = $gestorCita->consultorio();
 require_once 'Vista/html/consultorios.php';
 }
 public function eliminarConsultorioxid($id) {
    $gestorCita= new GestorCita();
    $resultado=$gestorCita->eliminarConsultorioxid($id);
    if($resultado >= 1){
        echo "No se puede eliminar el consultorio por que tiene citas asociadas";
    } else {
    $resultado=$gestorCita->eliminarConsultorio($id);
    if($registros>0){
        echo "Se elimino el consultorio con exito";
    }else{
        echo "Error al eliminar el Consultorio";
    }
    }
    }
public function modificarConsultorio($id) {
    $gestorCita = new GestorCita();
    $consultorio = $gestorCita->obtenerConsultorioPorId($id);
    require_once 'Vista/html/modificarConsultorio.php';
}

public function guardarModificacionConsultorio($id, $nombre) {
    $gestorCita = new GestorCita();
    $gestorCita->actualizarConsultorio($id, $nombre);
    header("Location: index.php?accion=consultorio");
    exit();
}
public function guardarConsultorio($id,$nombre) {
    $gestorCita = new GestorCita();
    $registros=$gestorCita->guardarNuevoConsultorio($id,$nombre);
    if ($registros>0){
        echo "Se insertó el consultorio con exito";
    }else{
        echo "Error al ingresar al consult";
    }
}
}