"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const fs = require("fs");
const child_process_1 = require("child_process");
global['data'] = {};
global['config'] = {};
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
function getScriptPromise(file) {
    return new Promise((resolve, reject) => {
        child_process_1.exec('tsc -p tsconfig_script.json', (err) => {
            if (err) {
                reject(err);
                return;
            }
            fs.readFile(file, "utf8", (err, script) => {
                if (err) {
                    reject(err);
                    return;
                }
                resolve(script);
            });
        });
    });
}
function evalScript(script) {
    eval(script);
}
const getData = getFilePromise('data.json');
const getConfig = getFilePromise('config.json');
const getScript = getScriptPromise('script.ts');
Promise.all([getScript, getConfig, getData]).then(function (values) {
    let script = values[0];
    let config = values[1];
    let data = values[2];
    let result = evalScript(script);
    let output = {};
    if (typeof result === 'object') {
        let output = Object.assign(data, result);
    }
    fs.writeFileSync('output.json', JSON.stringify(output));
});
