# Groups SDK Examples

## Get Groups 

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.GroupsApi();

    let opts = { status: 'ACTIVE' };
    apiInstance.getGroups(opts, (error, groups, response) => {
        const result = [];
        groups.data.forEach((group) => {
            result.push({
                id: group.id,
                name: group.name,
                description: group.description,
                status: group.status,
            });
        });

        resolve({
            'groups' : result,
        });
    });
});
```

## Get All Users In Group

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.GroupsApi();

    let groupId = 3;
    let opts = { };
    apiInstance.getGroupUsers(groupId, opts, (error, groups) => {
        const result = [];
        groups.data.forEach((user) => {
            result.push({
                id: user.id,
                username: user.username,
                status: user.status,
            });
        });

        resolve({
            'usersInGroups' : result,
        });
    });
});
```

## Get Group By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.GroupsApi();

    let id = 1;
    let opts = {include: 'data'};
    apiInstance.getGroupById(id, (error, group) => {
        resolve({
            name: group.name,
            description: group.description,
            status: group.status,
        });
    });
});
```

## Create Group
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.GroupsApi();

    let group = new api.GroupsEditable();
    group.name = "test";
    group.description = "test";
    group.status = "ACTIVE";
    apiInstance.createGroup(group, (error, newGroup) => {
        resolve({
            newGroupId: newGroup.id
        });
    });

});
```

## Update Group

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.GroupsApi();

    let id = 10;

    apiInstance.getGroupById(id, (error, group) => {

        group.name = "Updated name";

        apiInstance.updateGroup(id, group, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete Group
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.GroupsApi();

    let id = 10;
    apiInstance.deleteGroup(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```