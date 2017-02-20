<?php
    require_once('admin/conDB/conDB.php');
    require_once('function-products.php');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- Bootstrap -->
    <link href="bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <!-- font-awesome -->
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <title>Shopping</title>
    <script>
      $( document ).ready(function() {
        $(".product-card_cert").click(function(){
          let count = $("#count_cart").attr("count");
          let display = "0";
          count = +count + 1;
          if (count > 99) {
            display ="99+"
          }else {
            display = count;
          }
            $("#count_cart").attr("count",count);
            $("#count_cart").html(display);
        });

        $( window ).scroll(function() {
         var height = $(window).scrollTop();
         console.log(height);
         if(height  > 50) {
           $("body").addClass("scl_inited");
         }
         else{
           $("body").removeClass("scl_inited");
         }
     });

    });
    </script>
    <style>
      div#count_cart {
        background-color: #ff0700;
        padding: 0px 5px;
        color: #fff;
        position: absolute;
        top: 25px;
        margin-left: 20px;
        border-radius: 5px;
      }
      header #menu{
        background-color: #FB9696;
      }
      input#search {
        padding: 10px 5px;
        width: 100%;
      }
      div#div-search {
        padding-top: 10px;
        background-color: #FB9696;
      }
      header .logo{
        color: white;
        font-size: 24px;
        text-align: left;
        padding: 0 10px;
        margin-bottom: 10px;
      }
      header .input-group-addon{
        width: 1% !important;
        display: table-cell;
      }
      header #search{
        padding: 10px 5px;
        width: 100%;
      }
    .product {
        height: 420px;
        width: 250px;
        display: inline-block;
        border: 1px solid transparent;
        margin: 1px;
        cursor: pointer;
    }
    .product-card_img{
        padding: 6px;
        border: 1px solid transparent;
        font-size: 13px;
        line-height: 1.2em;
        color: rgb(68,68,68);
        font-weight: 400;
        box-sizing: border-box;
        position: relative;
        cursor: pointer;
        display: inline-block;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-flow: column;
        -ms-flex-flow: column;
        flex-flow: column;
    }
    .product-card_description {
      margin-top: 1em;
      padding: 6px;
    }
    .product-card_name {
        height: 2.5em;
        margin: 0 0 6px;
        position: relative;
        display: block;
        color: inherit;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product-card_rate {
        margin-top: 1em;
    }
    .product-card_price {
        color: #d21f30;
        font-size: 14px;
        line-height: 1;
        margin: 10px 0;
        vertical-align: middle;
        text-transform: uppercase;
    }
    .product-card_cert {
        background: #EB89B5;
        padding: 10px;
        color: #fff;
        text-align: center;
        opacity: 0;
    }
    .product:hover  .product-card_cert{
        opacity: 1;
    }
    .product:hover{
        border: 1px solid #ccc;
    }
    .scl_inited header {
    position: fixed;
    z-index: 201;
  }
  .scl_inited div#menu {
    display: none;
  }
  .scl_inited div#body {
    padding-top: 123px;
  }
    </style>
  </head>
  <body>
    <!-- Large modal -->
    <div class="modal fade" id="shoppingModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>-- Data not found --</p>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <header>
      <div id="menu" class="container-fluid">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
          </ul>
      </div>
      <div id="div-search" class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="logo">
              <img src="image/coin.png" />
                Super Market
            </div>
          </div>
          <div class="col-md-6">
            <form class="form-inline">
              <div class="form-group" style="width: 100%">
                <div class="input-group">
                  <input type="text" id="search" placeholder="Search">
                  <div class="input-group-addon">
                      <i class="fa fa-search" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-3">
              <div id="btn-cart" data-toggle="modal" data-target="#shoppingModal">
                  <div id="cart"><img src="image/cart.png" /><div>
                  <div id="count_cart" count="0">0</div>
              </div>
          </div>
        </div>
      </div>
    </header>
    <div>
      <div id="body" class="container-fluid">
        <div class="row">
          <div class="col-md-2">
              <div id="main-menu-category">
                <ul class="menu-category">
                  <li>Coffee</li>
                  <li>Tea</li>
                  <li>Milk</li>
                </ul>
              </div>
          </div>
          <div class="col-xs-10 col-md-10">
              <?php
              $data_product = get_products($DB_MAIN_LINK);
              if ($data_product['result'] === true) {
                // fore($i=1; $i<10; $i++){
                foreach ($data_product['data'] as $key => $value) {

                  # code...

                  ?>
                  <div class="product">
                    <div class="product-card_img">
                      <img src="admin/product_image/<?=$value['image']?>" class="img_shopping">
                    </div>
                    <div class="product-card_description">
                        <div class="product-card_name">
                            <?=$value['name']?>
                        </div>
                        <div class="product-card_rate">
                          <?php
                            $rate =4;
                            for($star = 0; $star < 5; $star++){
                              if($rate > $star){
                                print '<img src="image/favorite.png"/>';
                              }
                              else{
                                print '<img src="image/star-c.png"/>';
                              }
                            }
                            print "<span class='review'>(22 รีวิว)</span>";
                          ?>
                        </div>
                        <div class="product-card_price"><?=number_format($value['price'])?> บาท</div>
                        <div class="product-card_cert"><i class="fa fa-shopping-basket" aria-hidden="true"></i> ใส่ตระกร้า</div>
                    </div>
                  </div>

              <?php
            }
          }
            ?>
          </div>


        </div>
      </div>
    </div>
  </body>
</html>
