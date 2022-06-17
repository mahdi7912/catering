import Vue from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue";
import { InertiaProgress } from "@inertiajs/progress";
import vuetify from "./vuetify";
import store from "./store/index";
import Majra from "majra";

// axios
window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// majra
Vue.use(Majra, {
    store,
    configs: {
        FILTER_URL: "/api/admin/filter",
        BASE_URL: "/",
        axios: {
            instance: window.axios,
        },
        WITH_KEY: false,
    },
});

// inertia
InertiaProgress.init();

createInertiaApp({
    resolve: (name) => import(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        Vue.use(plugin);

        new Vue({
            store,
            vuetify,
            render: (h) => h(App, props),
        }).$mount(el);
    },
});
