import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    server: {
    host: '192.168.1.12', // supaya bisa diakses dari jaringan
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
