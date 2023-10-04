<!-- Include the header contents -->
<?php include '../includes/header.php';
//Include Category class and instantiate it.
include "../models/Category.php";
//Include database class.
include '../models/Database.php';
$category = new Category(new Database);
?>
<!-- Include the sidepanel -->
<div class='row mt-3'>
    <div class='col-md-2 border shadow mt-3'>
        <?php include '../includes/sidepanel.php' ?>
    </div>
    <!-- Form for displaying categories -->
    <div class='col-md-10 border shadow mt-3' style="height:100%">
        <!-- Display the message when the category is deleted -->
        <?php generateAlert('catdeleted', ' Category removed Successfully!', 'info') ?>
        <!-- Display error message when a category is not selected -->
        <?php generateAlert('selectCat', ' Kindly select the category!', 'danger') ?>
        <!-- Display the message when the added category is already present -->
        <?php generateAlert('present', ' Category is present!', 'danger') ?>
        <!-- Display the form for removing the categories -->
        <div class='container d-flex justify-content-center align-items-center w-100'
            style='margin-top: 100px; margin-bottom: 300px;'>
            <form method='post' class='border shadow p-3 rounded' action="categoryHandler/remove_handler.php">
                <div class=''>
                    <h5 class='text-center p-3 '>Remove Category</h5>
                    <div class='mb-3'>
                        <select name='category_id' class='form-select mb-3 bg-primary text-light p-4 border shadow'
                            style='cursor:pointer' class='custom-select' size="5">
                            <?php foreach ($category->getAllCategories() as $cate): ?>
                                <option value='<?= $cate['id'] ?>' class='text-start' name="category_id">
                                    <?= $cate['category_name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type='submit' class='btn btn-primary w-100 border shadow' name='remove'>Remove</button>
            </form>
        </div>
    </div>
</div>
<!-- Include the footer contents in the login page. -->
<?php include '../includes/script.php' ?>