import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    server: {
        // host: '172.16.6.103', // Or your specific IP address, e.g., '192.168.1.100'
        // hmr: { // Optional: if you need to specify a different host for HMR
        //     host: 'localhost',
        // }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                // 'resources/js/User/User.js',
            ],
            refresh: true,
        }),
        react()
    ],
    // server: {
    //     host: '172.16.6.103',
    //     port: 5173,
    //     hmr: {
    //         host: '172.16.6.103', // Change this value for your local network ip address
    //         port: 8000, // Or your app's standard port
    //     },
    //     headers: {
    //     	'Access-Control-Allow-Origin': '172.16.6.103',
    //     },
    //   }
});
