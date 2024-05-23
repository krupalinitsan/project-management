<!-- app/Views/edit_profile.php -->
<?php include ('Views/header.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Profile</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-white">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Update Profile</div>
            <div class="card-body">
                <form id="registrationForm" method="post" action="/update_profile" name="employeeForm">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                        </div>
                        <div class="col">
                            <label for="mname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="mname" name="mname"
                                value="<?php echo htmlspecialchars($user['middlename']); ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 text-center">
                        <input type="submit" name="update" id="update" value="Update" class="btn btn-primary">
                    </div>
                    <?php if (!empty($msg)): ?>
                        <div class="text-center" style="color: red;"><?php echo htmlspecialchars($msg); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($success_msg)): ?>
                        <div class="text-center" style="color: green;"><?php echo htmlspecialchars($success_msg); ?></div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php include ('Views/footer.php'); ?>