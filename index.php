<?php

require_once('connection/connection.php');
session_start();

if (empty($_SESSION['username'])) {
    header('location:login.php');
}

?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $res = $con->prepare("DELETE from studinfo WHERE id=$id")->execute();
    if ($res) {
        header('location:index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); ?>

<body>
    <main>

        <?php include('includes/navbar.php'); ?>

        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12 text-center mt-5">

                    <div class="form-signin">

                        <h1 class="h3 mb-3 fw-normal">Students List</h1>
                        <hr>

                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Number</td>
                                    <td>FirstName</td>
                                    <td>MiddleName</td>
                                    <td>LastName</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $data = $con->query("SELECT * from studinfo")
                                    ->fetchAll();
                                $counter = 1;
                                foreach ($data as $rows) {
                                ?>

                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo $rows['fname']; ?></td>
                                    <td><?php echo $rows['mname']; ?></td>
                                    <td><?php echo $rows['lname']; ?></td>
                                    <td>
                                        <a href="update.php?id=<?php echo $rows['id'] ?>"
                                            class="btn btn-success btn-sm">Update </a>
                                        <a href="index.php?id=<?php echo $rows['id'] ?>"
                                            class="btn btn-danger btn-sm">Delete </a>
                                    </td>
                                </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

    </main>


</body>

</html>