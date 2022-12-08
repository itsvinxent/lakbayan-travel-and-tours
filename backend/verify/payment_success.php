<?php
$redirect_link = '../../user-profile.php?orderID=';
$orderID = $_GET['orderID'] ?? null;
header('Refresh: 3; URL='.$redirect_link.$orderID);
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://kit.fontawesome.com/7846b9013f.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/payment-aftermath.css">
</head>

<body>
  <section class="postcard">
    <div class="postcard__header">
      <i class="fa-solid fa-circle-check fa-2xl fa-beat" style="--fa-animation-duration: 5s;"></i>
      <h1>Payment Success!</h1>
    </div>
    <div class="postcard__body">
      <p>If you're not redirected within 3 seconds click the button below...</p>
      <a href="../../user-profile.php?orderID=<?php echo $_GET['orderID']?? null;?>">Close</a>
    </div>
  </section>
</body>
</html>