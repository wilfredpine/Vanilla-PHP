<?php

require_once('connection/connection.php');
session_start();

if (empty($_SESSION['username'])) {
    header('location:login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<!-- include your header here -->
<?php include('includes/header.php'); ?>

<body>
    <main>

        <!-- include your menubar here -->
        <?php include('includes/navbar.php'); ?>

        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12 text-center mt-5">

                    <div class="form-signin">

                        <h1 class="h3 mb-3 fw-normal">Add Student</h1>
                        <hr><br>


                        <?php
                            if (isset($_POST['save'])) {
                                $fname = $_POST['fname'];
                                $mname = $_POST['mname'];
                                $lname = $_POST['lname'];

                                $result = $con->prepare("INSERT INTO studinfo (fname,mname,lname) VALUES (?,?,?)")
                                    ->execute([$fname, $mname, $lname]);

                                if ($result) {
                                    header('location:index.php');
                                } else {
                                    echo "error";
                                }
                            }
                        ?>

                        <form method="post">
                            <div class="form-floating mb-3">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                            <div class="form-floating mb-3">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" name="mname" required>
                            </div>
                            <div class="form-floating mb-3">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="lname" required>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="submit" class="btn btn-success btn-lg" name="save" value="Save">
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>

    </main>

</body>

</html>