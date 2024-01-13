<?php

interface payableInterface {
  public function pay();
}

class creditCardPayment implements payableInterface {
  public function pay()
  {
    //Logic for creditCardPayment

    echo "Initializing credit card payment with a bcrypt algorithm";
  }
}

/**
 * Summary of paypalPayment
 */
class paypalPayment implements payableInterface {
  
  /**
   * Summary of pay
   * @return void
   */
  public function pay()
  {
    //Logic for paypalpayment

  }
}

/**
 * Summary of Request
 */
class Request {
  /**
   * Summary of type
   * @var string
   */
  public string $type;
}

/**
 * Summary of wiredPayment
 */
class wiredPayment implements payableInterface {
  /**
   * Summary of pay
   * @return void
   */
  public function pay()
  {
    //logics for wiredpayment.
  }
}

/**
 * Summary of paymentFactory
 */
class paymentFactory {
  /**
   * Summary of initializePayment
   * @param string $type
   * @throws \Exception
   * @return creditCardPayment|paypalPayment|wiredPayment
   */
  public function initializePayment(string $type)
  {
    if ($type == 'card') {
      return new creditCardPayment();
    } elseif ($type == 'paypal') {
      return new paypalPayment();
    } elseif ($type == 'wired') {
      return new wiredPayment();
    } else {
      throw new Exception("Unsupported payment method");
    }
  }

  /**
   * Summary of pay
   * @param Request $requirest
   * @return void
   */
  public function pay(Request $request) {
    $paymentFactory = new paymentFactory();
    $payment = $paymentFactory->initializePayment($request->type);
    $payment->pay();
  }
}
