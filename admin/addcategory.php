<?php
include('../includes/header.php');
?>
<div class='row mt-3'>
    <!-- Sidebar -->
    <div class='col-md-2 mt-3 shadow'>
        <?php include '../includes/sidepanel.php'; ?>
    </div>
    <!-- Display as 10 columns layout similar to admin-panel page -->
    <div class='col-md-10 border shadow mt-3' style="height:100%">
        <!-- Display the successful message when category is added -->
        <?php generateAlert('cat', ' Category added Successfully!', 'success') ?>
        <!-- Display message for empty category field -->
        <?php generateAlert('emptyCategoryField', ' Kindly fill in the category!', 'danger') ?>
        <!-- Display message when the selected category is present -->
        <?php generateAlert('present', ' Category is present!', 'danger') ?>
        <!-- Form for adding categories -->
        <div class='container d-flex justify-content-center align-items-center'
            style='margin-top: 100px; margin-bottom: 300px;'>
            <!-- Sumit the form on the same page -->
            <form method='post' class='border shadow p-3 rounded' action="categoryHandler/add_handler.php">
                <h5 class='text-center p-3'>Add Categories</h5>
                <div class='mb-3'>
                    <div class="form-floating">
                        <input type='text' name='category_name' class='form-control' placeholder="C">
                        <label for='email' class='form-label'>Enter Category</label>
                    </div>
                </div>
                <button type='submit' class='btn btn-primary w-100' name='submit'>Add</button>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Include the footer contents in the login page. -->
<?php include '../includes/script.php' ?>