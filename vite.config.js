import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['public/scss/app.css', 'public/scss/app.scss', 'public/js/app.js'],
            refresh: true,
        }),
    ],
});
