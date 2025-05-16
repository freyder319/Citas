<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
 <title></title>
 </head>
 <body>
 <?php
 if($result->num_rows > 0){
    header("location: index.php?accion=guardarCita")
 ?>
 <?php
 }
 else {
 ?>
 <p>El paciente no existe en la base de datos.</p>
 <?php
 }
 ?>
 </body>
</html>
