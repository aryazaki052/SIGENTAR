import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    server: {
    host: '127.0.0.1', // supaya bisa diakses dari jaringan
    port: 5173,      // default vite port
    strictPort: true,
  },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),

        tailwindcss(),
    ],
});
