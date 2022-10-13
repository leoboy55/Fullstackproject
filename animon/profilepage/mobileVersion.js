let animeWrapper = document.getElementById("wrapperAnimeList");
let animeBox = document.getElementsByClassName("animeBox");
let watchMediaPhone = window.matchMedia("(max-width: 751px)");
let watchMediaIpad = window.matchMedia("(max-width: 1024)");


function disableAnimeWrapperPhone(watchMediaPhone){
    if(watchMediaPhone.matches) {
        animeWrapper.style.height = "1100px";
        }
    else {
        animeWrapper.style.height = "400px";
    }
}


watchMediaPhone.addListener(disableAnimeWrapperPhone);

disableAnimeWrapperPhone(watchMediaPhone);