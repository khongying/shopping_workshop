<script src="js/jquery-3.1.1.min.js"></script>
<body>
    <div id="map">

    </div>
</body>
<script type="text/javascript">
    function iniMap(){
        var _this = {lat: 13.733058, lng: 100.489344};
        var map = new google.maps.Map(document.getElementById('map'),{
            zoom: 4,
            center: _this
      });
      var matker = new google.maps.Marker({
          position: _this,
          map: map
      });
    }

</script>



