<?php include '../includes/header.php';
$con = dbconnect();
if (isset($_POST['remove'])) {
    $category_id = $_POST['category_id'];
    $result_sql = mysqli_query($con, "DELETE FROM categories WHERE id = $category_id");
    if ($result_sql) {
        header('Location: removecategory.php?category=2');
        exit();
    }
}
?>

<div class='row'>
    <!-- Sidebar -->
    <div class='col-md-2'>
        <?php include '../includes/sidepanel.php' ?>
    </div>
    <!-- End of sidepanel -->
    <div class='col-md-10'>
        <div class='container d-flex justify-content-center align-items-center w-100'
            style='margin-top: 100px; margin-bottom: 300px;'>
            <form method='post' class='border shadow p-3 rounded'>
                <div class=''>
                    <h5 class='text-center p-3'>Remove Category</h5>
                    <?php if (isset($_GET['category'])) { ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            Category removed Successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['present'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Category is present!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <div class='mb-3'>
                        <select name='category_id' class='form-select mb-3 bg-primary text-light p-4' required
                            style='cursor:pointer' class='custom-select' size="5">
                            <?php $result = mysqli_query($con, 'SELECT * FROM categories');
                            while ($data = mysqli_fetch_assoc($result)) { ?>
                                <option value='<?= $data['id'] ?>' class='text-start'><?= $data['category_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type='submit' class='btn btn-primary w-100' name='remove'>Remove</button>
            </form>
        </div>
    </div>
</div>
<?php include '../includes/footer.php' ?>