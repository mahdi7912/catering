import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
import fa from "vuetify/es5/locale/fa";
import en from "vuetify/es5/locale/en";

Vue.use(Vuetify)

export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: '#3f51b5',
                secondary: '#696969',
                accent: '#8c9eff',
                error: '#b71c1c',
                yellow: "#fe940a",
            },
        },
    },
    rtl: true,
    lang: {
        locales: { fa, en },
        current: "fa"
    },
})
