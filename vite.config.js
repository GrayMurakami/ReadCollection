import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/topPage.css', 
                'resources/css/homePage.css', 
                'resources/css/contactPage.css',
                'resources/css/dashboard.css',
                'resources/css/bookShow.css',
                'resources/css/adminPage.css',
                'resources/js/topPage.js',
                'resources/js/homePage.js',
                'resources/js/login.js',
                'resources/js/register.js',
                'resources/js/modalWindows.js',
                'resources/js/resetPassword.js',
                'resources/js/manageUsers.js',
                'resources/js/manageBookManagers.js'
            ],
            refresh: true,
        }),
    ],
});
