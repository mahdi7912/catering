const mix = require("laravel-mix");
const path = require("path");

mix.js("resources/js/app.js", "public/js")
    .vue()
    .css("resources/css/app.css", "public/css")
    .webpackConfig({
        resolve: {
            alias: {
                vue$: "vue/dist/vue.runtime.js",
                "@": path.resolve("resources/js"),
            },
        },
        output: {
            chunkFilename: "js/[name].js?id=[chunkhash]",
        },
    });
