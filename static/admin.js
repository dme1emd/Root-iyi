window.onload = ()=>{
    const buttons = document.querySelectorAll("button")
console.log(buttons)
buttons.forEach(btn => {
    btn.onclick = ()=>{
        btn.innerText = btn.innerText == "hide" ? "add challenge" :"hide"
        console.log(document.querySelector(`form.${btn.className}`).style.display)
        document.querySelector(`form.${btn.className}`).style.display = 
        getComputedStyle(document.querySelector(`form.${btn.className}`)).display == "none" ? "flex" : "none"
    }
});
}
