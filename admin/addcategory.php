<?php
include('../includes/header.php');
$con = dbconnect();
if (isset($_POST['submit'])) {
    $category = $_POST['category'];


    if (empty($category)) {
        header('Location: addcategory.php?emptyCategoryField');
        exit;
    }


    $sql_result = mysqli_query($con, "SELECT * FROM categories WHERE category_name = '$category'");

    if (mysqli_num_rows($sql_result) > 0) {
        header('location: addcategory.php?present');
        exit();

    } else {
        $result = mysqli_query($con, "INSERT INTO categories(category_name) VALUES('$category')");
        if ($result) {
            header('location: addcategory.php?cat');
            exit();
        }
    }
}
?>

<div class='row mt-3'>
    <!-- Sidebar -->
    <div class='col-md-2 mt-3 shadow'>
        <?php include '../includes/sidepanel.php'; ?>
    </div>

    <!-- Display as 10 columns layout similar to admin-panel page -->
    <div class='col-md-10 border shadow mt-3' style="height:100%">
        <!-- Display the successful message when category is added -->
        <?php if (isset($_GET['cat'])) { ?>
            <div class="alert alert-success alert-dismissible fade show border shadow mt-2" role="alert">
                Category added Successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        <?php } ?>

        <!-- Display message for empty category field -->
        <?php if (isset($_GET['emptyCategoryField'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show border shadow mt-2" role="alert">
                Kindly fill in the category
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        <?php } ?>


        <!-- Display the warning when the category is present -->
        <?php if (isset($_GET['present'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show border shadow mt-2" role="alert">
                Category is present!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        <?php } ?>

        <!-- Form for adding categories -->
        <div class='container d-flex justify-content-center align-items-center'
            style='margin-top: 100px; margin-bottom: 300px;'>

            <!-- Sumit the form on the same page -->
            <form method='post' class='border shadow p-3 rounded' action="">
                <h5 class='text-center p-3'>Add Categories</h5>

                <div class='mb-3'>
                    <div class="form-floating">
                        <input type='text' name='category' id='' class='form-control' placeholder="C">
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