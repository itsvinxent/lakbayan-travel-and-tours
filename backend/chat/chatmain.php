<?php 
    session_start();
    if (isset($_SESSION['isLoggedIn']) == false) {
      header("location: ../../index.php");
      exit;
    }
    include '../../backend/auth/getuser.php';
    include '..\..\backend\connect\dbCon.php';
    
    $_SESSION['active'] = 'chat-main';
    $loc = "../../assets/img/logo.png";
       
    $testdatain = 19; //SENDER change with Session
    $testdataout = 47; //RECEIVER change with Get

    $myid = $_SESSION['id'] ?? null;
    // echo $myid;
    $sendto = $_GET['chatid'] ?? null;

    if($sendto != null) {
        $vo = view_otheruser($conn, $sendto);
        if(empty($vo['profpicture'])) $vo['profpicture'] = "../../DefaultProf.jpg";
    }
?> 

<!-- <section>
    <link rel="stylesheet" href="assets\css\chatbox.css">

    <h1>Chat Popup</h1>
    <p>Click on the chat to start</p>

    <button class="chat-btn">
        <i class="material-icons">comment</i>
    </button>
</section> -->
<head>

<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../../assets/css/slider.css" />
<link rel="stylesheet" href="../../assets/css/modal.css" />
<link rel="stylesheet" href="../../assets/css/profile.css" />

<link rel="stylesheet" href="../../assets/css/chatbox.css">
<link rel="stylesheet" href="../../assets/css/style.css">
<link rel="stylesheet" href="../../assets/css/footer.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
<script src="https://kit.fontawesome.com/7846b9013f.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>


<body>
    <?php 
          include '../../includes/components/nav.php';
          include '../../includes/components/accountModal.php';?>
<section class="chat-background">
    <video src="..\..\assets\media\waves.mp4" muted loop autoplay preload="auto"></video>

</section>

<section class="chat-container-main">
        <button class="chat-btn" hidden> 
            <i class="fa-solid fa-comments fa-xl"> </i>
        </button>
        <div class="wrapper-main chat-popup show">
            <!-- USERS AREA #################################################### -->
            <section class="users">
                <header class="user-header">
                    <div class="content">
                        <?php 
                        echo '
                        <img src="../../assets/img/users/traveler/'.$_SESSION['id'].'/pfp/'.$_SESSION['profpic'].'" alt="">
                        <div class="details">
                            <a href="..\..\user-profile.php?mode=view&id='.$_SESSION['id'].'" target="_blank">
                            <span>'.$_SESSION['fullname'].'</span>
                            </a>
                            <p></p>
                        </div>'
                        ?>
                    </div>
                </header>
                <div class="search">
                    <span class="text">Start a conversation or search</span>
                    <input type="text" name="" id="" placeholder="Search a name">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="users-list">

                </div>
            </section>

            <!-- CHAT AREA #################################################### -->
            <?php 
            if($sendto != null){
            echo  '<section class="chat-area">
                    <header class="header-container">
                        <a href="#"></a>
                        <img src="../../assets/img/users/traveler/'.$vo['id'].'/pfp/'.$vo['profpicture'].'" alt="Profile">
                        <div class="details">
                            <span>'.$vo['fullname'].'</span>
                            <p><a href="..\..\user-profile.php?mode=view&id='.$vo['id'].'" target="_blank">Say Hi!</a></p>
                        </div>
                    </header>
                    <div class="chat-box extended" id="chat-box">
                    </div>
                    <form action="#" class="typing-area">
                        <input type="hidden" name="outgoing_id" value="'.$vo['id'].'">
                        <input type="hidden" name="incoming_id" value="'.$myid.'">
                        <input type="text" class="input-field" name="message" id="" placeholder="Send a message...">
                        <button><i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                </section>';}
            else
                echo '<section class="chat-area chat-area-free">
                    <div class="free">
                        <img src="..\..\assets\img\conversation.png">
                        <span>
                            Click a user to start chatting
                        </span>
                    </div>
                </section>';
            ?>
        </div>
        

        <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.1.1/dist/index.min.js"></script>
        <script async src="../../assets/js/chatboxgetuser.js"></script>
        <script async src="../../assets/js/chatbox.js"></script>

        <script>
            
            
        </script>

</section>

<footer class="site-footer">
    <div class="container">
      <div class="logo">
        <img src="../../assets/img/logo.png" alt="" />
      </div>
      <div class="abt">
        <h1>About</h1>
        <p>Lakbayan Travel and Tours will provide a convenient and
          premium travel and tour service for local destinations in the
          Philippines. Lakbayan Travel and Tours offers tourists destinations
          that they would love and relax in. We also provide essential
          information to clients so that they are familiar with the culture of
          their chosen places.</p>
      </div>
      <div class="quick-links">
        <h1>Quick Links</h1>
        <ul>
          <li><a href="../../index.html">Home</a></li>
          <li><a href="../../destinations.html">Destinations</a></li>
          <li><a href="../../packages.html">Packages</a></li>
          <li><a href="../../about.html">About</a></li>
        </ul>
      </div>
      <div class="soc-med">
        <h1>Contact Us</h1>
        <div class="contact">
          <div class="info">
            <span><i class="fas fa-phone-alt"></i></span>
            <p>0961 285 3038</p>
          </div>
          <div class="info">
            <span><i class="fas fa-map-marker-alt"></i></span>
            <p>Manila, Philippines</p>
          </div>
        </div>

        <div class="icons">
          <a href="facebook.com"><i class="fab fa-facebook-f"></i></a>
          <a href="twitter.com"><i class="fab fa-twitter"></i></a>
          <a href="instagram.com"><i class="fab fa-instagram"></i></a>
          <a href="youtube.com"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>
</body>
<!-- <script async src="../../assets/js/chatboxuser.js"></script> -->


