require('dotenv').config({ path: '../../.env' })

module.exports = {
    lintOnSave: false,

    devServer: {
        proxy: process.env.APP_URL,
    },

    // Output built static files to Laravel's public dir.
    // Note the "build" script in package.json needs to be modified as well.
    outputDir: '../../public',

    publicPath: `${process.env.ASSET_URL || ''}/`,

    // Modify the location of the generated HTML file.
    indexPath: '../resources/views/index.blade.php',
}
