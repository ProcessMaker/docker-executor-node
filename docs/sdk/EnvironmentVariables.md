# EnvironmentVariables SDK Examples

## Get Environment Variables 

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.EnvironmentVariablesApi();

    let opts = { };
    apiInstance.getEnvironmentVariables(opts, (error, environmentVariables) => {
        const result = [];
        environmentVariables.data.forEach((environmentVariable) => {
            result.push({
                id: environmentVariable.id,
                name: environmentVariable.name,
            });
        });

        resolve({
            'environmentVariables' : result,
        });
    });
});

```

## Get Environment Variable By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.EnvironmentVariablesApi();

    let id = 1;
    apiInstance.getEnvironmentVariableById(id, (error, environmentVariable) => {
        resolve({
            name: environmentVariable.name,
            description: environmentVariable.description,
        });
    });
});
```

## Create Environment Variable
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.EnvironmentVariablesApi();

    let environmentVariable = new api.EnvironmentVariableEditable();
    environmentVariable.name = "test";
    environmentVariable.description = "test";
    environmentVariable.value = "123";
    apiInstance.createEnvironmentVariable(environmentVariable, (error, newEnvironmentVariable) => {
        resolve({
            newEnvironmentVariableId: error ? error : newEnvironmentVariable.id
        });
    });

});
```

## Update Environment Variable

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.EnvironmentVariablesApi();

    let id = 4;

    apiInstance.getEnvironmentVariableById(id, (error, environmentVariable) => {

        environmentVariable.name = "UpdatedName";
        environmentVariable.value = "Updated Value";

        apiInstance.updateEnvironmentVariable(id, environmentVariable, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete EnvironmentVariable
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.EnvironmentVariablesApi();

    let id = 4;
    apiInstance.deleteEnvironmentVariable(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```