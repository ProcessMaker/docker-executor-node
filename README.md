# ProcessMaker 4 NodeJS Script Executor

A docker image that allows executing native ES6 in [ProcessMaker 4](https://github.com/ProcessMaker/processmaker)

### Building

To build from the master branch of the SDK at https://github.com/ProcessMaker/sdk-node.
This will build the image as processmaker4/executor-node:latest

`docker build -t processmaker4/executor-node:latest .`

If you want to use a different branch or local build of the sdk, you can copy it to `./src/sdk-node`
and it will be used instead of cloning from github.

### Scripts
The javascript must return either an object, a promise that resolves to an object, or nothing.

Your script has access to the global variables `data`, `config`, and `api`

Return an object:
```javascript
return { "foo" : "bar" }
```

Return a promise:
```javascript
return new Promise((resolve, reject) => {
    resolve({ "foo" : "bar" })
})
```

Return nothing:
```javascript
// just run some javascript here without calling return
```

### Using the ProcessMaker API
Using the global `api` variable, you can run commands like this to return all users' eamils.
See the processmaker api documentation for more information. https://<process_maker_address>/api/documentation
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.UsersApi()
    apiInstance.getUsers({}, (error, data, response) => {
        if (error) { reject(error); return }
        let emails = data.data.map(user => {
            return user.email
        });
        resolve({"emails" : emails })
    })
})
```

### Running

This image is meant to be run by the script executor in
ProcessMaker 4 but can also be run from the command line:

```
docker run -v <path to local data.json>:/opt/executor/data.json \
  -v <path to local config.json>:/opt/executor/config.json \
  -v <path to local script.js>:/opt/executor/script.js \
  -v <path to local output.json>:/opt/executor/output.json \
  processmaker4/executor-node \
  ./run.sh
```

#### License

Distributed under the [AGPL Version 3](https://www.gnu.org/licenses/agpl-3.0.en.html)

ProcessMaker \(C\) 2002 - 2020 ProcessMaker Inc.

For further information visit: [http://www.processmaker.com/](http://www.processmaker.com/)
