function manage(a){
    const manageBtn = document.getElementsByClassName("manageBtn");
    const manage = document.getElementsByClassName("manage");

    for (let i = 0; i < manageBtn.length; i++) {
        manageBtn[i].classList.remove("active")
    }
    for (let i = 0; i < manage.length; i++) {
        manage[i].classList.add("disable")
    } 

    document.getElementById(a+"Btn").classList.add("active");
    document.getElementById(a).classList.remove("disable")
}