document.querySelector("div#sub_buttons div#subscribe").addEventListener("click", onSubscribe);
document.querySelector("div#sub_buttons div#support").addEventListener("click", onSupport);

function onSubscribe(event){
    if(event.currentTarget.classList.contains("subscribe")){
        event.currentTarget.classList.remove("subscribe");
        event.currentTarget.classList.add("subscribed");
        event.currentTarget.querySelector("p").textContent = "iscritto";
        const action = new FormData();
        action.append("action", "subscribe");
        action.append('tipo', 'segue');
        action.append("creator", event.currentTarget.dataset.creator);
        fetch("php/subscribe.php", {
            'method': 'post',
            'body': action
        });
    } else{
        event.currentTarget.classList.remove("subscribed");
        event.currentTarget.classList.add("subscribe");
        event.currentTarget.querySelector("p").textContent = "iscriviti";
        const action = new FormData();
        action.append("action", "unsubscribe");
        action.append('tipo', 'segue');
        action.append("creator", event.currentTarget.dataset.creator);
        fetch("php/subscribe.php", {
            'method': 'post',
            'body': action
        });
    }
}

function onSupport(event){
    if(event.currentTarget.classList.contains("support")){
        event.currentTarget.classList.remove("support");
        event.currentTarget.classList.add("supporting");
        event.currentTarget.querySelector("p").textContent = "abbonato";
        const action = new FormData();
        action.append("action", "subscribe");
        action.append('tipo', 'abbonamento');
        action.append("creator", event.currentTarget.dataset.creator);
        fetch("php/subscribe.php", {
            'method': 'post',
            'body': action
        });
    } else{
        event.currentTarget.classList.remove("supporting");
        event.currentTarget.classList.add("support");
        event.currentTarget.querySelector("p").textContent = "abbonati";
        const action = new FormData();
        action.append("action", "unsubscribe");
        action.append('tipo', 'abbonamento');
        action.append("creator", event.currentTarget.dataset.creator);
        fetch("php/subscribe.php", {
            'method': 'post',
            'body': action
        });
    }
}
