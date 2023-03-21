<?php 

$accion = $_POST['accion'];
$password = $_POST['password'];
$usuario = $_POST['usuario'];

if($accion === 'crear'){
    //Codigo para crear los administradores

    //Hashear passwords
    $opciones = array(
        'cost' => 12
    );
    $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
    // Importar la conexion 
    include '../funciones/conexion.php';

    try {
        // Realizar la consulta a la base de datos
        $stmt = $conn->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?) ");
        if ($stmt === false) {
            /* Puedes hacer un return con ok a false o lanzar una excepción */
            /*throw new Exception('Error en prepare: ' . $stmt->error);*/
            return [ 'ok' => 'false' ];
        }
        $stmt->bind_param('ss', $usuario, $hash_password);
        $stmt->execute();
        if($stmt->affected_rows){
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => $accion
            );
        };
        $stmt = null;
        $conn = null;
    } catch (Exception $e) {
        // En caso de error, tomar la exepcion
        $respuesta = array(
            'pass' => $e->getMessage()
        );
    }
    
    echo json_encode($respuesta);
}

if($accion === 'login'){
    //Codigo para loguear a los administradores
}