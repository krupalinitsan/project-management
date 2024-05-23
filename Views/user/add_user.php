<?php include ('Views/header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add User</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-white">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Add User</div>
            <div class="text-center text-success">
                <?php echo $msg; ?>
            </div>
            <div class="card-body">
                <form id="registrationForm" method="post" action="" name="employeeForm">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" required>
                            <span class="error text-danger" id="fnameError"></span>
                        </div>
                        <div class="col">
                            <label for="mname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="mname" name="mname" required>
                            <span class="error text-danger" id="mnameError"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" required>
                            <span class="error text-danger" id="lnameError"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <span class="error text-danger" id="emailError"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="role" class="form-label">User Role</label>
                            <select name="role" class="form-control" required>
                                <?php

                                while ($row = $roles->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }

                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="team" class="form-label">Select Team</label>
                            <select name="team" class="form-control" required>
                                <?php
                                while ($row = $teams->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3" align="center">
                        <input type="submit" name="add" id="regist" value="ADD USER" class="btn btn-primary">
                    </div>
                </form>
            </div><br>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php include ('Views/footer.php'); ?>