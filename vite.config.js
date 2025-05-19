import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/map.js",
                "resources/js/bar-chart.js",
                "resources/js/treemap-chart.js",
            ],
            refresh: true,
        }),
    ],
});
