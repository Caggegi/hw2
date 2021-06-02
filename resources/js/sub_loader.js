//carico la lista delle iscrizioni
//call chi_segue (hash_spettatore)

function onSubResponse(response){
    return response.json();
}

function onSubList(jsonSubList){
    const subs = document.querySelector("div#sub_container");
    for(let element of jsonSubList){
        const img = document.createElement("img");
        img.src = element.profile_pic;
        const name = document.createElement("h5");
        name.textContent = element.username;
        const cont = document.createElement("div");
        cont.classList.add("subscription");
        cont.appendChild(img);
        cont.appendChild(name);
        subs.appendChild(cont);
    }
}

fetch('subscriptions').then(onSubResponse).then(onSubList);
