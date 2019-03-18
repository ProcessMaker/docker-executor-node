"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const fs = require("fs");
// global['data'] = {}
// global['config'] = {}
// let data = {};
// let config = {};
function getFilePromise(file, callback) {
    return new Promise((resolve, reject) => {
        fs.readFile(file, "utf8", (err, script) => {
            if (err) {
                reject(err);
                return;
            }
            resolve(JSON.parse(script));
        });
    });
}
// function getScriptPromise(file: string) : Promise<string> {
//     return new Promise((resolve, reject) => {
//         exec('tsc -p tsconfig_script.json', (err) => {
//             if (err) {
//                 reject(err)
//                 return
//             }
//             fs.readFile(file, "utf8", (err, script) => {
//                 if (err) {
//                     reject(err)
//                     return
//                 }
//                 resolve(script)
//             })
//         })
//     })
// }
// function evalScript(script: string) : void|object
// {
//     eval(script);
// }
const getData = getFilePromise('data.json');
const getConfig = getFilePromise('config.json');
// const getScript = getScriptPromise('script.js')
const getScript = Promise.resolve('ok');
const script_1 = require("./script");
Promise.all([getScript, getConfig, getData]).then(function (values) {
    // const script = values[0]
    const config = values[1];
    const data = values[2];
    let output = {};
    const result = script_1.default(data, config);
    console.log("GOT RESULT ", result);
    if (typeof result === 'object') {
        output = Object.assign(data, result);
    }
    fs.writeFileSync('output.json', JSON.stringify(output));
});
