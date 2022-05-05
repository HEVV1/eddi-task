<?php
include './src/inc/conn.php';
include './src/inc/session.php';
include './src/inc/authorization.php';
include './src/inc/main.php';
include './src/inc/getdataorders.php';
include './src/inc/getdataorderlines.php';
?>

<!DOCTYPE html>
<html lang="LV">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <!-- Le styles -->
  <link href="css/bootstrap.css" media="screen, print" rel="stylesheet" type="text/css">
  <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
  <link href="css/DT_bootstrap.css" rel="stylesheet">
  <link href="css/datepicker.css" rel="stylesheet">
  <link href="css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
  <link href="assets/css/select2.min.css" rel="stylesheet">
  <!-- Le fav and touch icons -->
  <link rel="shortcut icon" href="img/ico/favicon.ico">
  <link rel="apple-touch-icon" href="img/ico/i4-57x57.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/ico/i4-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/ico/i4-114x114.png">
</head>
<script language="javascript">
  var popupWindow = null;

  function Popup(url, winName) {
    w = (screen.width) ? (screen.width) * 0.75 : 500;
    h = (screen.height) ? (screen.height) * 0.75 : 300;

    LeftPosition = (screen.width) ? (screen.width - w) / 2 : 0;
    TopPosition = (screen.height) ? (screen.height - h) / 2 : 0;

    settings = "height=" + h + ",width=" + w + ",top=" + TopPosition + ",left=" + LeftPosition + ",scrollbars=yes,resizable=yes,menubar=no"

    popupWindow = window.open(url, winName, settings)

    popupWindow.focus()
  }
</script>

<body>
  <div class="container-fluid span12">
    <h2>SIA "Testa kompānija" pasūtījumi</h2>
    <table class="table table-striped table-bordered table-condensed dataTable" id="orderlist">
      <thead>
        <tr>
          <th>Pasūtījuma numurs</th>
          <th>Prioritāte</th>
          <th>Datums</th>
          <th>Pasūtījuma tips</th>
          <th>Pārdevējs</th>
          <th>Valūta</th>
          <th>Rindas pasūtījumā</th>
          <th>Summa kopā</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $session = new Session();        
        $getdataObj = new GetDataOrders(2);
        $getdatalinesObj = new GetDataOrdersLines(1);
        $obj = new Main($getdataObj, $getdatalinesObj);
        $obj->main_function();
        ?>
      </tbody>
    </table>
  </div>


</body>

</html>