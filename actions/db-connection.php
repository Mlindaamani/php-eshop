< <?php
// Creates and returns a connection object(mysqli_object)
function databaseConnection()
{
  $server_name = 'localhost';
  $db_user = 'root';
  $db_password = '';
  $db_name = 'ebotdb';
  $con = mysqli_connect($server_name, $db_user, $db_password, $db_name);
  if (!$con) {
    echo "Could not connect!";
  }
  return $con;
}