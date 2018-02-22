<?php
$row = 1;
require 'dbconnect.php';
echo "<table border='1'>";
$sql="";
if (($handle = fopen("students.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        echo "<tr>";
        echo "<td>".$data[0]."</td>";
        echo "<td>".$data[1]."</td>";
        echo "<td>".$data[2]."</td>";
        echo "<td>".$data[3]."</td>";
        echo "<td>".$data[4]."</td>";
        $data[2]=md5($data[2]);
        $sql="INSERT INTO users(id, username, password, firstname, lastname) VALUES($data[0], '$data[1]', '$data[2]', '$data[3]', '$data[4]');";
        $conn->query($sql);
        echo "<td>OK</td>";
        echo "</tr>";
    }
    fclose($handle);
}
echo "</table>";
?>