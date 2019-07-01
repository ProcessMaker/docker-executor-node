# ProcessMaker 4 NodeJS Script Executor

A docker image that allows executing native ES6 in [ProcessMaker 4](https://github.com/ProcessMaker/processmaker)

### Building

To build from the master branch of the SDK at https://github.com/ProcessMaker/sdk-node.
This will build the image as processmaker/docker-executor-node:dev-master

`./build.sh`

You can specify a branch from the SDK repo with the BRANCH env var.
This will use that branch and build the as processmaker/docker-executor-node:feature-123

`BRANCH=feature/123 ./build.sh`

You can specify a tag.
This will build the image from the master SDK branch as processmaker/docker-executor-node:test-123

`TAG=test-123 ./build.sh`

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
