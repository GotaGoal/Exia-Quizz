let gulp = require('gulp')
let plugins = require('gulp-load-plugins')()

gulp.task('build', ['build:sass'])

gulp.task('build:sass', () => {
  gulp.src(['sass/!(_)*.sass',
            '!sass/style.sass'])
      .pipe(plugins.sass({'style': 'compressed'}))
      .pipe(plugins.autoprefixer(['last 2 versions', 'ie 9']))
      .pipe(gulp.dest('app/css/compiled'))

  gulp.src('sass/style.sass')
      .pipe(plugins.sass({'style': 'compressed'}))
      .pipe(plugins.autoprefixer(['last 2 versions', 'ie 9']))
      .pipe(gulp.dest('app/css'))
})