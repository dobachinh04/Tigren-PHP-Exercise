<?php include('layouts/header.php'); ?>

<h1 class="text-center">User Management</h1>
<a href="./create.php" class="btn btn-success">Create New User</a>

<table class="table">
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
        <tr>
            <th scope="row">1</th>
            <td>Liam</td>
            <td>dobachinh04@gmail.com</td>
            <td>Hanoi</td>
            <td>0373860302</td>
            <td>Male</td>
            <td>
                <a href="" class="btn btn-primary">Detail</a>
                <a href="" class="btn btn-warning">Update</a>
                <a href="" class="btn btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa không?')">Delete</a>
            </td>
        </tr>
    </tbody>
</table>

<?php include('layouts/footer.php'); ?>