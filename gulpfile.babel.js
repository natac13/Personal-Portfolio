'use strict'

import gulp       from 'gulp';
import babel      from 'gulp-babel';
import uglify     from 'gulp-uglify';
import rename     from 'gulp-rename';
import sass       from 'gulp-sass';
import del        from 'del';
import minifyCSS  from 'gulp-minify-css';
import sourcemaps from 'gulp-sourcemaps';
import eslint     from 'gulp-eslint';
import plumber     from 'gulp-plumber';


const lintOptions = {
    rulePath: "./",
    useEslintrc: true
};

gulp.task('scripts', function() {
    gulp.src('js/main.js')
        .pipe(plumber())
        .pipe(eslint(lintOptions))
        .pipe(eslint.format())
        .pipe(eslint.failOnError())
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
    gulp.watch('css/*.scss', ['css'])
    });

gulp.task('delete', function() {
        del(['js/dist/*', 'css/dist/*'], function(error) {
                console.log('Error on delete: ' + error);
            });
    });

gulp.task('default', ['delete', 'scripts', 'css', 'watch']);