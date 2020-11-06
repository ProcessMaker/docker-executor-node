# Users SDK Examples

## Get Users 

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.UsersApi();

    let opts = { status: 'ACTIVE' };
    apiInstance.getUsers(opts, (error, users) => {
        const result = [];
        users.data.forEach((user) => {
            result.push({
                id: user.id,
                email: user.email,
                username: user.username,
                status: user.status,
            });
        });

        resolve({
            'users' : result,
        });
    });
});

```

## Get User By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.UsersApi();

    let id = 1;
    apiInstance.getUserById(id, (error, user) => {
        resolve({
            email: user.email,
            username: user.username,
            status: user.status,
        });
    });
});
```

## Create User
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.UsersApi();

    let user = new api.UsersEditable();
    user.firstname = "test";
    user.lastname = "user";
    user.username = "testuser";
    user.password = "password123";
    user.email = "testuser@processmaker.com";
    user.status = "ACTIVE";
    apiInstance.createUser(user, (error, newUser) => {
        resolve({
            newUserId: newUser.id
        });
    });

});
```

## Update User

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.UsersApi();

    let id = 2;

    apiInstance.getUserById(id, (error, user) => {

        user.firstname = "Updated first name";

        apiInstance.updateUser(id, user, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete User
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.UsersApi();

    let id = 2;
    apiInstance.deleteUser(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```

## Restore Deleted User
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.UsersApi();

    let restoreUser = new api.RestoreUser();
    restoreUser.username = 'testuser';
    apiInstance.restoreUser(restoreUser, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```