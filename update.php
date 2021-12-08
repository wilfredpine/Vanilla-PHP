<?php

require_once('connection/connection.php');
session_start();

if (empty($_SESSION['username'])) {
    header('location:login.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $con->query("SELECT * from studinfo WHERE id='" . $id . "'")->fetch();
}

?>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];

    $query = "UPDATE studinfo set fname=?,mname=?,lname=? WHERE id=$id";
    $result = $con->prepare($query)
        ->execute([$fname, $mname, $lname]);
    if ($result) {
        header('location:index.php');
    } else {
        echo "error";
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

                        <h1 class="h3 mb-3 fw-normal">Edit Student</h1>
                        <hr>

                        <form method="post">
                            <div class="form-floating mb-3">
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <label>First Name</label>
                                <input type="text" name="fname" value="<?php echo $data['fname']; ?>"
                                    class="form-control" required>
                            </div>
                            <div class="form-floating mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="mname" value="<?php echo $data['mname']; ?>"
                                    class="form-control" required>
                            </div>
                            <div class="form-floating mb-3">
                                <label>Last Name</label>
                                <input type="text" name="lname" value="<?php echo $data['lname']; ?>"
                                    class="form-control" required>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="submit" name="update" class="btn btn-success btn-lg" value="Update">
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>

    </main>

</body>

</html>