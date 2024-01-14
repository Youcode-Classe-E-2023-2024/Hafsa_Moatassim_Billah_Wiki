
const signup = document.getElementById('submit');

signup.addEventListener('click', () => {
    console.log("test");
    const firstname = document.getElementById('firstname').value;
    const lastname = document.getElementById('lastname').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const file = document.getElementById('picture').value;
    console.log(file + "file")
     console.log(firstname);
     console.log(lastname);
     console.log(email);
     console.log(password);
     console.log(file);

    var formData = new FormData();
    formData.append('firstname', firstname);
    formData.append('lastname', lastname);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('picture', file);
    formData.append('req', 'submit');
    console.log(formData);

    $.ajax({
        type: "POST",
        url: "index.php?page=signup",
        data: formData,
        processData: false,
        contentType: false,
        success: (response) => {
            const data = JSON.parse(response);
            
            if (data.success) {
                alert(data.success);
            } else if (data.errors) {
                // console.log(data.errors);
                var err= data.errors;
                console.log(err);
                if (err.firstName_err !== false) {
                    $("#First_err").text(err.firstName_err);
                } else {
                    $("#First_err").text('');
                }
            
                if (err.lastName_err !== false) {
                    $("#last_err").text(err.lastName_err);
                } else {
                    $("#last_err").text('');
                }
            
                if (err.email_err !== false) {
                    $("#email_err").text(err.email_err);
                }
            
                if (err.userexists_err !== false) {
                    $("#email_err").text(err.userexists_err);
                }
            
                if (!err.email_err && !err.userexists_err) {
                    $("#email_err").text('');
                }
            
                if (err.password_err !== false) {
                    $("#password_err").text(err.password_err);
                } else {
                    $("#password_err").text('');
                }
                
            }

        },
        error: (error) => {
            console.log(error);
        }
    })

    
});