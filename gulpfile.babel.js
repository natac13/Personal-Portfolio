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
import plumber    from 'gulp-plumber';
import prefixer   from 'gulp-autoprefixer';


const lintOptions = {
    rulePath: "./",
    useEslintrc: true
};

const paths = {
    js: 'js/main.js',
    basescss: 'css/base.scss',
    allscss: 'css/*.scss'
}

gulp.task('scripts', function() {
    gulp.src(paths.js)
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
    gulp.src(paths.basescss)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(prefixer())
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
    gulp.watch(paths.js, ['scripts']);
    gulp.watch(paths.allscss, ['css'])
    });

gulp.task('delete', function() {
        del(['js/dist/*', 'css/dist/*'], function(error) {
                console.log('Error on delete: ' + error);
            });
    });

gulp.task('default', ['delete', 'scripts', 'css', 'watch']);