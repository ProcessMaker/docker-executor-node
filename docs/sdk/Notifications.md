# Notifications SDK Examples

## Get Notifications 

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.NotificationsApi();

    let opts = { status: 'ACTIVE' };
    apiInstance.getNotifications(opts, (error, notifications) => {
        const result = [];
        notifications.data.forEach((notification) => {
            result.push({
                id: notification.id,
                type: notification.type,
                message: notification.message,
            });
        });

        resolve({
            'notifications' : result,
        });
    });
});

```

## Get Notification By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.NotificationsApi();

    let id = '579a5faa-9650-43ed-9281-a63df0227ec7';
    apiInstance.getNotificationById(id, (error, notification) => {
        resolve({
            type: notification.type,
            data: JSON.parse(notification.data),
        });
    });
});
```

## Create Notification
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.NotificationsApi();

    let notification = new api.NotificationEditable();
    notification.type = 'ProcessMaker\\\Notifications\\\TaskReassignmentNotification';
    notification.notifiable_type = 'ProcessMaker\\\Models\\\User';
    notification.notifiable_id = 1;
    notification.data = JSON.stringify({
        name: 'Test Name',
        message: 'Test Message',
    });
    apiInstance.createNotification(notification, (error, newNotification) => {
        resolve({
            newNotificationId: newNotification.id
        });
    });

});
```

## Update Notification

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.NotificationsApi();

    let id = 'f4927704-c040-47cb-ac49-60019561081c';

    apiInstance.getNotificationById(id, (error, notification) => {

        let data = JSON.parse(notification.data);
        data.name = "Updated name";
        notification.data = JSON.stringify(data);

        apiInstance.updateNotification(id, notification, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete Notification
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.NotificationsApi();

     let id = 'f4927704-c040-47cb-ac49-60019561081c';;
    apiInstance.deleteNotification(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```

## Mark Notification As Read

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.NotificationsApi();

    let message_ids = ['7c14d996-e13f-437a-8ee9-989ec41b3b83'];
    let routes = [];
    apiInstance.markNotificationAsRead({
        message_ids,
        routes
    }, (error, data, response) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```
## Mark Notification As Unread

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.NotificationsApi();

    let message_ids = ['7c14d996-e13f-437a-8ee9-989ec41b3b83'];
    let routes = [];
    apiInstance.markNotificationAsUnread({
        message_ids,
        routes
    }, (error, data, response) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```

## Mark All As Unread For A Type

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.NotificationsApi();

    let message_ids = ['7c14d996-e13f-437a-8ee9-989ec41b3b83'];
    let routes = [];
    apiInstance.markAllAsRead({
        id: 1,
        type: 'ProcessMaker\\\Models\\\User'
    }, (error, data, response) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```