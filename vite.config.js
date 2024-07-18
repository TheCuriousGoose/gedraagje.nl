import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/app/toast.js',
                'node_modules/bootstrap-table/dist/bootstrap-table.min.js',
                'node_modules/bootstrap-table/dist/bootstrap-table.min.css',
            ],
            refresh: true,
        }),
    ],
});
