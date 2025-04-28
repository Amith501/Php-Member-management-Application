<?php
include 'db.php'; // Make sure db.php connects $conn to your database

$name = "";
$mobile = "";
$address = "";
$join_date = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"] ?? '';
    $mobile = $_POST["mobile"] ?? '';
    $address = $_POST["address"] ?? '';
    $join_date = $_POST["join_date"] ?? '';

    do {
        // Validate required fields
        if (empty($name) || empty($mobile) || empty($address) || empty($join_date)) {
            $errorMessage = "All the fields are required.";
            break;
        }

        // SQL Insert (you can use prepared statements for security)
        $sql = "INSERT INTO members (name, mobile, address, join_date)
                VALUES ('$name', '$mobile', '$address', '$join_date')";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $successMessage = "Member added successfully.";
header("location:/loanapp/index.php");
        // Clear form values after success
        $name = $mobile = $address = $join_date = "";

    } while (false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>Ganapathi vargaka sangam</title>
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Ganapathi varagaka sangam</h2>

    <?php if (!empty($errorMessage)) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><?= $errorMessage ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if (!empty($successMessage)) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?= $successMessage ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <form method="POST" action="/loanapp/createmember.php">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= htmlspecialchars($name) ?>">
      </div>

      <div class="mb-3">
        <label for="mobile" class="form-label">Mobile Number</label>
        <input type="text" class="form-control" name="mobile" id="mobile" value="<?= htmlspecialchars($mobile) ?>">
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" name="address" id="address" value="<?= htmlspecialchars($address) ?>">
      </div>

      <div class="mb-3">
        <label for="join_date" class="form-label">Join Date</label>
        <input type="date" class="form-control" name="join_date" id="join_date" value="<?= htmlspecialchars($join_date) ?>">
      </div>

      <div class="d-flex justify-content-start gap-2">
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="/loanapp/index.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
