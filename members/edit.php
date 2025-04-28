<?php

include 'db.php';
$id= "";
$name = "";
$mobile = "";
$address = "";
$join_date = "";
$errorMessage = "";
$successMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!isset($_GET["id"])){
        header("location:/loanapp/index.php");
        exit;
    }

    $id= $_GET["id"];

    //Read the data from the db
    $sql= "SELECT * FROM members WHERE id=$id";
    $result = $conn->query($sql);
    $row= $result ->fetch_assoc();
    if(!$row){
        header("locaton:/loanapp/index.php");
        exit;
    }
    $name= $row["name"];
    $mobile = $row["mobile"] ;
    $address = $row["address"] ;
    $join_date = $row["join_date"] ;
}else{
//post method to update the data from database
$id= $_POST["id"];
$name = $_POST["name"];
    $mobile = $_POST["mobile"] ;
    $address = $_POST["address"] ;
    $join_date = $_POST["join_date"] ;

    do{
        if (empty($name) || empty($mobile) || empty($address) || empty($join_date)) {
            $errorMessage = "All the fields are required.";
            break;
        }
        $sql= "UPDATE members SET name= '$name', mobile= '$mobile',address= '$address',join_date= '$join_date' 
        WHERE id= $id";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }
        $successMessage = "Member updated successfully.";
        header("location:/loanapp/index.php");
        exit;
    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>New Member</title>
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Add New Member</h2>

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

    <form method="POST" action="/loanapp/edit.php">
      <div class="mb-3">
        <input type= "hidden" name= "id" value= "<?php echo $id;?>  "/>
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>">
      </div>

      <div class="mb-3">
        <label for="mobile" class="form-label">Mobile Number</label>
        <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $mobile ?>">
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" name="address" id="address" value="<?php echo $address ?>">
      </div>

      <div class="mb-3">
        <label for="join_date" class="form-label">Join Date</label>
        <input type="date" class="form-control" name="join_date" id="join_date" value="<?php echo$join_date ?>">
      </div>

      <div class="d-flex justify-content-start gap-2">
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="/loanapp/index.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
