import dotenv from 'dotenv';
import { defineConfig } from 'vite';
import eslint from 'vite-plugin-eslint';
import stylelint from 'vite-plugin-stylelint';

dotenv.config();

const fileWithHash = ['app', 'admin', 'app.css', 'admin.css'];

export default defineConfig({
    publicDir: 'wordpress/resources/static',
    build: {
        assetsDir: '',
        emptyOutDir: true,
        manifest: true,
        outDir: `wordpress/wp-content/themes/${process.env.WP_DEFAULT_THEME}/assets`,
        rollupOptions: {
            input: {
                'admin': 'resources/scripts/admin.js',
                'app': 'resources/scripts/app.js',
            },
            output: {
                entryFileNames: (file) => {
                    return fileWithHash.includes(file.name) ? `[name]-[hash].js` : '[name].js'; //Hash only for files in fileWithHash array
                },
                chunkFileNames: '[name].js',
                assetFileNames: (assetInfo) => {
                    // Move all img files to img folder
                    if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(assetInfo.name.split('.').at(1))) {
                        return `img/[name][extname]`;
                    }

                    if (fileWithHash.includes(assetInfo.name)) {
                        return `[name]-[hash][extname]`;
                    }

                    return `[name][extname]`;
                },
            }
        },
    },
    plugins: [
        {
            name: 'php',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.php')) {
                    server.ws.send({ type: 'full-reload', path: '*' });
                }
            },
        },
        stylelint({
            build: true
        })
    ],
});

