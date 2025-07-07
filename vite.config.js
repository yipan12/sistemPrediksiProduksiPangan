import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/sass/landing.scss",
            ],
            refresh: true,
        }),
    ],
    build: {
        // Optimasi untuk production
        minify: "terser",
        sourcemap: false,
        rollupOptions: {
            output: {
                manualChunks: {
                    // Pisahkan CSS berdasarkan fungsi
                    "app-styles": ["resources/sass/app.scss"],
                    "landing-styles": ["resources/sass/landing.scss"],
                },
            },
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                // Suppress deprecation warnings
                quietDeps: true,
                silenceDeprecations: ["legacy-js-api"],
            },
        },
    },
});
