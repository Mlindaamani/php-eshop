<?php
include('../includes/header.php');
$con = dbconnect();
if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $sql_result = mysqli_query($con, "SELECT * FROM categories WHERE category_name = '$category'");
    if (mysqli_num_rows($sql_result) > 0) {
        header('location: addcategory.php?present=yes');
        exit();
    } else {
        $result = mysqli_query($con, "INSERT INTO categories(category_name) VALUES('$category')");
        if ($result) {
            header('location: addcategory.php?cat=1');
            exit();
        }
    }
}
?>
<div class='row'>
    <!-- Sidebar -->
    <div class='col-md-2'>
        <?php include '../includes/sidepanel.php'; ?>
    </div>
    <div class='col-md-10'>
        <div class='container d-flex justify-content-center align-items-center'
            style='margin-top: 100px; margin-bottom: 300px;'>
            <form method='post' class='border shadow p-3 rounded'>
                <div class=''>
                    <h5 class='text-center p-3'>Add Categories</h5>
                    <?php if (isset($_GET['cat'])) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Category added Successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['present'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Category is present!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    <?php } ?>
                    <div class='mb-3'>
                        <div class="form-floating">
                            <input type='text' name='category' id='' class='form-control' required placeholder="C">
                            <label for='email' class='form-label'>Enter Category</label>
                        </div>
                    </div>
                    <button type='submit' class='btn btn-primary w-100' name='submit'>Add</button>
            </form>
        </div>
    </div>
</div>
</div>
<?php include '../includes/footer.php' ?>