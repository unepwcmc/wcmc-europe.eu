/******************************
*  Gulp Config File
*  By UNEP-WCMC
*  https://gulpjs.com/
******************************/

'use strict'

/******************************
*  Requires
******************************/

// Gulp
const gulp = require('gulp')
const src = gulp.src
const dest = gulp.dest

// browserSync
const browserSync = require('browser-sync')
const reload = browserSync.reload

// SCSS
const sourcemaps = require('gulp-sourcemaps')
const sass = require('gulp-sass')
const concat = require('gulp-concat')
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')
const cssnano = require('cssnano')

// Webpack
var webpack = require('webpack');
var webpackStream = require('webpack-stream-fixed');

// Delete
const del = require("del")

/******************************
*  Error Handling
******************************/

// Prints details of the error in the console
function swallowError (error) {
  console.log(error.toString());
  this.emit('end')
}

/******************************
*  Paths
******************************/
const paths = {
  source: "./src",
  blocks: "./blocks",
  build: "./dist/build"
}

/******************************
*  Tasks
******************************/

// SCSS
function styles () {
  return src([
    `${paths.source}/scss/main.scss`
  ])
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest(`${paths.build}/css`))
    .pipe(reload({ stream: true }))
}

function ie11 () {
  return src([
    `${paths.source}/scss/ie.scss`
  ])
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest(`${paths.build}/css`))
    .pipe(reload({ stream: true }))
}

function blockStyles () {
  return src([
    `${paths.blocks}/**/*.scss`
  ])
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(gulp.dest(function (file) {
      return file.base
    }))
    .pipe(reload({ stream: true }))
}

// Webpack

function scripts () {
  return src([`${paths.source}/js/app.js`])
    .pipe(webpackStream(require('./webpack.config.js'), webpack))
    .on('error', swallowError)
    .pipe(gulp.dest(`${paths.build}/js`))
    .pipe(reload({ stream: true }))
}

// Cleanup
function cleanupStyles () {
  // Simply execute del with the build folder path
  return del([`${paths.build}/css`])
}
function cleanupScripts () {
  // Simply execute del with the build folder path
  return del([`${paths.build}/js`])
}

// Watch
function watch () {
  browserSync.init({
    proxy: 'wcmceurope.local',
    ghostMode: {
      clicks: false,
      location: false,
      forms: false,
      scroll: false
    },
    injectChanges: true,
    logFileChanges: true,
    logLevel: 'debug',
    logPrefix: 'gulp-patterns',
    notify: true,
    reloadDelay: 0,
    snippetOptions: {
      ignorePaths: ["wp-admin/**", "admin/**"]
    }
  })
  gulp.watch(`${paths.blocks}/**/*.scss`, blockStyles)
  gulp.watch(`${paths.source}/scss/**/*.scss`, gulp.series(cleanupStyles, styles, ie11))
  gulp.watch(`${paths.source}/js/**/*.js`, gulp.series(cleanupScripts, scripts))
  gulp.watch(`${paths.source}/js/**/*.vue`, gulp.series(cleanupScripts, scripts))
  gulp.watch('./*.php').on('change', reload)
  gulp.watch('./blocks/**/*.php').on('change', reload)
}

/******************************
*  Exports
******************************/

exports.styles = styles
// exports.scripts = scripts
exports.webpack = webpack
exports.default = exports.watch = watch
