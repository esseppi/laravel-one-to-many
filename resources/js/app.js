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
// FORM DI ELIMINAZIONE
const button = document.querySelectorAll(".deleteButton");
const form = document.querySelector("#deleteForm");

button.forEach((button) => {
    button.addEventListener("click", function () {
        form.action = this.dataset.base + "/" + this.dataset.id;
    });
    console.log(form.action);
});

// GENERATORE SLUGGER COIN
const btnSlugger = document.querySelector("#btn-slugger");
if (btnSlugger) {
    btnSlugger.addEventListener("click", function () {
        const eleSlug = document.querySelector("#slug");
        const eleImage = document.querySelector("#image");
        const eleDescription = document.querySelector("#description");
        const name = document.querySelector("#name").value.toLowerCase();
        console.log("https://api.coingecko.com/api/v3/coins/${name}");

        Axios.post("/admin/slugger", {
            generatorString: name,
        }).then(function (response) {
            eleSlug.value = response.data.slug;
        });
        Axios.get(`https://api.coingecko.com/api/v3/coins/${name}`).then(
            function (response) {
                eleImage.value = response.data["image"]["large"];
                eleDescription.value = response.data["description"]["en"];
            }
        );
    });
}

// logged user
const userId = document.querySelector("#userId").innerHTML;

// data del trade
const date = document.getElementById("date");

// info di rates
const baseUsd = document.querySelector("#baseCoinUsd"); //cambio coin 1 vs usd
const foreignUsd = document.querySelector("#foreignCoinUsd"); //cambio coin 2 vs usd
const exRate = document.querySelector("#tradePrice"); //coin1 / coin2

// GENERATORE INFORMAZIONI PAGINA TRADE
const btnGenerator = document.querySelector("#btnGenerator");
if (btnGenerator) {
    btnGenerator.addEventListener("click", function () {
        // nomi coin to exchange
        var coinBase = document.querySelector("#coin1").value.toLowerCase();
        var coinForeign = document.querySelector("#coin2").value.toLowerCase();
        // GENERAZIONE SLUG
        const eleSlugTrade = document.querySelector("#slugRes");
        const tradeDir = document.querySelector("#tradeDir").value;
        const name = coinBase + tradeDir + coinForeign + userId;
        Axios.post("/admin/slugger", {
            generatorString: name,
        }).then(function (response) {
            eleSlugTrade.value = response.data.slug;
        });

        // INSERIMENTO PREZZI IN BASE ALLA DATA
        var input = date.value;
        input = date.value.split("-");
        const day = input[2];
        const month = input[1];
        const year = input[0];

        // axios calls
        const reqOne = Axios.get(
            `https://api.coingecko.com/api/v3/coins/${coinBase}/history?date=${day}-${month}-${year}`
        );
        const reqTwo = Axios.get(
            `https://api.coingecko.com/api/v3/coins/${coinForeign}/history?date=${day}-${month}-${year}`
        );
        // AXIOS RATE CALLS
        Axios.all([reqOne, reqTwo])
            .then(
                Axios.spread((...responses) => {
                    exRate.value =
                        responses[0].data.market_data.current_price.usd /
                        responses[1].data.market_data.current_price.usd;
                    baseUsd.value =
                        responses[0].data.market_data.current_price.usd;
                    foreignUsd.value =
                        responses[1].data.market_data.current_price.usd;
                    console.log(baseUsd);
                    console.log(foreignUsd);
                })
            )
            .catch((errors) => {
                // react on errors.
            });
    });
}
