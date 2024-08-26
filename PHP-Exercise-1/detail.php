<?php
session_start();

$user_id = $username = $email = $address = $phone = $gender = "";

// Lấy thông tin người dùng từ session
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $user = array_filter($_SESSION['users'], function ($user) use ($id) {
        return $user['user_id'] == $id;
    });
    $user = array_shift($user); // Lấy user đầu tiên
    if ($user) {
        $user_id = $user['user_id'];
        $username = $user['username'];
        $email = $user['email'];
        $address = $user['address'];
        $phone = $user['phone'];
        $gender = $user['gender'];
    } else {
        header('Location: index.php');
        exit;
    }
}


?>

<?php include('layouts/header.php'); ?>

<h1 class="text-center">User Detail: <?php echo $user_id; ?> - <?php echo $username; ?></h1>
<form method="POST" action="">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control <?php echo !empty($usernameErr) ? 'is-invalid' : ''; ?>" id="username"
            name="username" value="<?php echo $username; ?>" disabled>
        <div class="invalid-feedback"><?php echo $usernameErr; ?></div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo !empty($emailErr) ? 'is-invalid' : ''; ?>" id="email"
            name="email" value="<?php echo $email; ?>" disabled>
        <div class="invalid-feedback"><?php echo $emailErr; ?></div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control <?php echo !empty($addressErr) ? 'is-invalid' : ''; ?>" id="address"
            name="address" value="<?php echo $address; ?>" disabled>
        <div class="invalid-feedback"><?php echo $addressErr; ?></div>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control <?php echo !empty($phoneErr) ? 'is-invalid' : ''; ?>" id="phone"
            name="phone" value="<?php echo $phone; ?>" disabled>
        <div class="invalid-feedback"><?php echo $phoneErr; ?></div>
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select <?php echo !empty($genderErr) ? 'is-invalid' : ''; ?>" id="gender" name="gender"
            disabled>
            <option disabled>Select Gender</option>
            <option value="Male" <?php echo $gender == "Male" ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo $gender == "Female" ? 'selected' : ''; ?>>Female</option>
        </select>
        <div class="invalid-feedback"><?php echo $genderErr; ?></div>
    </div>

    <a href="index.php" class="btn btn-secondary">Back</a>
</form>

<?php include('layouts/footer.php'); ?>