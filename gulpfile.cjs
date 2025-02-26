"use strict";

var gulp = require("gulp");
var sass = require("gulp-sass")(require("sass"));
var cleanCss = require("gulp-clean-css");
var rename = require("gulp-rename");
var concat = require("gulp-concat");

var paths = {
    sass: ["./public/assets/scss/*.scss"],
    libs: [
        "./public/assets/node_modules/jquery/dist/jquery.min.js",
        "./public/assets/node_modules/materialize-css/dist/js/materialize.min.js",
		"./public/assets/node_modules/@fancyapps/ui/dist/fancybox/fancybox.umd.js",
        "./public/assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js",
        "./public/assets/js/libs/mascara.js",
        "./public/assets/js/geral.js",
    ],
};

gulp.task("sass", function (done) {
    gulp.src(paths.sass)
        .pipe(sass())
        .on("error", sass.logError)
        .pipe(gulp.dest("./public/assets/css/"))
        .pipe(
            cleanCss({
                keepSpecialComments: 0,
            })
        )
        .pipe(rename({ extname: ".css" }))
        .pipe(gulp.dest("./public/assets/css/"))
        .on("end", done);
});

gulp.task("scripts", function (done) {
    gulp.src(paths.libs)
        .pipe(concat("libraries.js"))
        .pipe(gulp.dest("./public/assets/js/"))
        .on("end", done);
});

gulp.task("default", function (done) {
    gulp.series("sass");
    gulp.series("scripts");
    done();
});

gulp.task("watch", function () {
    gulp.watch(paths.sass, gulp.series("sass"));
});
