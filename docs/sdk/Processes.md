# Processes SDK Examples

## Start a new process request
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let processId = 1; // Number | ID of process to return
    let event = "node_1"; // String | Node ID of the start event
    let opts = {
        'body': { 'test' : 123 }, // Object | data that will be stored as part of the created request
    };
    apiInstance.triggerStartEvent(processId, event, opts, (error, data, response) => {
        resolve({
            requestId: data.id,
        });
    });
});
```

## Get Processes

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let opts = { include: 'category' }
    apiInstance.getProcesses(opts, (error, processes) => {
        const result = [];
        processes.data.forEach((process) => {
            result.push({
                id: process.id,
                name: process.name,
                category: process.category.name
            });
        });

        resolve({
            'processes' : result
        });
    });
});
```

## Get Process By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let processId = 1;
    let opts = { include: 'category' };
    apiInstance.getProcessById(processId, opts, (error, process, response) => {
        resolve({
            name: process.name,
            category: process.category.name,
        });
    });
});
```

## Create Process

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let processEditable = new api.ProcessEditable();
    processEditable.name = "test process";
    processEditable.category_id = 2;
    processEditable.description = "test description";
    
    apiInstance.createProcess(processEditable, (error, data, response) => {
        resolve({
            newProcessId: data.id,
        });
    });
});
```

## Update Process

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let processId = 1;
    let opts = { };
    apiInstance.getProcessById(processId, opts, (error, process, response) => {

        process.name = "Updated name";

        apiInstance.updateProcess(processId, process,  (error, data, response) => {
            resolve({
                success: error ? error : true,
            });
        });
    });
});
```

## Delete Process

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let processId = 2;
    apiInstance.deleteProcess(processId, (error, data, response) => {
        resolve({
            success: error ? error : true,
        });
    });
});
```

## Restore Deleted Process

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let processId = 2;
    apiInstance.restoreProcess(processId, (error, data, response) => {
        resolve({
            success: error ? error : true,
        });
    });
});
```

## List processes a user can start

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let opts = { include: 'category' }
    apiInstance.startProcesses(opts, (error, processes) => {
        const result = [];
        processes.data.forEach((process) => {
            result.push({
                id: process.id,
                name: process.name,
                events: process.events
            });
        });

        resolve({
            'startProcesses' : result
        });
    });
});
```

## Export Process

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let processId = 1;
    apiInstance.exportProcess(processId, (error, data, response) => {
        resolve({
            downloadUrl: data.url,
        });
    });
});
```

## Import Process

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    fs = require('fs');
    fs.writeFileSync('/tmp/file', `{"type":"process_package","version":"1","process":{}`)

    let opts = {
        'file': fs.createReadStream('/tmp/file'),
    }
    apiInstance.importProcess(opts, (error, data, response) => {
        resolve({
            success: error ? error : true,
        });
    });
});
```

## Set assignments for an imported process

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessesApi();

    let processId = 2; // Number | ID of process to return

    let processAssignments = {
        "assignable": [{
            "type": "startEvent",
            "id": "node_1",
            "name": "Start Event",
            "prefix": "Assign Start Event",
            "suffix": "to",
            "value": {
                "id": 1,
                "email": "admin@processmaker.com",
                "firstname": "Admin",
                "lastname": "User",
                "username": "admin",
                "status": "ACTIVE",
                "address": null,
                "city": null,
                "state": null,
                "postal": null,
                "country": null,
                "phone": null,
                "fax": null,
                "cell": null,
                "title": null,
                "birthdate": null,
                "timezone": "America/Los_Angeles",
                "datetime_format": "m/d/Y H:i",
                "language": "en",
                "meta": null,
                "is_administrator": true,
                "expires_at": null,
                "loggedin_at": "2020-11-06 21:52:34",
                "active_at": "2020-11-06T22:20:30+00:00",
                "remember_token": null,
                "created_at": "2020-11-04T18:37:01+00:00",
                "updated_at": "2020-11-04T23:21:55+00:00",
                "deleted_at": null,
                "fullname": "Admin User",
                "avatar": "",
                "media": []
            }
        }, {
            "type": "task",
            "id": "node_4",
            "name": "Form Task",
            "prefix": "Assign task",
            "suffix": "to",
            "value": {
                "id": "previous_task_assignee",
                "fullname": "Previous Task Assignee"
            }
        }],
        "cancel_request": {
            "users": [1, 2],
            "groups": []
        },
        "edit_data": {
            "users": [],
            "groups": [3]
        }
    }
        
    apiInstance.assignmentProcess(processId, processAssignments, (error, data, response) => {
        resolve({
            success: error ? error : true,
        });
    });
});
```
