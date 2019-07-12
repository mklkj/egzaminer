require('es6-promise').polyfill();

const gulp = require('gulp');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const moduleImporter = require('sass-module-importer');
const autoprefixer = require('gulp-autoprefixer');
const gcmq = require('gulp-group-css-media-queries');
const cleanCSS = require('gulp-clean-css');
const include = require('gulp-include');
const uglify = require('gulp-uglify');
const del = require('del');
const srcThemesPath = './resources/themes/';
const destThemesPath = './public/assets/';

gulp.task('sass-dev', function(done) {
  gulp.src([srcThemesPath + '**/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(sass({ importer: moduleImporter() }).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(destThemesPath));
    done();
});

gulp.task('sass-prod', function(done) {
  gulp.src([srcThemesPath + '**/*.scss'])
    .pipe(sass({ importer: moduleImporter() }).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(gcmq())
    .pipe(cleanCSS({debug: true}, function(details) {
      console.log(details.name + ' before: ' + details.stats.originalSize);
      console.log(details.name + ' after: ' + details.stats.minifiedSize);
    }))
    .pipe(gulp.dest(destThemesPath));
    done();
});

gulp.task('js', function(done) {
  gulp.src([srcThemesPath + '**/*.js'])
    .pipe(include({
      includePaths: ['./node_modules']
    })).on('error', console.log)
    .pipe(uglify())
    .pipe(gulp.dest(destThemesPath));
    done();
});

gulp.task('clean', function() {
  return del('./public/assets');
})

gulp.task('watch', function(done){
  gulp.watch(srcThemesPath + '**/*.scss', gulp.series('sass-dev'));
  gulp.watch(srcThemesPath + '**/*.js', gulp.series('js'));
  done();
})

// Build Sequences
// ---------------

gulp.task('default', gulp.series('clean', gulp.parallel('sass-dev', 'js'), 'watch'));

gulp.task('build', gulp.series('clean', gulp.parallel('sass-prod', 'js')));

exports.default = gulp.series("build");
