<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia según tu configuración
$password = ""; // Cambia según tu configuración
$dbname = "validacion"; // Cambia al nombre de tu BD

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se enviaron los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);

    // Encriptar datos (Opciones: AES o password_hash)
    $encryption_key = "clave_secreta"; // Clave para AES
    $sql = "INSERT INTO usuarios (first_name, last_name) VALUES (
                AES_ENCRYPT('$fname', '$encryption_key'), 
                AES_ENCRYPT('$lname', '$encryption_key'))";

    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<form action="validation.php" method="POST">
    First Name: <input type="text" name="fname" required><br>
    Last Name: <input type="text" name="lname" required><br> 
    <input type="submit" value="Save Data"><br>
</form>
