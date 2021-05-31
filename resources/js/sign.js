const form = document.forms["signup_form"];

let mode = 0;
const change = document.querySelector("img#change_mode");

change.addEventListener("click", changeMode);

function changeMode(event){
    if(mode===1){
        mode = 0;
        document.querySelector("input#mode").value = 0;
        event.currentTarget.src = "img/icons/chevron-down.svg";
        document.querySelector("form div#name_surname").classList.add("hidden");
        document.querySelector("input#name").value = "";
        document.querySelector("input#surname").value = "";
        document.querySelector("input#email").type = "hidden";
        document.querySelector("input#email").value = "";
        document.querySelector("input#confirm").type = "hidden";
        document.querySelector("input#confirm").value = "";
        document.querySelector("div#close_div h1").textContent = "Log In";
        document.querySelector("input#signup").value = "Log In";
    } else{
        mode = 1;
        document.querySelector("input#mode").value = 1;
        event.currentTarget.src = "img/icons/chevron-up.svg";
        document.querySelector("form div#name_surname").classList.remove("hidden");
        document.querySelector("input#email").type = "text";
        document.querySelector("input#confirm").type = "password";
        document.querySelector("div#close_div h1").textContent = "Sign Up";
        document.querySelector("input#signup").value = "Sign Up";
    }
}

form.addEventListener('submit', signup_login);

function signup_login(event){
    const modulo = event.currentTarget;
    const error = document.querySelector("div#error");
    document.querySelector("div.error").classList.add("hidden");
    error.classList.remove("hidden");
    let campo="";
    if(mode){ //è stato scelto sign up;
        if(modulo.name.value.length === 0)
            campo="nome";
        else if(modulo.surname.value.length === 0)
            campo="cognome";
        else if(modulo.email.value.length === 0)
            campo="email";
        else if(modulo.password.value.length === 0)
            campo="password";
        else if(modulo.confirm.value.length === 0)
            campo="conferma password";
        if(campo.length!==0){
            event.preventDefault();
            error.innerHTML="";
            const title = document.createElement("h3");
            title.textContent = "Voglio più dati! ԅ(≖‿≖ԅ)";
            error.appendChild(title);
            const string = document.createElement("p");
            string.textContent = "Il campo "+campo+" è vuoto, compila tutti i campi";
            error.appendChild(string);
            error.classList.remove("hidden");
        } else{
            if(modulo.confirm.value !== modulo.password.value){
                event.preventDefault();
                error.innerHTML="";
                const title = document.createElement("h3");
                title.textContent = "Battere sulla tastiera genera una password efficace... così efficace che non la sai nemmeno tu";
                error.appendChild(title);
                const string = document.createElement("p");
                string.textContent = "Assicurati che la password di conferma corrisponda con quella digitata";
                error.appendChild(string);
                error.classList.remove("hidden");
            } else {
                if(modulo.password.value.length<8){
                    event.preventDefault();
                    error.innerHTML="";
                    const title = document.createElement("h3");
                    title.textContent = "Le gambe di pinocchio sono più lunghe...";
                    error.appendChild(title);
                    const string = document.createElement("p");
                    string.textContent = "Assicurati che la password abbia più di 8 caratteri";
                    error.appendChild(string);
                    error.classList.remove("hidden");
                }
                else{
                    if(/[A-Za-z]+/.test(modulo.password.value) &&
                        /[0-9]+/.test(modulo.password.value) && /[^a-z0-9]+/i.test(modulo.password.value)){
                          const emailReg = /@./;
                          if(emailReg.test(modulo.email.value)){
                            error.classList.add("hidden");
                          } else{
                              event.preventDefault();
                              error.innerHTML="";
                              const title = document.createElement("h3");
                              title.textContent = "Torna dopo aver googlato cosa è una email";
                              error.appendChild(title);
                              const string = document.createElement("p");
                              string.textContent = "Non hai inserito un indirizzo email valido";
                              error.appendChild(string);
                              error.classList.remove("hidden");
                          }
                    }else{
                        event.preventDefault();
                        error.innerHTML="";
                        const title = document.createElement("h3");
                        title.textContent = "La tua password dovrebbe fare più palestra, così è troppo debole";
                        error.appendChild(title);
                        const string = document.createElement("p");
                        string.textContent = "La password deve contenere maiuscole e minuscole, numeri e caratteri speciali";
                        error.appendChild(string);
                        error.classList.remove("hidden");
                    }
                }
            }
        }
    } else{ //è stato scelto log in;
        if(modulo.username.value.length === 0)
            campo="username";
        else if(modulo.password.value.length === 0)
            campo="password";
        if(campo.length!==0){
            event.preventDefault();
            error.innerHTML="";
            const title = document.createElement("h3");
            title.textContent = "Penso che tu abbia bisogno di occhiali nuovi";
            error.appendChild(title);
            const string = document.createElement("p");
            string.textContent = "Il campo "+campo+" è vuoto, compila tutti i campi";
            error.appendChild(string);
            error.classList.remove("hidden");
        }
    }
}

document.querySelector("input#inp_spectator").addEventListener("click", changeSpecGIF);
document.querySelector("input#inp_creator").addEventListener("click", changeCreatGIF);

function changeSpecGIF(){
    const left_image = document.querySelector("main div.left_image");
    left_image.style.backgroundColor = "#B1B9C7";
    left_image.querySelector("img").src = "img/GIF/signup.gif"
}

function changeCreatGIF(){
    const left_image = document.querySelector("main div.left_image");
    left_image.style.backgroundColor = "#4a4b58";
    left_image.querySelector("img").src = "img/GIF/signup2.gif"
}
