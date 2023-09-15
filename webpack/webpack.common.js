const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
module.exports = (isDevelopment, webpackConfigJson) => {
	return {
		entry: webpackConfigJson.entry,
		output: {
			filename: webpackConfigJson.output.filename,
			path: path.resolve(__dirname, '../', webpackConfigJson.output.path)
		},
		module: {
			rules: [
				{
					test: /\.scss$/,
					use: [
						isDevelopment ? 'style-loader' : MiniCssExtractPlugin.loader,
						'css-loader',
						'sass-loader',
					],
				},
				{
					test: /\.js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader',
					},
				},
				{
					test: /\.css$/,
					use: [
						isDevelopment ? 'style-loader' : MiniCssExtractPlugin.loader,
						'css-loader'
					]
				},
				{
					test: /\.svg$/,
					use: 'svg-inline-loader'
				},
			],
		},
		plugins: [
			new CleanWebpackPlugin({
				cleanOnceBeforeBuildPatterns: webpackConfigJson.plugins.CleanWebpackPlugin.cleanOnceBeforeBuildPatterns,
			}),
		],
	};
};
