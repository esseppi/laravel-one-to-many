/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require("axios");
const { includes } = require("lodash");
require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});

const button = document.querySelectorAll(".deleteButton");
const form = document.querySelector("#deleteForm");

button.forEach((button) => {
    button.addEventListener("click", function () {
        form.action = this.dataset.base + "/" + this.dataset.id;
    });
    console.log(form.action);
});

// GENERATORE SLUGGER
const btnSlugger = document.querySelector("#btn-slugger");
if (btnSlugger) {
    btnSlugger.addEventListener("click", function () {
        const eleSlug = document.querySelector("#slug");
        const name = document.querySelector("#name").value;

        Axios.post("/admin/slugger", {
            generatorString: name,
        }).then(function (response) {
            eleSlug.value = response.data.slug;
        });
    });

    function getUrlCoin($coin) {}
}
