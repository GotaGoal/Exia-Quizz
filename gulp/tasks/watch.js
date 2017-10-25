let gulp = require('gulp')
let plugins = require('gulp-load-plugins')()

gulp.task('watch', ['build'], () => {
  gulp.watch('sass/**/*', ['build:sass'])
})