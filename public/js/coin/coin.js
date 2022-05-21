const button = document.querySelectorAll(".deleteButton");
const form = document.querySelector("#deleteForm");

button.forEach((button) => {
    button.addEventListener("click", function () {
        console.log("ciaoooooo");
        form.action = this.dataset.base + "/" + this.dataset.id;
    });
    console.log(form.action);
});
