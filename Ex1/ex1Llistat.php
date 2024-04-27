<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llistat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="container mt-5 w-80">
    <h2 class="mb-3">Llistat</h2>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Edit</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            $servername = "bbdd.martamillanlom.cat";
            $username = "ddb193275";
            $password = "bbddTest12!%";
            $dbname = "ddb193275";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM productes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                            <th scope="row">' . $row["id"] . '</th>
                            <td>' . $row["nom"] . '</td>
                            <td><a href="ex1Form.php?id=' . $row["id"] . '" class="btn btn-outline-info">Edit</a></td>
                            <td><a href="" class="btn btn-outline-danger">Remove</a></td>
                          </tr>';
                }
            } else {
                echo "<tr><td colspan='4'>0 results</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
