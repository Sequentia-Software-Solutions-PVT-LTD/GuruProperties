<!DOCTYPE html>
<html>
  <head>
   <script type="text/javascript">
     function initGeolocation()
     {
        navigator.geolocation.getCurrentPosition( success, fail );
     }

     function success(position)
     {   
            document.getElementById('long').value = position.coords.longitude;
            document.getElementById('lat').value = position.coords.latitude;
     }

     function fail()
     {
        alert("Sorry, your browser does not support geolocation services.");
        document.getElementById('long').value = "00.0000000";
        document.getElementById('lat').value = "00.0000000";
     }

   </script>    
 </head>

 <body onLoad="initGeolocation();">
   <FORM NAME="rd" METHOD="POST" ACTION="index.html">
     <INPUT TYPE="text" NAME="long" ID="long" VALUE="">
     <INPUT TYPE="text" NAME="lat" ID="lat" VALUE="">
 </body>
</html>