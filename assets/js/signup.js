
const signup = document.getElementById('submit');

signup.addEventListener('click', () => {
    console.log("test");
    const error = document.getElementById('error')
    const lastname = document.getElementById('lastname_error')
    const email = document.getElementById('email_error')
    const password = document.getElementById('password_error')
    const file = document.getElementById('pic_error')

    const FormVa = document.getElementById('formvalidation')

    const req = new XMLHttpRequest()
    req.onreadystatechange = async ()=> {
        if(req.readyState === XMLHttpRequest.DONE && req.status === 200){
            let data = JSON.parse(req.response)
            console.log(data)
            if(data.success !== ''){
                location.href = 'index.php?page=login'
            }else{
                error.textContent = data.errors
            }
        }
    }
    req.open('POST', 'index.php?page=signup', true)
    let registerForm = new FormData(FormVa)
    req.send(registerForm)
    
    
});