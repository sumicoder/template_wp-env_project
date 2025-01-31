const fs = require('fs');
require('dotenv').config();
const wpThemeName = process.env.WP_THEME_NAME;

if (!wpThemeName) {
    console.error('❌ Error: WP_THEME_NAME is not set in .env file');
    process.exit(1);
}

const wpEnvConfig = {
    core: 'https://ja.wordpress.org/latest-ja.zip',
    phpVersion: null,
    plugins: [],
    themes: [],
    config: {
        WP_DEBUG: true,
    },
    port: 12345,
    env: {
        tests: {
            port: 12346,
        },
    },
    mappings: {
        [`wp-content/themes/${wpThemeName}/`]: `./dist/${wpThemeName}/`,
        'wp-content/plugins/': './dist/plugins/',
        'wp-content/uploads/': './dist/uploads/',
        sql: './sql/',
        '.htaccess': '.htaccess',
    },
};

fs.writeFileSync('.wp-env.json', JSON.stringify(wpEnvConfig, null, 4));
