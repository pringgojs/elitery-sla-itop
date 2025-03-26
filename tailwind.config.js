import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
        "./node_modules/preline/dist/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                "border-gradient": {
                    "0%, 100%": {
                        "border-color": "rgba(0, 143, 255, 1)",
                    },
                    "50%": {
                        "border-color": "rgba(255, 0, 143, 1)",
                    },
                },
                gradient: {
                    "0%, 100%": {
                        "background-size": "200% 200%",
                        "background-position": "left center",
                    },
                    "50%": {
                        "background-size": "200% 200%",
                        "background-position": "right center",
                    },
                },
            },
            animation: {
                "border-gradient": "border-gradient 3s infinite",
                gradient: "gradient 3s ease infinite",
            },
        },
    },

    plugins: [
        forms,
        typography,
        require("flowbite/plugin")({
            charts: true,
        }),
        require("preline/plugin"),
    ],
};
