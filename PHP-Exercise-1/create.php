<?php include('layouts/header.php'); ?>

<h1 class="text-center">Create New User</h1>
<form>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username">
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Email</label>
        <input type="text" class="form-control" id="username">
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Address</label>
        <input type="text" class="form-control" id="username">
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Phone</label>
        <input type="number" class="form-control" id="username">
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Gender</label>
        <select class="form-select" aria-label="Default select example">
            <option disabled selected>Select Gender</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
            <option value="3">Empty</option>
        </select>
    </div>


    <a href="./index.php" class="btn btn-secondary">Comeback</a>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

<?php include('layouts/footer.php'); ?>