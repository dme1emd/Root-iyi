const password = document.querySelector("input#password")
const passwordConfirmation = document.querySelector("input#passwordconf")
const submitBtn = document.querySelector(`input[type="submit"]`)
const message = document.querySelector("div.message")
console.log("first")
console.log(password)
console.log(passwordConfirmation)
password.addEventListener("input", ()=>{
    message.innerText =""
    console.log("changing")
    submitBtn.disabled = ! (password.value.length >= 8 && passwordConfirmation.value == password.value)
    if(password.value.length < 8) message.innerText += "password too short ."
    if(password.value != passwordConfirmation.value) message.innerText += "password and confirmation not matching"
})
passwordConfirmation.oninput = ()=>{
    message.innerText =""
    submitBtn.disabled = ! (password.value.length >= 8 && passwordConfirmation.value == password.value)
    if(password.value.length < 8) message.innerText += "password too short ."
    if(password.value != passwordConfirmation.value) message.innerText += "password and confirmation not matching"
}