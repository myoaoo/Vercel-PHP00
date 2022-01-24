<?php 
header('Content-Type: application/json');
  if (isset($_POST['upload'])) {
    //$destination_path = getcwd().DIRECTORY_SEPARATOR;
    //$target_path = $destination_path/basename($_FILES["image"]["name"]);
    //@move_uploaded_file($_FILES['profpic']['tmp_name'], $target_path)
      //define ('SITE_ROOT', realpath(dirname(__FILE__)));
      //move_uploaded_file($_FILES['file']['tmp_name'], SITE_ROOT.'/static/images/slides/1/1.jpg');
      echo file_get_contents(__DIR__ . '/../src/users.json');
      $target = "images/".basename($_FILES['image']['name']);

      //connect to the data base
      $db = mysqli_connect("sql6.freemysqlhosting.net","sql6467804","lsCL6PbqR9","sql6467804","3306");

      $username = $_POST['name'];
      $userstore = $_POST['store'];
      $userlati = $_POST['lati'];
      $userlongi = $_POST['longi'];
      $storecategory = $_POST['category'];
      $userpho = $_POST['phone'];
      $useremail = $_POST['email'];
      $image = $_FILES['image']['name'];

      $sql = "INSERT INTO genral (username,store_name,latitude,longitude,category,user_phone,user_email,userimage) VALUES ('$username','$userstore','$userlati','$userlongi','$storecategory','$userpho','$useremail','$image')";
      mysqli_query($db,$sql); //store data into db
      if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
          $msg = "DATA UPLOADED SUCCESFULLY";
      }else{
          $msg = "DATA NOT UPLOADED SUCCESFULLY";
      }

  }
  ?>
<html>
    <head>
        <title>
            Seller Hub
        </title>
        <meta property="og:url" content="https://buy-yantra.000webhostapp.com/" />
<meta property="og:title" content="BUY-YANTRA's | Official Website" />
<meta property="og:description" content="Buy-Yantra is WebApp 🌐 Devloped by Team Technocrats For One Day SRMKZILLA Hackathon ✔ ™" />
<meta property="og:image" content="https://image.flaticon.com/icons/png/512/1008/1008262.png" />
        <link rel="shortcut icon" href="https://img.icons8.com/material-outlined/24/000000/shopping-cart--v1.png" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.waves.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    </head>
    <style>
        .data{
            display: flex;
            flex-direction: column;
            padding: 2rem;
            margin: 0 auto;
            width:55%;
        }
        .avatar{
            height:100px;
            width:50%;
            margin-left:25%;
            border-radius:10px;
            border:solid black 1px;
        }
        .button{
            padding:10px;
            font-size:15px;
            border-radius:5px;
        }
        .lable{
            padding:15px;
            border-radius:5px;
            border-top:0px;
            border-right:0px;
            border-left:0px;
            outline:none;
        }
    </style>
    <body id="body">
        <center><h2>Enter Store Information</h2></center>
        <form action="index.php" method="post" class="data" enctype="multipart/form-data">
        <label for="name"><b>User Name</b></label>
        <input type="text" class="lable" placeholder="Enter name" name="name" required>
        <br>
        <br>
        <label for="name"><b>Store Name</b></label>
        <input type="text" class="lable" placeholder="Enter name" name="store" required>
        <br>
        <br>
        <label for="name"><b>Location</b></label>
        <br>
        <p>Click ON map to select LOcation</p>
        <p>Click ok on google prompt screen and continue</p>
        <input type="text" id="lati" class="lable" placeholder="Enter name" name="lati" hidden>
        <input type="text" id="longi" class="lable" placeholder="Enter name" name="longi" hidden>
        <div id="dvMap" class="dvMap" style="width: 100%; height: 300px"></div>
        <br>
        <br>
        <label for="name"><b>category</b></label>
        <select name="category" class="lable" required>
            <option value="">--SELECT CATEGORY--</option>
            <option value="grocery">Grocery</option>
            <option value="medicine">Medicine</option>
            <option value="bakery">Bakery</option>
            <option value="electronics">Electronics</option>
            <option value="food">Fast Food</option>
            <option value="pet">Pet shop</option>
            <option value="sports">Sports</option>
            <option value="general">General</option>
        </select>
        <br>
        <br>
        <label for="name"><b>Phone Number</b></label>
        <input type="text" class="lable" placeholder="Enter name" name="phone" required>
        <br>
        <br>
        <label for="name"><b>Email Address</b></label>
        <input type="text" class="lable" placeholder="Enter name" name="email" required>
        <br>
        <br>
        <label for="image"><b>Upload Image  </b></label>
        <img src="https://cdn0.iconfinder.com/data/icons/pinterest-ui-flat/48/Pinterest_UI-18-512.png" title=" click to upload image" class="avatar" onclick="triggerClick()" id="profileDisplay"/>
	   <br>
       <br>
        <input type="file" name="image" onchange="displayImage(this)"  id="image" accept=".jpg, .jpeg, .png" required/> 
        <br>
       <br>
       <input type="submit" value="upload" name="upload" class="button">
       <br>
       <button class="button"><a href="index.php">return</a></button>
        </form>
    </body>
    <script>
        function triggerClick(e) {
  document.querySelector('#image').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
    </script>
    <script>
        var x = "<?php echo"$msg"?>";
        alert(x);
    </script>
    <script>
            var mapOptions = {
                center: new google.maps.LatLng(23.2599333,77.412615),
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
                google.maps.event.addListener(map, 'click', function (e) {
                console.log("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
           new google.maps.Marker({
             position: new google.maps.LatLng(e.latLng.lat(),e.latLng.lng()),
             map,
             draggable: true,
             title: "store location",
             });
             document.getElementById("lati").setAttribute("value", e.latLng.lat());
             document.getElementById("longi").setAttribute("value", e.latLng.lng());
             });
    </script>
    <script>
VANTA.WAVES({
  el: "#body",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  scale: 1.00,
  scaleMobile: 1.00
})
</script>
</html>