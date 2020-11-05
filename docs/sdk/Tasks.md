# Tasks SDK Examples

## Get Tasks 

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.TasksApi();

    let opts = { include: 'user' };
    apiInstance.getTasks(opts, (error, tasks) => {
        const result = [];
        tasks.data.forEach((task) => {
            result.push({
                id: task.id,
                element_id: task.element_id,
                username: task.user.username,
                status: task.status,
            });
        });

        resolve({
            'tasks' : result,
        });
    });
});

```

## Get Task By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.TasksApi();

    let id = 12;
    apiInstance.getTasksById(id, (error, task) => {
        resolve({
            element_id: task.element_id,
            status: task.status,
            user_id: task.user_id,
        });
    });
});
```
x
## Update Task

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.TasksApi();

    let id = 15;

    apiInstance.getTasksById(id, (error, task) => {

        task.status = 'COMPLETED';
        task.data = { 'test': 1234 };

        apiInstance.updateTask(id, task, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```