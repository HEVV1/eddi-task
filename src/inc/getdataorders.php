<?php

class GetDataOrders extends DBConnection
{
  private $customer;

  public $order_no;
  public $priority;
  public $date;
  public $ordertype;
  public $salesman;
  public $orderlines;
  public $currency;
  public $ordstatus;

  public function __construct($parCustomerId)
  {
    $this->customer = $parCustomerId;
    $result = $this->getData($parCustomerId);
    
    $this->order_no   =   $result[0];
    $this->priority   =   $result[1];
    $this->date       =   $result[2];
    $this->date=substr($this->date, 6, 4) . '.' . substr($this->date, 3, 2) . '.' . substr($this->date, 0, 2);
    $this->ordertype  =   $result[3];
    $this->salesman   =   $result[4];
    $this->orderlines =   $result[5];
    $this->currency   =   $result[6];
    $this->ordstatus  =   $result[7];
  }

  public function getData()
  {
    $sql_customer = "SELECT order_no, priority, date, ordertype, salesman, orderline, currency, ordstatus from orders where customer_id='" . $this->customer . "'";
    $result = $this->connect()->query($sql_customer);
    if ($result != "") {
      $numRows = $result->num_rows;
      if ($numRows > 0) {
        while ($row = mysqli_fetch_row($result)) {
          return $row;
        }
      }
    } else {
      echo "Query didn't return anything";
    }
  }
}
