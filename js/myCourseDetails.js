document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("add");
    const dialog = document.getElementById("dialog");
    const cancelBtn = dialog.querySelector("#cancel"); // Corregir la selección del botón de cancelar

    btn.addEventListener("click", () => {
        dialog.showModal(); // Corregir el método para mostrar el diálogo
        document.querySelector("body").classList.add("blur");
        
    });

    cancelBtn.addEventListener("click", () => {
        dialog.close();
        
        document.querySelector("body").classList.remove("blur");
    });
});
