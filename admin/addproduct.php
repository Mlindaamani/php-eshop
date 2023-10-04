<!--  Include header contents  -->
<?php include('../includes/header.php') ?>
<!-- Include the sidebar -->
<div class='row mt-3 gx-2'>
  <div class='col-md-2 border shadow mt-3'>
    <?php include '../includes/sidepanel.php' ?>
  </div>

  <!-- Include the 10 colums to display the forms-->
  <div class='col-md-10 border shadow mt-3'>
    <!-- Display the succes message when the product is added Successfully-->
    <?php generateAlert('productadded', 'Product added Successfully!', 'success') ?>
    <!-- Kindly fill all the fields -->
    <?php generateAlert('emptyProductField', ' Kindly fill in the fields!', 'danger') ?>

    <div class='container d-flex justify-content-center align-items-center mb-3 w-75 h-80 mt-3 '>
      <!-- Product addition form -->
      <form action='productlisting.php' method='post' class='border shadow p-3 rounded w-50'
        enctype='multipart/form-data'>
        <div class='mb-3'>
          <h5 class='text-center p-3'>Add Products</h5>

          <label class='form-label'>Enter product name</label>
          <input type='text' name='product_name' class='form-control'>
        </div>

        <div class='mb-3'>
          <label for='lastname' class='form-label'>Enter Product Description</label>
          <input type='text' name='pro_description' class='form-control'>
        </div>


        <div class='mb-3'>
          <label class='form-label'>Enter Product Price</label>
          <input type='number' name='product_price' class='form-control' step='0.01'>
        </div>

        <div class='mb-3'>
          <label class='form-label'>Enter Stock Quantity</label>
          <input type='number' name='stock_quantity' class='form-control'>
        </div>

        <div class='mb-3'>
          <label class='form-label'>Enter Product Image</label>
          <input type='file' name='product_image' class='form-control'>

          <div class='mb-3 mt-3'>
            <button type='submit' class='btn btn-primary w-100 mb-2 border shadow' name='submit'>Add</button>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- Include the footer contents in the login page. -->
<?php include '../includes/script.php' ?>