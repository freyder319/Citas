<?php
class GestorCita {
    public function agregarCita(Cita $cita){
    $conexion = new Conexion();
    $conexion->abrir();
    $fecha = $cita->obtenerFecha();
    $hora = $cita->obtenerHora();
    $paciente = $cita->obtenerPaciente();
    $medico = $cita->obtenerMedico();
    $consultorio = $cita->obtenerConsultorio();
    $estado = $cita->obtenerEstado();
    $observaciones = $cita->obtenerObservaciones();
    $sql = "INSERT INTO citas (CitNumero,CitFecha,CitHora,CitPaciente,CitMedico,CitConsultorio,CitEstado,CitObservaciones) VALUES ( null,'$fecha','$hora',
    '$paciente','$medico','$consultorio','$estado','$observaciones')";
    $conexion->consulta($sql);
    $citaId = $conexion->obtenerCitaId();
    $conexion->cerrar();
    return $citaId ;
    } 
    public function consultarCitaPorId($id){
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT pacientes.* , medicos.*, consultorios.*, citas.*"
    . "FROM Pacientes as pacientes, Medicos as medicos, Consultorios 
    as consultorios ,citas "
    . "WHERE citas.CitPaciente = pacientes.PacIdentificacion "
    . " AND citas.CitMedico = medicos.MedIdentificacion "
    . " AND citas.CitNumero = $id";
    $conexion->consulta($sql);
    $result = $conexion->obtenerResult();
    $conexion->cerrar();
    return $result ;
    }
    public function consultarCitasPorDocumento($doc){
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT * FROM citas "
    . "WHERE CitPaciente = '$doc' "
    . " AND CitEstado = 'Solicitada' ";
    $conexion->consulta($sql);
    $result = $conexion->obtenerResult();
    $conexion->cerrar();
    return $result ;
 
    }
    public function validar($doc){
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT * FROM Pacientes WHERE PacIdentificacion = '$doc' ";
    $conexion->consulta($sql);
    $result1 = $conexion->obtenerResult();
    $conexion->cerrar();
    return $result1 ;
    }
    public function consultarPaciente($doc){
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT * FROM Pacientes WHERE PacIdentificacion = '$doc' ";
    $conexion->consulta($sql);
    $result = $conexion->obtenerResult();
    $conexion->cerrar();
    return $result ;
    }
    public function agregarPaciente(Paciente $paciente){
    $conexion = new Conexion();
    $conexion->abrir();
    $identificacion = $paciente->obtenerIdentificacion();
    $nombres = $paciente->obtenerNombres();
    $apellidos = $paciente->obtenerApellidos();
    $fechaNacimiento = $paciente->obtenerFechaNacimiento();
    $sexo = $paciente->obtenerSexo();
    $sql = "INSERT INTO Pacientes VALUES ( 
    '$identificacion','$nombres','$apellidos',"
    . "'$fechaNacimiento','$sexo')";
    $conexion->consulta($sql);
    $filasAfectadas = $conexion->obtenerFilasAfectadas();
    $conexion->cerrar();
    return $filasAfectadas;
    }
    public function consultarMedicos(){
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT * FROM Medicos ";
    $conexion->consulta($sql);
    $result = $conexion->obtenerResult();
    $conexion->cerrar();
    return $result ; 
    }
    public function consultarHorasDisponibles($medico,$fecha){
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT hora FROM horas WHERE hora NOT IN "
    . "( SELECT CitHora FROM citas WHERE CitMedico = '$medico' AND 
    CitFecha = '$fecha'"
    . " AND CitEstado = 'Solicitada') ";
    $conexion->consulta($sql);
    $result = $conexion->obtenerResult();
    $conexion->cerrar();
    return $result ; 
    }
    public function consultarConsultorios(){
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT * FROM consultorios ";
    $conexion->consulta($sql);
    $result = $conexion->obtenerResult();
    $conexion->cerrar();
    return $result ; 
    }

    public function cancelarCita($cita){
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "UPDATE citas SET CitEstado = 'Cancelada' "
    . " WHERE CitNumero = $cita ";
    $conexion->consulta($sql);
    $filasAfectadas = $conexion->obtenerFilasAfectadas();
    $conexion->cerrar();
    return $filasAfectadas;
    }
    public function validacion($doc){
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT * FROM Pacientes WHERE PacIdentificacion = '$doc' ";
    $conexion->consulta($sql);
    $valida = $conexion->obtenerResult();
    $conexion->cerrar();
    return $valida ;
    }
    public function verificarPaciente($doc) {
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT * FROM Pacientes WHERE PacIdentificacion = '$doc'";
    $conexion->consulta($sql);
    $resultado = $conexion->obtenerResult();
    $conexion->cerrar();
    return ($resultado->num_rows > 0);
    }
    public function consultorio() {
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT * FROM consultorios;";
    $conexion->consulta($sql);
    $resultado = $conexion->obtenerResult();
    $conexion->cerrar();
    return $resultado ; 
    }
    public function obtenerConsultorioPorId($id) {
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "SELECT * FROM consultorios WHERE ConNumero = $id";
    $conexion->consulta($sql);
    $resultado = $conexion->obtenerResult();
    $conexion->cerrar();
    return $resultado->fetch_assoc();
    }
    public function actualizarConsultorio($id, $nombre) {
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "UPDATE consultorios SET Connombre='$nombre' WHERE ConNumero=$id";
    $conexion->consulta($sql);
    $conexion->cerrar();
    }
    public function guardarNuevoConsultorio($id,$nombre) {
    $conexion = new Conexion();
    $conexion->abrir();
    $sql = "INSERT INTO consultorios (ConNumero,ConNombre) VALUES ('$id','$nombre')";
    $conexion->consulta($sql);
    $conexion->cerrar();
    $filasAfectadas = $conexion->obtenerFilasAfectadas();
    return $filasAfectadas;
    
}

  public function eliminarConsultorio($id) {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "DELETE FROM consultorios WHERE ConNumero=$id";
        $conexion->consulta($sql);
        $conexion->cerrar();
        header("Location: index.php?accion=consultorio");
    exit();
  }

  public function eliminarConsultorioxid($id) {
    $conexion = new Conexion();
    $conexion->abrir();
    $sql="SELECT count(*) as cantidad from citas inner join consultorios on CitConsultorio=ConNumero where  ConNumero='$id'";
    $conexion->consulta($sql);
    $resultado = $conexion->obtenerUnaFila();
    $conexion->cerrar();
    return $resultado['cantidad'] ; 
    }
  }

?>

