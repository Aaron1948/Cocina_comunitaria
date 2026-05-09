
// Mostrar la contraseña al hacer click.
const check_password = document.getElementById("mostrar");
const password = document.getElementById("password");

check_password.addEventListener("click", function(){
    mostrarPassword(password);
});

function mostrarPassword(pass_input){
    if(pass_input.type === "password"){
        pass_input.type = "text";
    }else{
        pass_input.type = "password";
    }
}


