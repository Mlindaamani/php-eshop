<!-- Sideber contents -->
<?php $baseUrl = 'http://localhost:8000'; ?>

<div class='border bg-dark-subtle mt-md-3 p-0 text-center rounded m-2 mb-5 border shadow'>
  <ul class='navbar-nav me-auto border shadow'>
    <li class='nav-item '>
      <h5 class='text-primary bg-info rounded-top text-light bg-primary'>MANAGE PRODUCTS</h5>
    </li>
    <li class='nav-item '>
      <a href="<?php $baseUrl ?>/admin/addproduct.php" class='nav-link text-primary hover-text-decoration-underline'
        id='insert_product'>Add product</a>
    </li>
    <li class='nav-item '>
      <a href="#" class='nav-link text-primary hover-text-decoration-underline'>Remove Products</a>
    </li>
    <li class='nav-item'>
      <a href='<?php $baseUrl ?>/admin/addcategory.php'
        class='nav-link text-primary hover-text-decoration-underline'>Add
        Categories </a>
    </li>
    <li class='nav-item '>
      <a href='<?php $baseUrl ?>/admin/removecategory.php'
        class='nav-link text-primary hover-text-decoration-underline'>Remove Categories</a>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-primary'>See All Products </a>
    </li>
    <li class='nav-item '>
      <h5 class='text-primary bg-info rounded-top text-light bg-primary'>MANAGE ORDERS</h5>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-primary'>View Orders</a>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-primary'>Pending Order</a>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-primary'>Comformed Orders</a>
    </li>
    <li class='nav-item '>
      <h5 class='text-primary bg-info rounded-top text-light bg-primary'>MANAGE SHOPPING</h5>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-primary'>View User Account</a>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-primary'>Delete User Account</a>
    </li>
  </ul>
</div>