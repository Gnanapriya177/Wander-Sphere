<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registered Users</title>
</head>
<body class="register_form">
<div class="container_form">
<h3>Registered Users</h3>
    <table border="1" cellpadding="10">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Date Of Birth</th>
          <th>Address</th>
        </tr>
      </thead>
   
<?php
    $file = "data.json";
    if (file_exists($file)){
        $jsonData = file_get_contents($file);
        $dataArray = json_decode($jsonData, true);

        if (!empty($dataArray)) {
            foreach ($dataArray as $user) {
                echo "<tr>
                        <td>" . htmlspecialchars($user['name']) . "</td>
                        <td>" . htmlspecialchars($user['email']) . "</td>
                        <td>" . htmlspecialchars($user['phone']) . "</td>
                        <td>" . htmlspecialchars($user['dob']) . "</td>
                      </tr>";
            }
        }
    }
?>
</div>
</table>
</body>
</html>
