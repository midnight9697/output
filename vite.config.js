import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import react from '@vitejs/plugin-react';

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
                
                // Login
                'resources/js/login/index.js',
                'resources/js/login/forgot_password.js',
                'resources/js/login/login.js',
                'resources/js/login/pagination.js',
                'resources/js/login/reset_password.js',
                'resources/js/login/validation.js',

                // Dashboard
                'resources/js/home.js',
                // PR
                'resources/js/PR/index.js',
                'resources/js/PR/create.js',
                'resources/js/PR/update.js',
                'resources/js/PR/process.js',
                'resources/js/PR/tracking.js',
                'resources/js/PR/validation.js',
                'resources/js/PR/purchase_request.js',

                // Users
                'resources/js/User/Index.js',
                'resources/js/User/action_original.js',
                'resources/js/User/update.js',
                'resources/js/User/action.js',
                'resources/js/User/update.js',
                'resources/js/User/User.js',
                'resources/js/User/Validation.js',

                // Supplemental
                'resources/js/supplemental/index.js',
                'resources/js/supplemental/create.js',
                'resources/js/supplemental/supplemental.js',
                'resources/js/supplemental/update.js',
                'resources/js/supplemental/validation.js',
                'resources/css/supplemental.css',

                 // PPMP
                 'resources/js/ppmp/index.js',
                 'resources/js/ppmp/ppmp.js',
                 'resources/js/ppmp/validation.js',

                  // APP
                  'resources/js/app/index.js',
                  'resources/js/app/app.js',
                  'resources/js/app/validation.js',

                  // ABSTRACT
                  'resources/js/abstract/index.js',
                  'resources/js/abstract/create.js',
                  'resources/js/abstract/abstract.js',
                  'resources/js/abstract/add_bidder.js',
                  'resources/js/abstract/validation.js',

                    //   SUPPLIER
                    'resources/js/supplier/index.js',
                    'resources/js/supplier/supplier.js',
                    'resources/js/supplier/create.js',
                    'resources/js/supplier/validation.js',
                    
                    // RFQ
                    'resources/js/rfq/index.js',
                    'resources/js/rfq/rfq.js',
                    'resources/js/rfq/create.js',
                    'resources/js/rfq/update.js',

                    // table
                    'resources/js/table/buttons.js',
                    'resources/js/table/custom_table.js',
                    // 'resources/js/table/pdf-1.js',
                    // 'resources/js/table/pdf.js',
                    // 'resources/js/table/table-normal.js',

                    // IEPMC
                    'resources/js/iepmc/index.js',
                    'resources/js/iepmc/iepms.js',
                    'resources/js/iepmc/create.js',
                    'resources/js/iepmc/update.js',
                    'resources/js/iepmc/validation.js',
                ],
            refresh: true,
        }),
        // react()
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
