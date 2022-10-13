function SelectBrand(){
let x = document.getElementById("genre").value;
let y = document.getElementsByClassName("animeBox");

let selected = $("#genre option:selected").val();

    if(selected === "action" || selected === "mystery" || selected === "Fantasy" || selected === "romance") {
        $.ajax({
            url: "filterHandler.php",
            method: "POST",
            data: {
                id: x

            },
            success: function (data) {
                $("#ans").html(data);
                $(document).ready(function () {
                    $(y).hide();
                });
            }

        });
    } else {
        $(document).ready(function () {
            $(y).show();
            $("#ans").empty();
        });
    }
}
function declareBoxId () {
    for (let i = 0; i < 21; i++) {
        let animebox = document.getElementsByClassName("animeBox")[i];
        animebox.id = "box" + i;
    }
}

//make the popup dissapear after 1.5 seconds and retun to original page
function hidepopup(){
    window.location.href = 'http://localhost/fullstackproject/animon/Animelist/list.php';
}

function hidepopup2(){
    window.location.href = 'http://localhost/fullstackproject/animon/register/registerpage.php';
}

function ChangeButton(){
    let addButton = document.getElementById("addButton");
    addButton.remove();
}