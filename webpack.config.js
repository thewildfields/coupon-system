const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    plugins: [
      new MiniCssExtractPlugin({
        filename: "bundle.css",
      }),
    ],
    entry: {
      couponsFrontend: '/src/frontend.js',
      couponsBackend: '/src/backend.js',
    },    
    output: {
        path: path.resolve( __dirname, 'dist' ),
        filename: '[name].js',
        clean: true
    },
    module: {
        rules: [
            {
                test: /\.(sa|sc|c)ss$/i,
                use: [
                  MiniCssExtractPlugin.loader,
                  "css-loader",
                  "sass-loader",
                ],
            }
        ]
    }
}