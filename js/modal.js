document.addEventListener("DOMContentLoaded", () => {
    const dialog = document.getElementById("dialog");
    const a = document.getElementById("a");
    const cancel = document.getElementById("cancel");
    const main = document.getElementById("main");
    const dialogForm = document.getElementById("dialog-Form");
    
    

    a.addEventListener("click", ()=> {
        main.classList.add("blur");
        dialog.show()
        
    })

    cancel.addEventListener("click", ()=> {
        main.classList.remove("blur");
        dialog.close();
        
    })

     
})