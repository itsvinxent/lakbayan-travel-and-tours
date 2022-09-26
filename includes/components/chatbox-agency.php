
<?php 
    
    $loc = "assets/img/logo.png";
       
    
?> 

<!-- <section>
    <link rel="stylesheet" href="assets\css\chatbox.css">

    <h1>Chat Popup</h1>
    <p>Click on the chat to start</p>

    <button class="chat-btn">
        <i class="material-icons">comment</i>
    </button>
</section> -->

<section>
        <button class="chat-btn"> 
            <i class="material-icons"> comment </i>
        </button>

        <div class="chat-popup">
            <div class="badge">1</div>
            <div class="chat-area">
            <?php
            if ($isAgency != true){
             echo '<div class="income-msg">
                        <img src="'.$loc.'" class="avatar" alt="">
                        <span class="msg"> Hi, How can I help you?</span>
                   </div>';   
                }
            else {
                echo '
                    <div class="out-msg">
                     <span class="my-msg">Hi, How can I help you?</span>
                     <img src="'.$loc.'" class="avatar">
                    </div>
                    <div class="income-msg">
                        <img src="assets/img/JM.jpeg" class="avatar" alt="">
                        <span class="msg"> How much is the price? and the inclusions? </span>
                   </div>';   
            }
            ?>
            </div>

            <div class="input-area">
                <input type="text" class="inputmessage">
                <!-- <button id="emoji-btn"> &#127773;</button> -->
                <button class="submit"> <i class="material-icons"> send</i></button>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.1.1/dist/index.min.js"></script>
        <script src="assets/js/chatbox.js"></script>
</section>


