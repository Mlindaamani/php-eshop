<?php

// CartItem Model
class CartItem {


  private $db;


  public function __construct($db)
  {
    $this->db = $db;
  }



  public function addProductsToCart($product_name, $quantity, $product_image, $price, $total_price, $user_id, $product_id, $cart_id)
  {
    $stmt = $this->db->con->prepare("INSERT INTO cart_items (product_name, quantity, product_image, price, total_price, user_id, user_id, product_id, cart_id) 

    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([$product_name, $quantity, $product_image, $price, $total_price, $user_id, $product_id, $cart_id]);
  }



  function addToCart($cartId, $productId, $quantity, $user_id)
  {
    $productObject = new Product($this->db);
    //Get Product info from the ProductClass for a $productId.
    $productIdInfo = $productObject->getProductInfoById($productId);
    //Get existing productInfo for a product with $productId.
    $existingCartItemsProductInfo = $this->getCartItemProductInfoById($productId, $user_id);

    if ($existingCartItemsProductInfo['product_id'] === $productId) {

      if ($existingCartItemsProductInfo['quantity'] <= $productIdInfo['stock_quantity']) {

        $newProductQuantity = $existingCartItemsProductInfo['quantity'] + $quantity;

        $newProductTotalPrice = $existingCartItemsProductInfo['price'] * $newProductQuantity;

        $productObject->decreaseStockQuantity($productId, $quantity);
        exit();

      } else {
        echo "Sorry the selected product is out of stock.";
      }

    } else {

      //Insert the product info for a $productId.
      $this->insertProductIntoCartItems(
        $cartId,
        $productId,
        1,
        $productIdInfo['price'],
        $productIdInfo['price'],
        $productIdInfo['image_url'],
        $productIdInfo['product_name'],
        $user_id
      );
      $productObject->decreaseStockQuantity($productId, 1);
    }
  }



  //UPDATE_CARTITEMS_QUANTITY.
  public function updateProductQuantity($quanity, $product_id, $user_id)
  {
    $stmt = $this->db->con->prepare("UPDATE cart_items SET quantity = ? WHERE product_id = ? AND user_id = ?");
    $stmt->execute([$quanity, $product_id, $user_id]);
  }


  //UPDATE_PRODUCT_QUANTITY_AND_TOTAL_PRICE:
  function updateCartItemTotalPrice($total_price, $product_id, $user_id)
  {
    $stmt = $this->db->con->prepare("UPDATE cart_items SET  total_price = ? WHERE product_id = ? AND user_id = ?");
    $stmt->execute([$total_price, $product_id, $user_id]);
  }



  //IS_PRODUCT_PRESENT():
  public function isProductPresentInCartItems($product_id)
  {
    $stmt = $this->db->con->prepare("SELECT product_id FROM cart_items WHERE product_id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    return isset($product);
  }


  //GET_CART_ITEMS_INFO_BY_ID:
  function getCartItemProductInfoById($product_id, $user_id)
  {
    $stmt = $this->db->con->prepare("SELECT * FROM cart_items WHERE product_id = ? AND user_id = ?");
    $stmt->execute([$product_id, $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }



  //GET_CART_SUB_TOTAL:
  public function subTotal($user_id)
  {
    $stmt = $this->db->con->prepare("SELECT SUM(total_price) FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
  }


  //GET_NUMBER_OF_RECORDS_IN_CARTITEMS_TABLE:
  public function getItemsCount($user_id)
  {
    $stmt = $this->db->con->prepare("SELECT COUNT(*) FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
  }



  //DELETE_INDIVIDUAL_CART_ITEM:
  function removeCartItem($cartItemId, $productId)
  {
    $stmt = $this->db->con->prepare("DELETE FROM cart_items WHERE id = ? AND product_id = ?");
    $stmt->execute([$cartItemId, $productId]);
  }



  //GET_ALL_CART_ITEMS_PRODUCT_INFO:
  function getAllCartItems($user_id)
  {
    $stmt = $this->db->con->prepare("SELECT * FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  //DELETE_ALL_CART_ITEMS:
  function clearCart()
  {
    $stmt = $this->db->con->prepare("DELETE FROM cart_items");
    $stmt->execute();
  }



  //INSERT_PRODUCTS_INTO_CARTITEMS_TABLE:
  function insertProductIntoCartItems($cartId, $product_id, $quantity, $price, $total_price, $product_image, $product_name, $user_id)
  {
    $stmt = $this->db->con->prepare("INSERT INTO cart_items (cart_id, product_id, quantity, price, total_price, product_image,product_name, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$cartId, $product_id, $quantity, $price, $total_price, $product_image, $product_name, $user_id]);
  }
}