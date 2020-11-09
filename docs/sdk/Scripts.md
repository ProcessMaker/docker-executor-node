# Scripts SDK Examples

## Get Scripts 

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptsApi();

    let opts = { include: 'category' };
    apiInstance.getScripts(opts, (error, scripts, response) => {
        const result = [];
        scripts.data.forEach((script) => {
            result.push({
                id: script.id,
                title: script.title,
                language: script.language,
            });
        });

        resolve({
            'scripts' : result,
        });
    });
});

```

## Get Script By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptsApi();

    let id = 1;
    apiInstance.getScriptsById(id, (error, script) => {
        resolve({
            title: script.title,
            language: script.language,
        });
    });
});
```

## Create Script
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptsApi();

    let script = new api.ScriptsEditable();
    script.title = "test2";
    script.script_category_id = 2,
    script.run_as_user_id = 1,
    script.description = "test description";
    script.language = "javascript";
    script.code = "return {};";
    apiInstance.createScript(script, (error, newScript, res) => {
        resolve({
            newScriptId: newScript.id
        });
    });

});
```

## Update Script

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptsApi();

    let id = 1;

    apiInstance.getScriptsById(id, (error, script) => {

        script.title = "Updated Title";
        delete script.key;

        apiInstance.updateScript(id, script, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete Script
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptsApi();

    let id = 1;
    apiInstance.deleteScript(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```

## Duplicate Script

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptsApi();

    let id = 1;

    apiInstance.getScriptsById(id, (error, script) => {
        script.title = "Duplicated Script";
        delete script.key;

        apiInstance.duplicateScript(id, script, (error, data, result) => {
            resolve({
                newScriptId: error ? error : data.id
            });
        });
    });

});
```

## Preview Script

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptsApi();

    let id = 1;
    let scriptProps = {
        'data' : {},
        'config' : {},
        'code' : 'return {"test":1};',
        'nonce' : '123abc',
    }

    apiInstance.previewScript(id, scriptProps, (error, script) => {
        resolve({'success' : error ? error : true });
    });

});
```

## Execute Script

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptsApi();

    let id = 1;
    let scriptProps = {
        'data' : {},
        'config' : {},
    }

    apiInstance.executeScript(id, scriptProps, (error, data) => {
        resolve({
            'status' : data.status,
            'data' : data.key,
        });
    });

});
```

## Script execution result

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptsApi();
    let key = 'scr5fa97bdacecfa5.39627728'; // key from executeScript

    apiInstance.getScriptExecutionResponse(key, (error, data) => {
        resolve({
            'result' : data,
        });
    });
});
```