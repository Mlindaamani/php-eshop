<?php

if (isset($_POST['submit'])) {
  $productId = $_POST['product_id'];
  echo $productId;
}