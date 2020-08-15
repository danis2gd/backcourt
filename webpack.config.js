var Encore = require('@symfony/webpack-encore');

// var CopyWebpackPlugin = require('copy-webpack-plugin');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    //js entry
    .addEntry('main', './assets/js/entry_points/main.js')
    .addEntry('app', './assets/js/entry_points/app.js')
    .addEntry('parsley', './assets/js/entry_points/parsley.js')
    .addEntry('news_slider', './assets/js/components/news_slider.js')
    .addEntry('components', './assets/js/components/_components.js')

    //css entry
    .addStyleEntry('landing', './assets/scss/_landing.scss')
    .addStyleEntry('login', './assets/less/pages/login.less')
    .addStyleEntry('register', './assets/less/pages/register.less')

    .splitEntryChunks()
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    // enables Less support
    .enableLessLoader(() => {}, {
        options: {
            javascriptEnabled: true
        }
    })
    // enable SASS
    .enableSassLoader()

    .enableReactPreset()
    .autoProvidejQuery()

    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })
;

module.exports = Encore.getWebpackConfig();
