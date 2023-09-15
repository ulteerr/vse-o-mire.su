const { merge } = require('webpack-merge');
const commonConfig = require('./webpack/webpack.common.js');
const developmentConfig = require('./webpack/webpack.dev.js');
const productionConfig = require('./webpack/webpack.prod.js');
const webpackConfigJson = require('./webpack/webpack.config.json');

module.exports = (env, argv) => {
  const isDevelopment = argv.mode === 'development';
  const commonConfiguration = commonConfig(isDevelopment, webpackConfigJson);
  const mergedConfig = isDevelopment
    ? merge(commonConfiguration, developmentConfig(webpackConfigJson))
    : merge(commonConfiguration, productionConfig(webpackConfigJson));

  return mergedConfig;
};
