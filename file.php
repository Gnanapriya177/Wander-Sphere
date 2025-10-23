<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mysql";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// Handle form submission and save to data.json
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = "data.json";
    if (!file_exists($file)) {
        file_put_contents($file, "[]");
    }

    $newData = array(
        "Name" => $_POST["name"],
        "Email" => $_POST["email"],
        "Phone Number" => $_POST["phone"],
        "DOB" => $_POST["dob"],
        "Nationality" => $_POST["nationality"],
        "ID Proof Type" => $_POST["id_proof"],
        "ID Proof Number" => $_POST["idproof_number"]
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

<?php include 'db.php'; ?>

<?php
// To add data to users table
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST["dob"];
    $nationality = $_POST["nationality"];
    $IDProofType = $_POST["id_proof"];
    $IDProofNumber = $_POST["idproof_number"];

    $sql = "INSERT INTO users (name, email, phone, dob, nationality, IDProofType, IDProofNumber) 
            VALUES ('$name', '$email', '$phone', '$dob', '$nationality', '$IDProofType', '$IDProofNumber')";

    if ($conn->query($sql)) {
        echo "<p>Record added successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>

  <!-- Bootstrap Select -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

  <!-- Country Picker -->
  <script src="https://cdn.jsdelivr.net/gh/mojoaxel/bootstrap-select-country@latest/dist/js/countrypicker.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <link rel="stylesheet" href="style.css" />
</head>
<body class = "form">
  <header>
    <h2>Registration Form</h2>
  </header>

  <form id="regForm" method="POST" action="">
    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" class="restrict-uppercase-and-lowercase-spaces" placeholder="Enter your name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" class="restrict-numbers-only" placeholder="Enter phone number" required>

    <label for="dob">Date Of Birth:</label>
    <input type="date" id="dob" name="dob" placeholder="Enter the DOB" required>

    <div class="form-group">
      <label for="nationality">Nationality:</label>
      <input type="text" id="nationality" name="nationality" placeholder="Enter your nationality" required>
    </div>

    <div class="form-group">
      <label>ID Proof Type</label>
      <select name="id_proof" class="form-control" required>
        <option value="" disabled selected>Select ID Proof</option>
        <option value="Aadhaar Card">Aadhaar Card</option>
        <option value="PAN Card">PAN Card</option>
        <option value="Passport">Passport</option>
        <option value="Driving License">Driving License</option>
        <option value="Voter ID">Voter ID</option>
      </select>
    </div>

    <label for="idproof_number">ID Proof Number:</label>
    <input type="text" id="idproof_number" name="idproof_number" class="restrict-numbers-only" placeholder="Enter ID proof number" required>

    <!-- ✅ Added name="submit" -->
    <button type="submit" name="submit">Submit</button>
  </form>

  <div id="output">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<p style='color: green; font-weight: bold;'>Data saved successfully!</p>";
    }
    ?>
  </div>

  <script src="script.js" defer></script>
</body>
</html>
