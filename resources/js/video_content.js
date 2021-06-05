document.querySelector("div#common").addEventListener("click", onSubPressed);
document.querySelector("div#premium").addEventListener("click", onSupPressed);
let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function onSubPressed(event){
  if(!event.currentTarget.classList.contains("no-session")){
    if(event.currentTarget.classList.contains("subscribe")){
      event.currentTarget.classList.remove("subscribe");
      event.currentTarget.classList.add("subscribed");
      document.querySelector("p#t_c").textContent = "iscritto";
      fetch('/hw2/public/subscribe', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token,
            'Content-type': 'application/x-www-form-urlencoded'
        },
        method: 'POST',
        body: JSON.stringify({
          creator: event.currentTarget.dataset.creator
        })
      });
    } else if(event.currentTarget.classList.contains("subscribed")){
      event.currentTarget.classList.remove("subscribed");
      event.currentTarget.classList.add("subscribe");
      document.querySelector("p#t_c").textContent = "iscriviti";
      fetch('/hw2/public/unsubscribe', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token,
            'Content-type': 'application/x-www-form-urlencoded'
        },
        method: 'POST',
        body: JSON.stringify({
          creator: event.currentTarget.dataset.creator
        })
      });
    }
  } else {
    window.location.href = "/hw2/public/login";
  }
}

function onSupPressed(event){
  if(!event.currentTarget.classList.contains("no-session")){
    if(event.currentTarget.classList.contains("support")){
      event.currentTarget.classList.remove("support");
      event.currentTarget.classList.add("supporting");
      document.querySelector("p#t_p").textContent = "abbonati";
      fetch('/hw2/public/support', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token,
            'Content-type': 'application/x-www-form-urlencoded'
        },
        method: 'POST',
        body: JSON.stringify({
          creator: event.currentTarget.dataset.creator
        })
      });
    } else if(event.currentTarget.classList.contains("supporting")){
      event.currentTarget.classList.remove("supporting");
      event.currentTarget.classList.add("support");
      document.querySelector("p#t_p").textContent = "abbonato";
      fetch('/hw2/public/unsupport', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token,
            'Content-type': 'application/x-www-form-urlencoded'
        },
        method: 'POST',
        body: JSON.stringify({
          creator: event.currentTarget.dataset.creator
        })
      });
    } else if(event.currentTarget.classList.contains("not_premium"))
      window.location.href = "/hw2/public/join_us";
  } else {
    window.location.href = "/hw2/public/login";
  }
}
