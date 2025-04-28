<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Members </h2>
        <a class="btn btn-primary mb-3" href="/loanapp/createmember.php" role="button">Add New Member</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Slno</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Join Date</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

<?php


$sql = "SELECT * FROM members";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    echo "
    <tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['mobile']}</td>
        <td>{$row['address']}</td>
        <td>{$row['join_date']}</td>
        <td>{$row['created_at']}</td>
        <td>
            <a class='btn btn-warning btn-sm' href='/loanapp/edit.php?id={$row['id']}'>Edit</a>
            <a class='btn btn-danger btn-sm' href='/loanapp/delete.php?id={$row['id']}'>Delete</a>
        </td>
    </tr>
    ";
}

$conn->close();
?>

            </tbody>
        </table>
    </div>
</body>
</html>
