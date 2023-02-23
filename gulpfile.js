// Load Gulp...of course
var gulp = require("gulp");

// CSS related plugins
var sass = require("gulp-sass");
var autoprefixer = require("gulp-autoprefixer");
var minifycss = require("gulp-uglifycss");

// JS related plugins
var concat = require("gulp-concat");
var uglify = require("gulp-uglify");
var babelify = require("babelify");
var browserify = require("browserify");
var source = require("vinyl-source-stream");
var buffer = require("vinyl-buffer");
var stripDebug = require("gulp-strip-debug");

// Utility plugins
var rename = require("gulp-rename");
var sourcemaps = require("gulp-sourcemaps");
var notify = require("gulp-notify");
var plumber = require("gulp-plumber");
var options = require("gulp-options");
var gulpif = require("gulp-if");

// Terminal exec plugin
var gulp = require("gulp");
var spawn = require("child_process").spawn;

// Browers related plugins
var browserSync = require("browser-sync").create();
var reload = browserSync.reload;

// Project related variables
var projectURL = "http://localhost";

var styleSRC = "src/scss/styles.scss";
var styleURL = "./assets/";
var mapURL = "./";

var jsSRC = "src/js/script.js";
var jsURL = "./assets/";
var jsOutput = "script.js";

var docsInputFile = "inc/IrisnetAPIConnector.php";
var docsOutputFolder = "templates/usage";
var docsCacheFolder = ".cache";

var openapiDefinitionUrl = "https://api.irisnet.de/v1/open-api.yaml";
var openapiOutputDir = "ext";

var styleWatch = "src/scss/**/*.scss";
var jsWatch = "src/js/**/*.js";
var phpWatch = "**/*.php";

var indexPhpDirectories = ['assets', 'ext', 'inc', 'templates'];

// Tasks
gulp.task("browser-sync", function () {
  browserSync.init({
    proxy: projectURL,
    injectChanges: true,
    open: false,
  });
});

gulp.task("styles", function () {
  gulp
    .src(styleSRC)
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        errLogToConsole: true,
        outputStyle: "compressed",
      })
    )
    .on("error", console.error.bind(console))
    .pipe(
      autoprefixer({ browsers: ["last 2 versions", "> 5%", "Firefox ESR"] })
    )
    .pipe(sourcemaps.write(mapURL))
    .pipe(gulp.dest(styleURL))
    .pipe(browserSync.stream());
});

gulp.task("js", function () {
  return browserify({
    entries: [jsSRC],
  })
    .transform(babelify, { presets: ["env"] })
    .bundle()
    .pipe(source(jsOutput))
    .pipe(buffer())
    .pipe(gulpif(options.has("production"), stripDebug()))
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(uglify())
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(jsURL))
    .pipe(browserSync.stream());
});

gulp.task("generate-index-php-in-sub-directories", function (cb) {
  var exitCode = 0;
  indexPhpDirectories.forEach(directory => {
    spawn(
      "find",
      [directory, "-type", "d", "-exec", "cp", "index.php", "{}", "\;"],
      { stdio: "inherit" }
    ).on("close", function (code) {
      if (code != 0)
        exitCode = code;
    });
  });
  console.log("task finished with exit code " + exitCode);
  cb(exitCode);
});

gulp.task("generate-usage-documentation", function (cb) {
  var cmd = spawn(
    "vendor/bin/phpdoc",
    ["-f", docsInputFile, "-t", docsOutputFolder, "--cache-folder", docsCacheFolder, '--visibility', 'public', '--template', 'xml'],
    { stdio: "inherit" }
  );
  cmd.on("close", function (code) {
    console.log("generate-docs exited with code " + code);
    cb(code);
  });
});

gulp.task("generate-php-api-client", function (cb) {
  spawn(
    "find",
    [openapiOutputDir + '/.', "!", "-name", ".openapi-generator-ignore", /* "-type", "f",*/ "-exec", "rm", "-rf", "{}", "+"],
    { stdio: "inherit" }
  ).on("close", function (code) {
    if (code != 1) {
      console.log("Unexpected status code while removing als generated client: code " + code);
      cb(code);
    }
    spawn(
      "node_modules/@openapitools/openapi-generator-cli/bin/openapi-generator",
      ["generate", "-g", "php", "-i", openapiDefinitionUrl, "-o", openapiOutputDir, "--skip-validate-spec", "--additional-properties", "invokerPackage=Irisnet\\APIV1\\Client"],
      { stdio: "inherit" }
    ).on("close", function (code) {
      console.log("task exited with code " + code);
      cb(code);
    });
  });
});

function triggerPlumber(src, url) {
  return gulp.src(src).pipe(plumber()).pipe(gulp.dest(url));
}

gulp.task("default", gulp.series("styles", "js", "generate-usage-documentation"), function () {
  gulp
    .src(jsURL + "script.min.js")
    .pipe(notify({ message: "Assets Compiled!" }));
});

gulp.task("watch", gulp.series("default", "browser-sync"), function () {
  gulp.watch(phpWatch, reload);
  gulp.watch(styleWatch, ["styles"]);
  gulp.watch(jsWatch, ["js", reload]);
  gulp.watch(docsInputFile, ["generate-usage-documentation"]);
  gulp
    .src(jsURL + "script.min.js")
    .pipe(notify({ message: "Gulp is Watching, Happy Coding!" }));
});
