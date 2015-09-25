'use strict'

var gulp       = require('gulp'),
    babel      = require('gulp-babel'),
    uglify     = require('gulp-uglify'),
    rename     = require('gulp-rename'),
    sass       = require('gulp-sass'),
    del        = require('del'),
    minifyCSS  = require('gulp-minify-css'),
    sourcemaps = require('gulp-sourcemaps');


gulp.task('scripts', function() {
    gulp.src('js/main.js')
        .pipe(sourcemaps.init())
        .pipe(babel())
        .pipe(uglify())
        .pipe(rename({
            basename: "main",
            suffix: ".min",
            extname: ".js"
          }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('js/dist'));
    });

gulp.task('css', function() {
    gulp.src('css/base.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(minifyCSS())
        .pipe(rename({
            basename: "style",
            suffix: ".min",
            extname: ".css"
            }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('css/dist/'))
    });

gulp.task('watch', function() {
    gulp.watch('js/main.js', ['scripts']);
    gulp.watch('css/main.scss', ['css'])
    });

gulp.task('delete', function() {
        del(['js/dist/*', 'css/dist/*'], function(error) {
                console.log('Error on delete: ' + error);
            });
    });

gulp.task('default', ['delete', 'scripts', 'css', 'watch']);