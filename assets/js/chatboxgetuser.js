const userList = document.querySelector(".users .users-list"),
searchBar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button");

var getidletime = 0;

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active")
}

$(document).ready(function (){
    setInterval(gettimerAdd, 1000);

    $(this).mousemove(function(e){
        getidletime = 0;
    });

    $(this).keypress(function(e){
        getidletime = 0;
    });
})

function gettimerAdd(){
    getidletime++;

    console.log(getidletime);
    if(getidletime == 3){
        clearInterval(getuserinterval);
    }
    else if(getidletime == 1){
        clearInterval(getuserinterval);
        startGetInterval();
    }
}

window.addEventListener("load", (event) => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../backend/chat/chatgetusers.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                userList.innerHTML = data;
            }
        }
    }

    xhr.send();
})

searchBar.onkeyup = () =>{
    let searchTerm = searchBar.value;
    if(searchTerm != "") {
        searchBar.classList.add("active");
    }else searchBar.classList.remove("active");


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../backend/chat/chatsearch.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                userList.innerHTML = data;
                
                
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

var getuserinterval;

function startGetInterval() {
    getuserinterval = setInterval(()=>{
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../../backend/chat/chatgetusers.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(!searchBar.classList.contains("active")){
                        userList.innerHTML = data;
                    }
                }
            }
        }
    
        xhr.send();
    }, 950)
    
}

// const clickUser = document.querySelector(".users .users-list a"),
// valueId = clickUser.querySelector("input");



// clickUser.onclick = () =>{
//     let userId = valueId.value;
//     console.log(userId);
// }