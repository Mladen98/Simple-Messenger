let circle = document.querySelectorAll(".modal-body .content #circle");

let usernames = [];

for(i = 0; i < circle.length; i++) {

    const tag = circle[i];

    tag.onclick = () => {

        if(!tag.classList.contains("active")) {
            tag.classList.add("active");
        }

        else {
            tag.classList.remove("active");
        }
    }

    
}

console.log(usernames);




/*circle.onclick = () => {

    if(!circle.classList.contains("active")) {
        circle.classList.add("active");

        usernames.value += usr.value;
        usernames.value += ", "
    }
    else {
        circle.classList.remove("active");
        usernames.value -= ", ";
        usernames.value -= usr.value;

        if(usernames.value == "NaN") {
            usernames.value = "";
        }
    }
}*/



