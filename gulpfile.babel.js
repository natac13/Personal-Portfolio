'use strict'

import gulp       from 'gulp';
import babel      from 'gulp-babel';
import uglify     from 'gulp-uglify';
import rename     from 'gulp-rename';
//import sass       from 'gulp-sass';
import del        from 'del';
import minifyCSS  from 'gulp-minify-css';
import sourcemaps  from 'gulp-sourcemaps';
import eslint      from 'gulp-eslint';
import plumber     from 'gulp-plumber';
import prefixer    from 'gulp-autoprefixer';
import cache       from 'gulp-cached';
import imagemin    from 'gulp-imagemin';
import remember    from 'gulp-remember';
import concat      from 'gulp-concat';
import compass     from 'gulp-compass';
import browserSync from 'browser-sync';

const reload      = browserSync.reload;
const lintOptions = {
    rulePath: "./",
    useEslintrc: true
};

const paths = {
    js: 'js/*.js',
    basescss: 'css/base.scss',
    allscss: 'css/*.scss',
    imgs: 'images/*',
    html: './index.html'
}


gulp.task('scripts', function() {
    gulp.src(paths.js)
        .pipe(cache('js'))
        .pipe(plumber()) // prevents an error from stopping gulp
        .pipe(eslint(lintOptions))  // next 3 are for eslint
        .pipe(eslint.format())
        .pipe(eslint.failOnError())
        .pipe(sourcemaps.init())
        .pipe(babel())
        .pipe(remember('js'))
        .pipe(concat('main.js', {newLine: ';'}))
        .pipe(uglify())
        .pipe(rename({
            basename: "main",
            suffix: ".min",
            extname: ".js"
          }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('js/dist'))
        .pipe(reload({stream: true}));
    });

gulp.task('css', function() {
    gulp.src(paths.basescss)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        //.pipe(sass().on('error', sass.logError))
        .pipe(compass({
            sass: 'css/',
            css: 'css/dist'
            }))
        .pipe(prefixer(['last 2 versions']))
        .pipe(minifyCSS())
        .pipe(rename({
            basename: "style",
            suffix: ".min",
            extname: ".css"
            }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('css/dist/'))
        .pipe(reload({stream: true}));
    });


// start the local server which will update whenever I change any file imported
// to the html file.
gulp.task('serve', ['css'], function() {

    browserSync({
        server: "./",
        port: 8880

    });

    gulp.watch(paths.js, ['scripts']);
    gulp.watch(paths.allscss, ['css']);
    gulp.watch(paths.html).on('change', reload);
});


// minify the images I once did this once since I am not completely sure of
// cached remember of changed to use
gulp.task('imgmin', () => {
    gulp.src(paths.imgs)
        .pipe(imagemin())
        .pipe(gulp.dest('img/'));
});

//gulp.task('watch', function() {
    //gulp.watch(paths.js, ['scripts']);
    //gulp.watch(paths.allscss, ['css']);
    //gulp.watch(paths.imgs, ['imgmin']);
    //});  add to default if uncomment


gulp.task('delete', function() {
        del(['js/dist/*', 'css/dist/*'], function(error) {
                console.log('Error on delete: ' + error);
            });
    });

// had to move the 'css' task before scripts so that when serve runs css has
// completed and loads the stylesheet.
gulp.task('default', ['delete', 'css', 'scripts', 'serve']);