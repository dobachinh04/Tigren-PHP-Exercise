<?php
session_start();

// Khởi tạo các biến để lưu trữ giá trị input và lỗi
$username = $email = $address = $phone = $gender = "";
$usernameErr = $emailErr = $addressErr = $phoneErr = $genderErr = "";

// Xử lý form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form và xử lý các trường hợp không tồn tại
    $username = isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : "";
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
    $address = isset($_POST["address"]) ? htmlspecialchars($_POST["address"]) : "";
    $phone = isset($_POST["phone"]) ? htmlspecialchars($_POST["phone"]) : "";
    $gender = isset($_POST["gender"]) ? htmlspecialchars($_POST["gender"]) : "";

    // Validate dữ liệu
    if (empty($username))
        $usernameErr = "Username cannot be empty.";
    if (empty($email))
        $emailErr = "Email cannot be empty.";
    if (empty($address))
        $addressErr = "Address cannot be empty.";
    if (empty($phone))
        $phoneErr = "Phone cannot be empty.";
    if (!is_numeric($phone) || strlen($phone) < 10 || strlen($phone) > 11)
        $phoneErr = "Phone must be a number with 10 to 11 digits.";
    if (empty($gender))
        $genderErr = "Please select a gender.";

    // Kiểm tra email trùng lặp
    $emailExists = array_filter($_SESSION['users'], function ($user) use ($email) {
        return $user['email'] == $email;
    });
    if (!empty($emailExists))
        $emailErr = "Email already exists.";

    // Nếu không có lỗi, lưu dữ liệu và chuyển hướng
    if (empty($usernameErr) && empty($emailErr) && empty($addressErr) && empty($phoneErr) && empty($genderErr)) {
        $userId = count($_SESSION['users']) + 1; // Tạo user_id mới
        $_SESSION['users'][] = [
            'user_id' => $userId,
            'username' => $username,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
            'gender' => $gender,
        ];
        header('Location: index.php');
        exit;
    }
}
?>

<?php include('layouts/header.php'); ?>

<h1 class="text-center">Create New User</h1>
<form method="POST" action="">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control <?php echo !empty($usernameErr) ? 'is-invalid' : ''; ?>" id="username"
            name="username" value="<?php echo htmlspecialchars($username); ?>">
        <div class="invalid-feedback"><?php echo $usernameErr; ?></div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo !empty($emailErr) ? 'is-invalid' : ''; ?>" id="email"
            name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="invalid-feedback"><?php echo $emailErr; ?></div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control <?php echo !empty($addressErr) ? 'is-invalid' : ''; ?>" id="address"
            name="address" value="<?php echo htmlspecialchars($address); ?>">
        <div class="invalid-feedback"><?php echo $addressErr; ?></div>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="number" class="form-control <?php echo !empty($phoneErr) ? 'is-invalid' : ''; ?>" id="phone"
            name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        <div class="invalid-feedback"><?php echo $phoneErr; ?></div>
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select <?php echo !empty($genderErr) ? 'is-invalid' : ''; ?>" id="gender" name="gender">
            <option disabled selected>Select Gender</option>
            <option value="Male" <?php echo $gender == "Male" ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo $gender == "Female" ? 'selected' : ''; ?>>Female</option>
        </select>
        <div class="invalid-feedback"><?php echo $genderErr; ?></div>
    </div>

    <a href="index.php" class="btn btn-secondary">Back</a>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

<?php include('layouts/footer.php'); ?>