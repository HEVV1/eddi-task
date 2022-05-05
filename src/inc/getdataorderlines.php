<?php

class GetDataOrdersLines extends DBConnection
{
  private $orderId;

  public $line_bo;
  public $item;
  public $qnty;
  public $price;
  public $amount_ordered;
  public $percdel;
  public $amountdel;

  public function __construct($parOrderId)
  {
    $this->orderId = $parOrderId;
    $result = $this->getData($parOrderId);   

    $this->line_bo          =   $result[0];
    $this->item             =   $result[1];
    $this->qnty             =   $result[2];    
    $this->price            =   $result[3];
    $this->amount_ordered   =   $result[4];
    $this->percdel          =   $result[5];
    $this->amountdel        =   $result[6];

  }

  public function getData()
  {
    $sql_orderlines = "SELECT * from order_lines where order_id='" . $this->orderId . "' order by line_bo";
    $result = $this->connect()->query($sql_orderlines);
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
