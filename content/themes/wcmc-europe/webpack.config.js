const devMode = process.env.NODE_ENV !== "production"
const path = require("path"),
  { VueLoaderPlugin } = require('vue-loader'),
  { HotModuleReplacementPlugin } = require('webpack'),
  Dotenv = require('dotenv-webpack')

module.exports = {
  mode: devMode ? "development" : "production",
  entry: {
    app: './src/js/app.js',
    vendor: ['vue', './src/js/vendor.js']
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist/build/js'),
    publicPath: './dist/build/'
  },
  plugins: [
    new Dotenv(),
    new HotModuleReplacementPlugin(),
    new VueLoaderPlugin()
  ],
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        loader: 'babel-loader',
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader',
      },
      {
        test: /\.(svg|png|jpg|gif)$/,
        use: {
          loader: "file-loader",
          options: {
            name: "[name].[hash].[ext]"
          }
        }
      }
    ]
  },
  resolve: {
    extensions: ['.js'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    }
  }
}
