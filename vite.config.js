import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/frontend.js',
                'resources/js/Admin/admin.js',
                'resources/js/include.js'

            ],
            refresh: true,
        }),
    ],
});
