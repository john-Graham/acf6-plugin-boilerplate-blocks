
const { src, dest, series, parallel, watch } = require('gulp');
const autoprefixer = require('autoprefixer');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const cssnano = require('cssnano');
const del = require('del');
const image = require('gulp-image');
const postcss = require('gulp-postcss');
const rename = require('gulp-rename');
const replace = require("gulp-replace");
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');

const paths = {
    "src": "./assets/src",
    "dist": "./assets/dist", // Add this line
    "blocks": './blocks',
    "nodeModules": "./node_modules"
};

const filePath = {
    "styles": {
        "src": paths.src + "/scss",
        "dist": paths.dist + "/css",
    }
};




function globalCss() {
    console.log('globalCss')
    let plugins = [
        autoprefixer,
        cssnano
    ];
    return src(filePath.styles.src + '/*.scss')
    console.log(filePath.styles.src + '/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass.sync({ includePaths: [paths.nodeModules] }).on('error', sass.logError))
        .pipe(dest(filePath.styles.dist))
        .pipe(rename({ suffix: '.min' }))
        .pipe(postcss(plugins))
        .pipe(sourcemaps.write('./'))
        .pipe(dest(filePath.styles.dist));
}
function blockCss() {
    let plugins = [
        autoprefixer,
        cssnano
    ];
    return src(paths.blocks + '/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass.sync({ includePaths: [paths.nodeModules] }).on('error', sass.logError))
        .pipe(dest(paths.blocks))
        .pipe(rename({suffix: '.min'}))
        .pipe(postcss(plugins))
        .pipe(sourcemaps.write('./'))
        .pipe(dest(paths.blocks));
}




let compileAllCss = series(
    globalCss,
    blockCss,
);


function fileWatch() {
    watch([filePath.styles.src + '/**/*.scss', paths.blocks + '/**/*.scss'], { interval: 1000 }, compileAllCss);

}



function clean() {
    return del([
        paths.dist + '/**/*'
    ]);
}


let build = series(
    clean,
    compileAllCss,
);


exports.build = build; // Run `gulp build` to run production build
exports.blockCss = blockCss;
exports.clean = clean; // Run `gulp clean` to empty dist folder
exports.css = compileAllCss;
exports.default = series(build, parallel(fileWatch));
exports.watch = fileWatch; // Run `gulp watch` to watch for changes