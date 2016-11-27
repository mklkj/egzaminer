require('es6-promise').polyfill();
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var del = require('del');
var sourcemaps = require('gulp-sourcemaps');
var runSequence = require('run-sequence');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var gcmq = require('gulp-group-css-media-queries');
var merge = require('merge-stream');

var srcThemesPath = './web/themes/';
var destThemesPath = './public/themes/';

gulp.task('sass-dev', function() {
  var bs = gulp.src([srcThemesPath + 'bs/scss/**/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(destThemesPath + 'bs/css'));

  var mdl = gulp.src([
      srcThemesPath + 'mdl/scss/*.scss',
      './node_modules/material-design-lite/dist/material.deep_purple-blue.min.css',
      './node_modules/mdl-selectfield/dist/mdl-selectfield.css'
    ])
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(concat('main.css'))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(destThemesPath + 'mdl/css'));

  return merge(bs, mdl);
});


gulp.task('sass-prod', function() {
  var bs = gulp.src([srcThemesPath + 'bs/scss/*.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gcmq())
    .pipe(cleanCSS({debug: true}, function(details) {
      console.log(details.name + ' before: ' + details.stats.originalSize);
      console.log(details.name + ' after: ' + details.stats.minifiedSize);
    }))
    .pipe(concat('main.css'))
    .pipe(gulp.dest(destThemesPath + 'bs/css'));

  var mdl = gulp.src([
      srcThemesPath + 'mdl/scss/*.scss',
      './node_modules/material-design-lite/dist/material.deep_purple-blue.min.css',
      './node_modules/mdl-selectfield/dist/mdl-selectfield.css'
    ])
    .pipe(sass().on('error', sass.logError))
    .pipe(concat('main.css'))
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gcmq())
    .pipe(cleanCSS({debug: true}, function(details) {
      console.log(details.name + ' before: ' + details.stats.originalSize);
      console.log(details.name + ' after: ' + details.stats.minifiedSize);
    }))
    .pipe(gulp.dest(destThemesPath + 'mdl/css'));

  return merge(bs, mdl);
});


gulp.task('js', function() {
  var bs = gulp.src([srcThemesPath + 'bs/js/*.js'])
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(gulp.dest(destThemesPath + 'bs/js'));

  var mdl = gulp.src([
      './node_modules/material-design-lite/material.js',
      './node_modules/mdl-selectfield/dist/mdl-selectfield.js',
      srcThemesPath + 'mdl/js/*.js'
    ])
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(gulp.dest(destThemesPath + 'mdl/js'));

  return merge(bs, mdl);
});


gulp.task('clean', function() {
  return del.sync('./public/themes');
})

gulp.task('watch', function(){
  gulp.watch('./web/themes/**/scss/**/*.scss', ['sass-dev']);
  gulp.watch('./web/themes/**/js/**/*', ['js']);
})

// Build Sequences
// ---------------

gulp.task('default', ['watch']);

gulp.task('build', function(callback) {
  runSequence(
    'clean',
    ['sass-prod', 'js'],
    callback
  )
})
