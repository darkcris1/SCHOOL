document.addEventListener("DOMContentLoaded", ()=> {
    const navbarItems = document.querySelectorAll("#navbar li");

    navbarItems.forEach((item)=> {
        const link = item.querySelector("a");
        const href = link.getAttribute("href");
        
        if (window.location.pathname.indexOf(href) > -1) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
});

