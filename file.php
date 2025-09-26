<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Registration Form</title>
</head>

<body class="register_form">
  <div class="container_form">
    <div class="header">
      <h2>REGISTRATION FORM</h2>
    </div>

    <!-- form sends data to same page -->
    <form id="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <input type="hidden" id="editIndex" name="editIndex">

      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="phone">Phone</label>
      <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

      <label for="dateofbirth">Date Of Birth</label>
      <input type="date" id="dob" name="dob" required>
    <div class = "gender-group">
      <label for="gender">Gender</label><br>
      <input type="radio" id="male" name="gender" value = "Male" required>
      <label for="male">Male</label>

      <input type="radio" name="gender" id="female" value = "female" required>
      <label for="female">Female</label>

      <input type="radio" name="gender" id="other" value = "other" required>
      <label for="other">Other</label>
      <br><br>
    </div>

      <label for="address">Address</label>
      <input type="text" id="address" name="address" placeholder="Enter your Address" required>

      <button type="submit" class="submit">Submit</button>
    </form>
        <?php
        // Load existing data
        $file = "data.json";
        if (!file_exists($file)) {
            file_put_contents($file, "[]");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newData = array(
                "name" => $_POST["name"],
                "email" => $_POST["email"],
                "phone" => $_POST["phone"],
                "dob" => $_POST["dob"],
                "address" => $_POST["address"]
            );

            $jsonData = file_get_contents($file);
            $dataArray = json_decode($jsonData, true);

            if (!is_array($dataArray)) {
                $dataArray = [];
            }

            $dataArray[] = $newData;

            file_put_contents($file, json_encode($dataArray, JSON_PRETTY_PRINT));
            
        }
        ?>
  </div>
</body>
</html>
