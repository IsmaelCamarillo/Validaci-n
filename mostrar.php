<?php
// Conexión a la base de datos
$servername = "fdb1028.awardspace.net";
$username = "4595736_validacion"; 
$password = "1234567890a"; 
$dbname = "4595736_validacion"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}



// Consultar datos desencriptados (sin IP)
$sql = "SELECT id, 
               CAST(AES_DECRYPT(first_name, 'clave_secreta') AS CHAR) AS first_name, 
               CAST(AES_DECRYPT(last_name, 'clave_secreta') AS CHAR) AS last_name 
        FROM usuarios";
$result = $conn->query($sql);
?>

<!-- Tabla para mostrar los datos desencriptados -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["first_name"]."</td>
                    <td>".$row["last_name"]."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No hay datos en la base de datos</td></tr>";
    }
    $conn->close();
    ?>
</table>
