<?php
session_start();

// Nếu session chưa được khởi tạo, khởi tạo mảng người dùng trống
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// Xử lý xóa người dùng
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $_SESSION['users'] = array_filter($_SESSION['users'], function ($user) use ($id) {
        return $user['user_id'] != $id;
    });
    header('Location: index.php');
    exit;
}
?>

<?php include('layouts/header.php'); ?>

<h1 class="text-center">User Management</h1>
<a href="create.php" class="btn btn-success mb-3">Create New User</a>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Gender</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['users'] as $user): ?>
            <tr>
                <th scope="row"><?php echo htmlspecialchars($user['user_id']); ?></th>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['address']); ?></td>
                <td><?php echo htmlspecialchars($user['phone']); ?></td>
                <td><?php echo htmlspecialchars($user['gender']); ?></td>
                <td>
                    <a href="detail.php?id=<?php echo htmlspecialchars($user['user_id']); ?>"
                        class="btn btn-primary">Detail</a>
                    <a href="update.php?id=<?php echo htmlspecialchars($user['user_id']); ?>"
                        class="btn btn-warning">Update</a>
                    <a href="index.php?action=delete&id=<?php echo htmlspecialchars($user['user_id']); ?>"
                        class="btn btn-danger" onclick="return confirm('Are you sure want to delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include('layouts/footer.php'); ?>