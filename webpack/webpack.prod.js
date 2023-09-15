const MiniCssExtractPlugin = require('mini-css-extract-plugin');


module.exports = (webpackConfigJson) => {
	return {
		plugins: [
			new MiniCssExtractPlugin({
				filename: webpackConfigJson.plugins.MiniCssExtractPlugin.filename,
			}),
		],
	};
};
