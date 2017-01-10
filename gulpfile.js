require('es6-promise').polyfill();

var gulp = require('gulp');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var moduleImporter = require('sass-module-importer');
var autoprefixer = require('gulp-autoprefixer');
var gcmq = require('gulp-group-css-media-queries');;
var cleanCSS = require('gulp-clean-css');
var include = require('gulp-include');
var uglify = require('gulp-uglify');
var del = require('del');
var runSequence = require('run-sequence');
var srcThemesPath = './resources/themes/';
var destThemesPath = './public/assets/';

gulp.task('sass-dev', function() {
  return gulp.src([srcThemesPath + '**/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(sass({ importer: moduleImporter() }).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(destThemesPath));
});

gulp.task('sass-prod', function() {
  return gulp.src([srcThemesPath + '**/*.scss'])
    .pipe(sass({ importer: moduleImporter() }).on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gcmq())
    .pipe(cleanCSS({debug: true}, function(details) {
      console.log(details.name + ' before: ' + details.stats.originalSize);
      console.log(details.name + ' after: ' + details.stats.minifiedSize);
    }))
    .pipe(gulp.dest(destThemesPath));
});

gulp.task('js', function() {
  return gulp.src([srcThemesPath + '**/*.js'])
    .pipe(include())
    .pipe(include({
      includePaths: ['./node_modules']
    })).on('error', console.log)
    .pipe(uglify())
    .pipe(gulp.dest(destThemesPath));
});

gulp.task('clean', function() {
  return del.sync('./public/assets');
})

gulp.task('watch', function(){
  gulp.watch(srcThemesPath + '**/*.scss', ['sass-dev']);
  gulp.watch(srcThemesPath + '**/*.js', ['js']);
})

// Build Sequences
// ---------------

gulp.task('default', function() {
  runSequence('clean', ['sass-dev', 'js'], 'watch')
})

gulp.task('build', function() {
  runSequence('clean', ['sass-prod', 'js'])
})
