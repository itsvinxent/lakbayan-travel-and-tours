const popup = document.querySelector('.chat-popup');
const chatBtn = document.querySelector('.chat-btn');


// const submitBtn = document.querySelector('.submit');
// const chatArea = document.querySelector('.chat-area');
// const inputElm = document.querySelector('.inputmessage');
// const emojiBtn = document.querySelector('#emoji-btn');
// const picker = new EmojiButton();


// Emoji selection  
// window.addEventListener('DOMContentLoaded', () => {

//     picker.on('emoji', emoji => {
//       document.querySelector('input').value += emoji;
//     });
  
//     emojiBtn.addEventListener('click', () => {
//       picker.togglePicker(emojiBtn);
//     });
//   });        

//   chat button toggler 

chatBtn.addEventListener('click', ()=>{
    popup.classList.toggle('show');
    scrollToBottom("chat-box");
})

const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box"),
chatFree = document.querySelector("section .chat-area-free"),
chatArea = document.querySelector("section .chat-area");

form.onsubmit = (e)=>{
    e.preventDefault();
}

const scrollToBottom = (id) => {
    const element = document.getElementById(id);
    element.scrollTop = element.scrollHeight;
}

var idletime = 0;

$(document).ready(function (){
    setInterval(timerAdd, 1000);

    $(this).mousemove(function(e){
        idletime = 0;
    });

    $(this).keypress(function(e){
        idletime = 0;
    });
})

function timerAdd(){
    idletime++;

    console.log(idletime);
    if(idletime == 2){
        clearInterval(getchatInterval);
        visitduration(visit_seconds);
        visit_seconds = 0;
    }
    else if(idletime == 1){
        clearInterval(getchatInterval);
        startInterval();
        visit_seconds++;
    }
}

window.addEventListener("load", (event) => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../backend/chat/chatget.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                scrollToBottom("chat-box");
            }
        }
    }
    

    let formData = new FormData(form);
    xhr.send(formData);

})

sendBtn.onclick = () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../backend/chat/chatsend.php", true);
    xhr.onload =()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value ="";
                scrollToBottom("chat-box");
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}

var getchatInterval;

// startInterval();

function startInterval() {
    getchatInterval = setInterval(()=>{
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../../backend/chat/chatget.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                }
            }
        }
    
        let formData = new FormData(form);
        xhr.send(formData);
    }, 950)
}





