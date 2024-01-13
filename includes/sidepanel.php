<!-- Sideber contents -->
<?php $baseUrl = 'http://localhost:8000'; ?>

<div class='border bg-info-subtle mt-md-3 p-0 text-center rounded m-2 mb-5 border shadow'>
  <ul class='navbar-nav me-auto border shadow'>
    <li class='nav-item '>
      <h5 class='text-primary bg-success-subtle rounded-top text-light fw-bold p-3'>MANAGE PRODUCTS</h5>
    </li>
    <li class='nav-item '>
      <a href="<?php $baseUrl ?>/admin/product-form.php" class='nav-link text-success hover-text-decoration-underline fw-bold'
        id='insert_product'>Add product</a>
    </li>
    <li class='nav-item '>
      <a href="#" class='nav-link text-success hover-text-decoration-underline fw-bold'>Remove Products</a>
    </li>
    <li class='nav-item'>
      <a href='<?php $baseUrl ?>/admin/category-form.php'
        class='nav-link text-success hover-text-decoration-underline fw-bold'>Add
        Categories </a>
    </li>
    <li class='nav-item '>
      <a href='<?php $baseUrl ?>/admin/remove-cat-form.php'
        class='nav-link text-success hover-text-decoration-underline fw-bold'>Remove Categories</a>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-success fw-bold'>See All Products </a>
    </li>
    <li class='nav-item '>
      <h5 class='text-primary bg-info rounded-top text-light bg-success-subtle fw-bold p-3'>MANAGE ORDERS</h5>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-success fw-bold'>View Orders</a>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-success fw-bold'>Pending Order</a>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-success fw-bold'>Comformed Orders</a>
    </li>
    <li class='nav-item '>
      <h5 class='text-primary bg-info rounded-top text-light bg-success-subtle fw-bold p-3'>MANAGE SHOPPING</h5>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-success fw-bold'>View User Account</a>
    </li>
    <li class='nav-item '>  
      <a href='#' class='nav-link text-success fw-bold'>Users</a>
    </li>
    <li class='nav-item '>
      <a href='#' class='nav-link text-success fw-bold'>Delete User Account</a>
    </li>
  </ul>
</div>