const path = require('path');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = (webpackConfigJson) => {
	return {
		plugins: [
			new BrowserSyncPlugin({
				host: webpackConfigJson.plugins.BrowserSyncPlugin.host,
				port: webpackConfigJson.plugins.BrowserSyncPlugin.port,
				proxy: webpackConfigJson.url,
				files: webpackConfigJson.plugins.BrowserSyncPlugin.files,
				notify: true,
				injectChanges: true,
				reload: true,
			}),
		],
		devServer: {
			headers: {
				'Access-Control-Allow-Origin': '*',
			},
			static: {
				directory: path.join(__dirname, webpackConfigJson.devServer.static.directory),
			},
			watchFiles: {
				options: {
					usePolling: webpackConfigJson.devServer.watchFiles.options.usePolling,
					interval: webpackConfigJson.devServer.watchFiles.options.interval,
				},
				paths: webpackConfigJson.devServer.watchFiles.paths,
			},
			compress: true,
			port: webpackConfigJson.devServer.port
		},
	};
};
