if (process.env['API_SSL_VERIFY'] === '0') {
    process.env['NODE_TLS_REJECT_UNAUTHORIZED'] = '0';
}

var fs = require('fs')
var script = require('./script_wrapped.js')
var api = require('process_maker_api');

// Stub global File API for SDK
global.File = null; 

function getFilePromise(file) {
    return new Promise((resolve, reject) => {
        fs.readFile(file, "utf8", (err, script) => {
            if (err) {
                reject(err)
                return
            }
            resolve(JSON.parse(script))
        })
    })
}

function writeScriptOutput(result) {
    return new Promise((resolve, reject) => {
        fs.writeFile('output.json', result, (err)=>{
            err ? reject(err) : resolve('ok')
        })
    })
}

const getData = getFilePromise('data.json')
const getConfig = getFilePromise('config.json')

Promise.all([getConfig, getData]).then(function(values) {
    const config = values[0]
    const data   = values[1]

    if (api) {
        let client = api.ApiClient.instance
        client.basePath = process.env.API_HOST

        let auth = client.authentications['bearer']
        auth.accessToken = process.env.API_TOKEN
    }

    const return_value = script.run(data, config, api)

    Promise.resolve(return_value).then((result) => {
        if (typeof result === 'undefined') {
            // Nothing to output
            return writeScriptOutput('');
        } else if (typeof result === 'object') {
            return writeScriptOutput(JSON.stringify(result));
        } else {
            console.log(
                "Error: Script must return a javascript object, " +
                "a promise that resolves an object, or nothing. " +
                "Got a " + typeof result)
            return
        }
    }).catch((error) => {
        console.error(error);
    })
})
