document.addEventListener("DOMContentLoaded",() => {
    const username = document.querySelector("#username");
    const mail = document.querySelector("#mail");
    const fname = document.querySelector("#fname");
    const lname = document.querySelector("#lname");
    const password = document.querySelector("#password");
    const cpassword = document.querySelector("#cpasswd");

    const button = document.querySelector("#btn");

    let mailChecked=true,userChecked=true,passwordChecked=true,fnameChecked=true,lnameChecked=true;
    
    // var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    //return regex.test(email);
    const emailValidation = () => {
        let checked = true;
        let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if(regex.test(mail.value))
        {
            checked = false;
            mail.classList.remove("email-invalid");
            mail.classList.add("email-valid");
            
        }else{
            checked = true;
            mail.classList.remove("email-valid");
            mail.classList.add("email-invalid");
        }

        return checked;
    }

    const userValidation = (number,event) => {
        let checked = true;
        if(event.target.value.length > 0 && event.target.value.length <= number)
        {
            event.target.classList.remove("email-invalid");
            event.target.classList.add("email-valid");
            checked=false;
        }else{
            checked = true;
            event.target.classList.remove("email-valid");
            event.target.classList.add("email-invalid");
        }

        return checked;
    }
    

    const passwordValidation = (number) => {
        let checked = true;

        
        if (password.value === cpassword.value) {
            
            checked = false;
            password.classList.remove("email-invalid");
            cpassword.classList.remove("email-invalid");
            password.classList.add("email-valid");
            cpassword.classList.add("email-valid");
        } else {
            checked=true;
            password.classList.add("email-invalid");
            cpassword.classList.add("email-invalid");
            password.classList.remove("email-valid");
            cpassword.classList.remove("email-valid");
        }

        return checked;
    }

    // const verifForm = () => {
    //     if(!mailChecked && !passwordChecked && !fnameChecked && !lnameChecked && !userChecked)
    //     {
    //         button.disabled=true;
    //     }else{
    //         button.disabled=true;
    //     }
    // }

    mail.addEventListener("input",() => {         
        mailChecked = emailValidation();
        
    })
    username.addEventListener("input",(e) => {
        userChecked = userValidation(15,e);
        
    })
    fname.addEventListener("input",(e) => {
        fnameChecked = userValidation(50,e);
        

    })
    lname.addEventListener("input",(e) => {
        lnameChecked = userValidation(50,e);
        

    })

    password.addEventListener("input", () => {
        passwordChecked = passwordValidation(1);
        

    })

    cpassword.addEventListener("input",() =>{
        passwordChecked = passwordValidation(2);
        

    })



})
