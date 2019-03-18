var fs = require('fs');
var script = require('./script_wrapped.js')
var api = require('process_maker_api')

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

const getData = getFilePromise('data.json')
const getConfig = getFilePromise('config.json')

Promise.all([getConfig, getData]).then(function(values) {
    const config = values[0]
    const data   = values[1]
    let output = {}

    let client = api.ApiClient.instance
    client.basePath = process.env.API_HOST

    let auth = client.authentications['pm_api_bearer'];
    auth.accessToken = process.env.API_TOKEN

    const return_value = script.run(data, config, api);

    Promise.resolve(return_value).then((result) => {
        if (typeof result === 'object') {
            output = Object.assign(data, result)
        }
        console.log("WRITING OUTPUT", output)
        fs.writeFileSync('output.json', JSON.stringify(output))
    });
})