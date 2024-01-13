<?php
require_once __DIR__ . "/../config/config.php";
$title = CATEGORY;
require_once __DIR__ . '/../includes/header.php'
    ?>

<div class='row mt-3'>
    <!-- Sidebar -->
    <div class='col-md-2 mt-3 '>
        <?php require_once __DIR__ . '/../includes/sidepanel.php' ?>
    </div>

    <!-- Display as 10 columns layout similar to admin-panel page -->
    <div class='col-md-10 mt-3' style="height:100%">
        <?php generateAlert('cat', ' Category added Successfully!', 'success') ?>
        <?php generateAlert('emptyCategoryField', ' Kindly fill in the category!', 'danger') ?>
        <?php generateAlert('present', ' Category is present!', 'danger') ?>
        <div class='container d-flex justify-content-center align-items-center'
            style='margin-top: 100px; margin-bottom: 300px;'>
            <form method='post' class='border shadow p-3 rounded' action="categoryHandler/add-handler.php">
                <h5 class='text-center p-3 text-success fw-bold'>ADD CATEGORY</h5>
                <div class='mb-3'>
                    <div class="form-floating">
                        <input type='text' name='category_name' class='form-control' placeholder="C">
                        <label for='email' class='form-label'>Enter Category</label>
                    </div>
                </div>
                <button type='submit' class='btn btn-success w-100 fw-bold' name='submit'>ADD</button>
            </form>
        </div>
    </div>
</div>
</div>
<?php require_once __DIR__ . '/../includes/script.php' ?>