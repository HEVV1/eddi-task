<?php
class Main extends Authorization
{
  public $authorizationResult;
  private $dataOrders;
  private $dataOrdersLines;

  public function __construct(GetDataOrders $getDataOrders, GetDataOrdersLines $getDataOrderLines)
  {
    $this->dataOrders = $getDataOrders;
    $this->dataOrdersLines = $getDataOrderLines;
  }

  public function main_function()
  {
    $this->authorizationResult = $this->login("Juris");

    //Checks if authorization is complete
    if ($this->authorizationResult != "") {
      echo
      '<tr>
        <td class="money">' . $this->dataOrders->order_no . ' ' . $this->dataOrders->ordstatus . '</td>
        <td>' . $this->dataOrders->priority . '</td>
        <td>' . $this->dataOrders->date . '</td>
        <td>' . $this->dataOrders->ordertype . '</td>
        <td>' . $this->dataOrders->salesman . '</td>
        <td>' . $this->dataOrders->currency . '</td>
      </tr>';

      $items[] = array('line' => $this->dataOrdersLines->line_bo, 'item' => $this->dataOrdersLines->item, 'qnty' => $this->dataOrdersLines->qnty, 'price' => $this->dataOrdersLines->price, 'amountord' => $this->dataOrdersLines->amount_ordered, 'percdel' => $this->dataOrdersLines->percdel, 'amountdel' => $this->dataOrdersLines->amountdel);

      $percdelshow = "";

      $count = 0;

      foreach ($items as $item) {

        ++$count;

        $amountord = $item['amountord'];

        $percdel = $item['percdel'];

        $amountdel = $item['amountdel'];

        if ($amountord == 0) {
          $percdel = 0;
        } else {
          $percdel = ($amountdel / $amountord) * 100;
        };

        if ($percdel == 0) {
          $percdelshow = '<span class="label label-info">' . number_format($percdel, 1, ".", " ") . '%</span>';
        };

        if ($percdel > 0 and $percdel < 100) {
          $percdelshow = '<span class="label label-warning">' . number_format($percdel, 1, ".", " ") . '%</span>';
        };

        if ($percdel == 100) {
          $percdelshow = '<span class="label label-success">' . number_format($percdel, 1, ".", " ") . '%</span>';
        };

        if ($this->dataOrders->ordertype == "0") {
          $percdelshow = '';
        };

        $statusshow = '';

        if ($this->dataOrders->ordstatus == "0") {
          $statusshow = '<span class="btn btn-danger btn-mini">0</span>';
        };

        if ($this->dataOrders->ordstatus == "1") {
          $statusshow = '<span class="btn btn-warning btn-mini">1</span>';
        };

        if ($this->dataOrders->ordstatus == "2") {
          $statusshow = '<span class="btn btn-primary btn-mini">2</span>';
        };

        if ($this->dataOrders->ordstatus == "3") {
          $statusshow = '<span class="btn btn-success btn-mini">3</span>';
        };

        if ($this->dataOrdersLines->price * $this->dataOrdersLines->qnty == $this->calculateSum($item['price'], $item['qnty'])) {

          $summ = round($this->dataOrdersLines->price * $this->dataOrdersLines->qnty, 0);
        } else {

          $cur3 = "SELECT order_summ from orders where order_no='" . $this->dataOrders->order_no . "'";

          $result2 = $this->connect->query($cur3);

          $summ = round($result2, 0);
        }
      }
    } else {
      $iAccessDenied = "Access denied!";
      $iAccessDeniedMessage = "User password not accepted";    
      echo "    
      <center>    
      <img src='images/stop.gif'><br>    
      <span class='title'><font color='red'>$iAccessDenied</font></span></p></b>    
      <p>$iAccessDeniedMessage</span></p>";
    }
    $this->connect()->close();
  }

  public function calculateSUm($price, $qnty){
    return $price * $qnty;
  }
}
