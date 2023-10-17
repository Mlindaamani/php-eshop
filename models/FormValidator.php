<?php

/**
 * Summary of FormValidator
 */
class FormValidator {

  /**
   * Summary of data
   * @var 
   */
  private $data;


  /**
   * Summary of errors
   * @var array
   */
  private $errors = [];

  /**
   * Summary of fields
   * @var array
   */
  private static $fields = ['firstname', 'lastname', 'email', 'password'];


  /**
   * Summary of __construct
   * @param mixed $data
   */
  public function __construct(array $post_data)
  {
    $this->data = $post_data;
  }


  /**
   * Summary of validate_form
   * @return array
   */
  public function validate_form()
  {
    foreach (self::$fields as $field) {

      if (!array_key_exists($field, $this->data)) {
        trigger_error("$field is not present in the data");
        exit();
      }
    }

    $this->validate_email();

    $this->validate_first_name();

    $this->validate_last_name();

    $this->validate_password();

    return $this->errors;
  }


  /**
   * Summary of validate_first_name
   * @return void
   */
  private function validate_first_name()
  {
    //Trim any whitespaces before and after the first_name
    $first_name = trim($this->data['firstname']);

    if (empty($first_name)) {

      $this->addErrors('firstname', 'Firstname cannot be empty');

    } else {
      $pattern = '/^[a-zA-Z0-9_]{4,20}$/';

      if (!preg_match($pattern, $first_name)) {
        $this->addErrors('firstname', 'Firstname must be 6-12 character long and alphnumeric(letters and numbers)');
      }
    }
  }


  /**
   * Summary of validate_last_name
   * @return void
   */
  private function validate_last_name()
  {
    //Trim any whitespaces before and after the last_name.
    $last_name = trim($this->data['lastname']);

    if (empty($last_name)) {

      $this->addErrors('lastname', 'Lastname cannot be empty');

    } else {

      $pattern = '/^[a-zA-Z0-9_]{4,20}$/';

      if (!preg_match($pattern, $last_name)) {
        $this->addErrors('lastname', 'Lastname must be 6-12 character long and alphnumeric(letters and numbers)');
      }
    }
  }


  /**
   * Summary of validate_email
   * @return void
   */
  private function validate_email()
  {
    //Trim any whitespaces before and after the email
    $emal = trim($this->data['email']);

    if (empty($emal)) {
      $this->addErrors('email', 'Email cannot be empty');

    } else {

      if (!filter_var($emal, FILTER_VALIDATE_EMAIL)) {
        $this->addErrors('email', 'Email must be a valid email');
      }
    }
  }


  /**
   * Summary of validate_password
   * @return void
   */
  private function validate_password()
  {
    //Trim any whitespaces before and after the username.
    $password = trim($this->data['password']);

    if (empty($password)) {
      $this->addErrors('password', 'Password cannot be empty');

    } else {

      if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
        $this->addErrors('password', 'Password must be 8 character long');
      }
    }
  }


  /**
   * Summary of addErrors
   * @param mixed $key
   * @param mixed $value
   * @return void
   */
  private function addErrors($key, $value)
  {
    $this->errors[$key] = $value;
  }
}