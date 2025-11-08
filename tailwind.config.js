import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    white: "#FFFFFF",
                    navy: "#0B1E3D", // Deep dark navy inspired by Balinese night sky
                    gold: "#D4AF37", // Warm Balinese gold accent
                    sand: "#F5F3EE", // Soft near-white background
                    stone: "#E6E1D5", // Subtle divider / border
                },
            },
            boxShadow: {
                subtle: "0 1px 3px 0 rgba(0,0,0,0.06), 0 1px 2px -1px rgba(0,0,0,0.04)",
                elevated:
                    "0 4px 12px -2px rgba(0,0,0,0.08), 0 2px 4px -2px rgba(0,0,0,0.04)",
            },
            backgroundImage: {
                "brand-radial":
                    "radial-gradient(circle at 30% 30%, rgba(212,175,55,0.08), transparent 60%)",
                "brand-gradient": "linear-gradient(135deg,#0B1E3D,#132c54)",
            },
        },
    },

    plugins: [forms],
};
