import { join,resolve } from 'path';
import { defineConfig, externalizeDepsPlugin } from 'electron-vite';

export default defineConfig({
     resolve: {
        alias: {
            // Fix: GitHub Actions cannot resolve "#plugin"
            "#plugin": resolve("nativephp/electron/plugins/index.js"),
        },
    },
    main: {
        build: {
            rollupOptions: {
                plugins: [
                    {
                        name: 'watch-external',
                        buildStart() {
                            this.addWatchFile(join(process.env.APP_PATH, 'app', 'Providers', 'NativeAppServiceProvider.php'));
                        }
                    }
                ]
            },
        },
        plugins: [externalizeDepsPlugin()]
    }
});
