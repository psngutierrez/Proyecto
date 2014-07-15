<form name="frmLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <div>
      <label>Usuario: </label> <input name = "usuario"/>
      <label>Contraseña: </label> <input name = "contrasenia" />
      <input name ="btnIniciar" value="Iniciar Sesion"/>
   </div>
</form>

if( isset($_POST["iniciar"]) )  {
   $usuario = $_POST["usuario"];
   $password = $_POST["contrasenia"];
   if(validarUsuario($usuario,$password) == true){
      $sesion->set("usuario",$usuario);
      header("location: principal.php");
   } else {
     echo "Verifica tu nombre de usuario y contraseña";
   }
}
 
function validarUsuario($usuario, $password)    {
   $conexion = new mysqli("localhost","usuario","password","base");
   $consulta = "select contrasenia from usuario where nick = '$usuario';";
   $result = $conexion->query($consulta);
   if($result->num_rows > 0)  {
      $fila = $result->fetch_assoc();
      if( strcmp($password,$fila["contrasenia"]) == 0 )
         return true;
      else
         return false;
   }  else
       return false;
}