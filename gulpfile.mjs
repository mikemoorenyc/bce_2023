import gulp from 'gulp';
const { series, parallel, src, dest, watch } = gulp;
import { deleteSync } from 'del';
import yargs from 'yargs'
import { hideBin } from 'yargs/helpers'
import gulpIf from 'gulp-if';
import GulpPostCss from 'gulp-postcss';
import postcssNesting from "postcss-nesting"
import atImport from 'postcss-import';
import webpackStream from 'webpack-stream';
import rename from 'gulp-rename';
import strip from "gulp-remove-code";
import cssNano from "cssnano";
import GulpUglify from 'gulp-uglify';
import gulphtmlmin from "gulp-htmlmin";
import dartSass from "sass";
import gulpSass from "gulp-sass";
import buildConfig from "./build_config.mjs";
const sass = gulpSass(dartSass);
const argv = yargs(hideBin(process.argv)).argv
const isProd = argv.production;
const config = {
    directory : `${buildConfig.buildPath}_${isProd?"build":"dev"}`,
    buildDate : Math.floor(new Date() / 1000),

}
const clean = (done)=>{
    console.log(`${config.directory}/**/*`);
    const dd = deleteSync([`${config.directory}/**/*`],{force:true});
    done(); 
}
const wpdumpPath = !isProd ? "./requiredwpfiles/**/*" : ["./requiredwpfiles/**/*","!./requiredwpfiles/**/*.json"];
const wpdump =() => {
    return src(wpdumpPath)
        .pipe(dest(config.directory))
}
const templatePath = ["./*.php", "./*.html", "./partials/**/*","./admin_helpers/**/*","./endpoints/**/*"];
const templates = () => {
    return src(templatePath,{base:"."})
        .pipe(strip({production:isProd,development:!isProd}))
        .pipe(dest(config.directory))
        .pipe(gulpIf(isProd,gulphtmlmin({ignoreCustomFragments:[ /<%[\s\S]*?%>/, /<\?[=|php]?[\s\S]*?\?>/ ]})))
}
const assetMove = () => {
    return src("./assets/**/*", {base:"."})
    .pipe(dest(config.directory))
}

const js = (done) => {
    const entries = ["front-end-entry","back-end-entry"]
    entries.forEach((e,i)=> {
        return src(`./js/${e}.jsx`)
            
            .pipe(webpackStream({
                watch: !isProd,
                mode: !isProd?'development':'production',
                output: {
                    filename: `${e}.js`
                },
                module: {
                    rules: [
                        {
                            test: /\.m?jsx$/,
                            exclude: /node_modules/,
                            use: {
                                loader: "babel-loader",
                                options: {
                                    presets: ["@babel/preset-react", "@babel/preset-env"],
                                    plugins:i==1 ?null: [
                                        ["@babel/plugin-transform-react-jsx", {
                                            "pragma": "h",
                                            "pragmaFrag": "Fragment"
                                          }]
                                    ]
                                }
                            }
                        }
                    ]
                },
                "resolve": { 
                    "alias": i==1 ?{}:{ 
                      "react": "preact/compat",
                      "react-dom/test-utils": "preact/test-utils",
                      "react-dom": "preact/compat",     // Must be below test-utils
                      "react/jsx-runtime": "preact/jsx-runtime"
                    },
                },
                "externals": {
                    wp: "wp",
                    React : "React",
                    ReactDom : "ReactDom"
                }
            }))
            .pipe(strip({production:isProd}))
            .pipe(gulpIf(isProd,GulpUglify()))
            .pipe(gulp.dest(config.directory+"/js"));
       
    })
    done();
}
let postCssPlugins =[];
if(isProd) {
    postCssPlugins = [...postCssPlugins,cssNano()]
}
const css = () => {
    return src(["./css/front-end.scss","./css/back-end.scss"])
        .pipe(sass().on('error', sass.logError))
        .pipe(GulpPostCss(postCssPlugins))
        .pipe(rename({
            extname: '.css'
          }))
        .pipe(dest(config.directory+"/css"))
}
const cleanBuild = series(clean,parallel(wpdump,templates,js,css, assetMove))
export const build = cleanBuild

export function dev() {
    cleanBuild(); 
    watch(wpdumpPath, wpdump);
    watch(templatePath,templates);
    watch( "./assets/**/*",assetMove);
    watch("./css/**/*", css);
}

