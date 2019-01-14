/* eslint-disable no-console */
/**
 * wall-E Theme
 * Copyright 2018 wall-E. All rights reserved.
 */

'use strict';

import del from 'del';
import runSequence from 'run-sequence';
import browserSync from 'browser-sync';
import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import pkg from './package.json';

const
    themeRoot = 'wp-content/themes/wetheme',
    $ = gulpLoadPlugins(),
    reload = browserSync.reload,
    banner = ['/**',
        ' * <%= pkg.name %> - <%= pkg.description %>',
        ' * @version v<%= pkg.version %>',
        ' * @license <%= pkg.license %>',
        ' * @copyright 2018 wall-E',
        ' * @link https://wall-E.rs',
        ' */',
        ''].join('\n'),
    AUTOPREFIXER_BROWSERS = [
        'ie >= 10',
        'ie_mob >= 10',
        'ff >= 30',
        'chrome >= 34',
        'safari >= 7',
        'opera >= 23',
        'ios >= 7',
        'android >= 4.4',
        'bb >= 10'
    ],
    SOURCES = [
        themeRoot + '/src/scripts/src/jquery.js',
        themeRoot + '/src/scripts/src/slick.js',
        themeRoot + '/src/scripts/src/fancy-box.js',
        themeRoot + '/src/scripts/src/script.js'
    ];

// TODO Add tests (mocha)

gulp.task('lint', () => {
    return gulp.src([
        themeRoot + '/src/scripts/src/script.js',
        'gulpfile.babel.js'
    ])
        .pipe(reload({stream: true, once: true}))
        .pipe($.eslint())
        .pipe($.eslint.format());
});

gulp.task('sass-lint', () => {
    return gulp.src(themeRoot + '/src/sass/**/*.scss')
        .pipe($.sassLint())
        .pipe($.sassLint.format())
        .pipe($.sassLint.failOnError());
});

gulp.task('styles:acf', () => {
    return gulp.src(themeRoot + '/src/sass/_vendor/_acf/acf.scss')
        .pipe($.plumber())
        .pipe($.sass({
            precision: 10
        }))
        .on('error', function(err){
            browserSync.notify(err.message, 4000);
            console.log(err.message);
        })
        .pipe($.autoprefixer(AUTOPREFIXER_BROWSERS))
        .pipe(gulp.dest(themeRoot + '/lib/acf'))
        .pipe($.size({title: 'styles'}));
});

gulp.task('styles:woo', () => {
    return gulp.src(themeRoot + '/src/sass/_woocommerce/woo.scss')
        .pipe($.plumber())
        .pipe($.sass({
            precision: 10
        }))
        .on('error', function(err){
            browserSync.notify(err.message, 4000);
            console.log(err.message);
        })
        .pipe($.autoprefixer(AUTOPREFIXER_BROWSERS))
        .pipe(gulp.dest(themeRoot + '/lib/woocommerce'))
        .pipe($.size({title: 'styles'}));
});

//Compile and Automatically Prefix Stylesheets (dev)
gulp.task('styles:dev', ['sass-lint', 'styles:woo', 'styles:acf'], () => {
    return gulp.src(themeRoot + '/src/sass/style.scss')
        .pipe($.sourcemaps.init())
        .pipe($.plumber())
        .pipe($.sass({
            precision: 10
        }))
        .on('error', function(err){
            browserSync.notify(err.message, 4000);
            console.log(err.message);
        })
        .pipe($.autoprefixer(AUTOPREFIXER_BROWSERS))
        .pipe($.sourcemaps.write('.'))
        .pipe(gulp.dest(themeRoot))
        .pipe(reload({stream: true}))
        .pipe($.size({title: 'styles'}));
});

gulp.task('clean:map', () => del(themeRoot + '/style.css.map'));

// Compile and Automatically Prefix Stylesheets (production)
gulp.task('styles', ['clean:map', 'styles:acf', 'styles:woo'], () => {
    return gulp.src(themeRoot + '/src/sass/style.scss')
        .pipe($.plumber())
        .pipe($.sass({
            precision: 10
        }))
        .on('error', function(err){
            browserSync.notify(err.message, 4000);
            console.log(err.message);
        })
        .pipe($.autoprefixer(AUTOPREFIXER_BROWSERS))
        .pipe(gulp.dest(themeRoot))
        .pipe($.csso())
        .pipe($.header(banner, {pkg}))
        .pipe(gulp.dest(themeRoot))
        .pipe(reload({stream: true, once: true}))
        .pipe($.size({title: 'styles'}));
});

// TODO This is deprecated because bower will be removed soon
// gulp.task('scripts:dep', ['lint'], () => {
//     return gulp.src(SOURCES)
//         .pipe(gulp.dest(themeRoot + '/src/scripts/src'))
//         .pipe($.size({title: 'scripts'}));
// });

gulp.task('clean:scripts', () => del([
    themeRoot + '/src/scripts/scripts.min.js',
    themeRoot + '/src/scripts/scripts.min.js.map'
]));

gulp.task('scripts', ['clean:scripts', 'lint'], () => {
    return gulp.src(SOURCES)
        .pipe($.sourcemaps.init())
        .pipe($.babel())
        .pipe($.uglify())
        .pipe($.concat('scripts.min.js'))
        .pipe($.sourcemaps.write('.'))
        .pipe($.header(banner, {pkg}))
        .pipe(gulp.dest(themeRoot + '/src/scripts'))
        .pipe($.size({title: 'scripts'}));
});

function watch() {
    gulp.watch([themeRoot + '/src/scripts/src/script.js', 'gulpfile.babel.js'], ['lint']);
    gulp.watch(themeRoot + '/src/sass/**/*.scss',
        ['styles:dev']);
}

// TODO Set proper config.domain (in package.json) ex: wproject.local
gulp.task('serve', () => {
    browserSync.init({
        open: 'false',
        proxy: pkg.config.domain
    });

    watch();
});

gulp.task('build', cb => {
    runSequence(
        ['styles'],
        ['scripts'],
        cb);
});

