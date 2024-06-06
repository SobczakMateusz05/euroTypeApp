const pass1 = document.getElementById("pass1");
const pass2 = document.getElementById("pass2");
const passconf = document.getElementById("passconf");
const submit = document.getElementById("submit");

pass2.addEventListener("input" ,(event) =>{
    if(pass1.value==pass2.value){
        passconf.innerHTML="";
        submit.innerHTML='<input type="submit" value="Zmień hasło">';
    }
    else{   
        passconf.innerHTML="(Hasła nie są takie same)";
        submit.innerHTML="";
    }
})