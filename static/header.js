window.onload = ()=>{
    const link = document.querySelector("nav a#not-connected")
    console.log(link)
    console.log("hello")
    if(link) 
    {
        console.log("ok")
        link.innerText = "connexion"
        link.href = "/~moaliouche/tp-php/Root-iyi/controllers/login.php"
    }   
}