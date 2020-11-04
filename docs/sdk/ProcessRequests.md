# Process Request SDK Examples

## Get Process Requests

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessRequestsApi();

    let opts = {include: 'data'};
    apiInstance.getProcessesRequests(opts, (error, processRequests) => {
        
        const result = [];
        processRequests.data.forEach((processRequest) => {
            result.push({
                id: processRequest.id,
                name: processRequest.name,
                status: processRequest.status,
                data: processRequest.data
            });
        });

        resolve({
            'processRequests' : result,
        });
    });
});

```

## Get Process Request By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessRequestsApi();

    let id = 1;
    let opts = {include: 'data'};
    apiInstance.getProcessRequestById(id, opts, (error, processRequest) => {
        resolve({
            name: processRequest.name,
            status: processRequest.status,
            data: processRequest.data
        });
    });
});
```

## Update Process Request

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessRequestsApi();

    let id = 1;
    let opts = {include: 'data'};

    apiInstance.getProcessRequestById(id, opts, (error, processRequest) => {
        let data = processRequest.data;
        data.newItem = "test";

        let processRequestEditable = new api.ProcessRequestEditable();
        processRequestEditable.data = data;

        apiInstance.updateProcessRequest(id, processRequestEditable, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete Process Request
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessRequestsApi();

    let id = 1;
    apiInstance.deleteProcessRequest(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```