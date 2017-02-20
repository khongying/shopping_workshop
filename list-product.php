<?php

require_once('admin/conDB/conDB.php');
require_once('function-products.php');

  if (isset($_POST) && count($_POST) > 0) {

      print '<form id="form-in-cart" action="input.php" method="POST">';
      print '<table class="table table-hover">';
      print '<tr>';
      print '<th colspan="2">สินค้า</th>';
      print '<th class="tb-c">ราคา</th>';
      print '<th class="tb-c">จำนวน</th>';
      print '</tr>';
          foreach ($_POST as $key => $value) {
            if (strpos($key, "product-") == 0) {

            $_id  = str_replace("product-","",$key);
            $_product = get_products($DB_MAIN_LINK, $id = null);

            if ($_product['result'] === true) {
              $_info = $_product['data'][$_id];
              print '<tr>';
              print '<td><img class="img-rounded img-mini" src="admin/product_image/'.$_info['image'].'"/></td>';
              print '<td>'.$_info['name'].'</td>';
              print '<td>'.$_info['price'].'</td>';
              print '<td><input type="nunber" min="0" max="99" value="'.$value.'" size="1px"</td>';
              print '</tr>';

            }

            }
          }
          print '</table>';
          print '</form>';
  }
?>
