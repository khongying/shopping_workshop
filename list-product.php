<script>
  $( document ).ready(function() {
      $(".number-product").blur(function() {
        let _name = $(this).attr("name");
        let _id = _name.replace("product-", "");
        let _value = $(this).val();
        let in_value = $("#form-cart input[name='product-"+_id+"']").attr("value");
        let c_cart = $("#count_cart").attr("count");
        let p_cart = c_cart - (in_value - _value);
        $("#count_cart").attr("count", p_cart);
        $("#count_cart").html(p_cart);
        $("#form-cart input[name='product-"+_id+"']").attr("value",_value);
        console.log(_value +' > '+in_value);

      });
  });


</script>



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
              print '<td><input name="product-'.$_id.'" class="number-product" type="number" min="0" max="99" value="'.$value.'"</td>';
              print '</tr>';

            }

            }
          }
          print '</table>';
          print '</form>';
  }
?>
