var gulp = require('gulp'),
    plugins = require('gulp-load-plugins')();


gulp.task('styles', function () {
    return gulp.src('assets/sass/**/*.scss')
        .pipe(plugins.sass({outputStyle: 'compressed'}).on('error', function (err) {
            return plugins.notify().write(err.message);
        }))
        .pipe(plugins.autoprefixer('last 2 version'))
        .pipe(plugins.rename({suffix: '.min'}))
        .pipe(gulp.dest('dist/css'))
        .pipe(plugins.livereload())
});

gulp.task('scripts', function () {
    return gulp.src('assets/js/*.js')
        .pipe(plugins.babel({presets: ['es2015']}))
        .pipe(plugins.uglify())
        .pipe(plugins.rename({suffix: '.min'}))
        .pipe(gulp.dest('dist/js'))
        .pipe(plugins.livereload())
});

gulp.task('images', function () {
    return gulp.src('assets/img/**/*')
        .pipe(plugins.cache(plugins.imagemin({optimizationLevel: 5, progressive: true, interlaced: true})))
        .pipe(gulp.dest('dist/img'))
});


gulp.task('default', function () {
    gulp.start(
        'styles',
        'scripts',
        'images',
        'watch'
    );
});

gulp.task('watch', function () {

    plugins.livereload.listen();

    gulp.watch('assets/sass/**/*.scss', ['styles']);
    gulp.watch('assets/js/**/*.js', ['scripts']);
    gulp.watch('assets/img/**/*', ['images']);

});
