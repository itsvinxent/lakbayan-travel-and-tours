
<?php 
    include __DIR__.'/../../backend/auth/getagency.php';
    include __DIR__.'/../../backend/connect/dbCon.php';
    
    $loc = "../../assets/img/logo.png";
       
    $testdatain = 19; //SENDER change with Session
    $testdataout = 47; //RECEIVER change with Get

    $myid = $_SESSION['id'] ?? null;
    $sendto = $_GET['agentid'] ?? null;

    if($sendto != null) {
        $vo = view_other($conn, $sendto);
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
<link rel="stylesheet" href="../../assets/css/chatbox.css">
<link rel="stylesheet" href="../../assets\css\style.css">

<!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
<script src="https://kit.fontawesome.com/7846b9013f.js" crossorigin="anonymous"></script>
</head>
<section class="chat-container">
        <button class="chat-btn"> 
            <i class="fa-solid fa-comments fa-xl"> </i>
        </button>
        <div class="wrapper chat-popup regular">
            <!-- USERS AREA #################################################### -->
            <!-- <section class="users">
                <header class="user-header">
                    <div class="content">
                        <img src="..\..\assets\img\logo.png" alt="">
                        <div class="details">
                            <span>My Name</span>
                            <p></p>
                        </div>
                    </div>
                </header>
                <div class="search">
                    <span class="text">Pick user to chat</span>
                    <input type="text" name="" id="" placeholder="Search a name">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="users-list">

                </div>
            </section> -->

            <!-- CHAT AREA #################################################### -->
            <section class="chat-area full">
                <header class="header-container">
                    <a href="#"><i class="fa-solid fa-arrow-left fa-lg"></i></a>
                    <img src="../../assets/img/users/traveler/<?php echo $vo['agencyManID']?>/pfp/<?php echo $vo['profpicture'] ?>" alt="Profile">
                    <div class="details">
                        <span><?php echo $vo['fullname']?></span>
                        <p>of <a href="..\..\agency-profile.php?mode=view&id=<?php echo $vo['agencyID']?>" target="_blank"><?php echo $vo['agencyName']?></a></p>
                    </div>
                </header>
                <div class="chat-box" id="chat-box">
                </div>
                <form action="#" class="typing-area">
                    <input type="hidden" name="outgoing_id" value="<?php echo $vo['agencyManID']?>">
                    <input type="hidden" name="incoming_id" value="<?php echo $myid?>">
                    <input type="text" class="input-field" name="message" id="" placeholder="Send a message...">
                    <button><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </section>
            <section class="chat-area chat-area-free hidden">
                <div class="free">
                    <span>
                        Click a user to start chatting
                    </span>
                </div>
            </section>
            
        </div>
        

        <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.1.1/dist/index.min.js"></script>
        <!-- <script async src="../../assets/js/chatboxgetuser.js"></script> -->
        <script async src="../../assets/js/chatbox.js"></script>

</section>

<!-- <script async src="../../assets/js/chatboxuser.js"></script> -->


