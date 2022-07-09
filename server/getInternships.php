<!DOCTYPE html>
<html>
<head>
    <style>
        table {
        width: 100%;
        border-collapse: collapse;
        }

        table, td, th {
        border: 1px solid black;
        padding: 5px;
        }

        th {text-align: left;}
    </style>
</head>
<body>

<?php
    include_once 'db.php';

    // $q = intval($_GET['q']);

    // q = all

    // echo $q;

    $conn = DB::getConnection();

    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $sql="SELECT * FROM internships";
    $result = mysqli_query($conn, $sql);

    // echo "<table>
    //     <tr>
    //     <th>id</th>
    //     <th>title</th>
    //     <th>company</th>
    //     <th>description</th>
    //     </tr>";
    while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['title'] . "</td>";
      echo "<td>" . $row['company'] . "</td>";
      echo "<td>" . $row['description'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
    mysqli_close($conn);
?>
</body>
</html>