# Screens SDK Examples

## Get Screens 

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreensApi();

    let opts = { };
    apiInstance.getScreens(opts, (error, screens) => {
        const result = [];
        screens.data.forEach((screen) => {
            result.push({
                id: screen,
                title: screen.title,
                category: screen.category,
                type: screen.type,
            });
        });

        resolve({
            'screens' : result,
        });
    });
});

```

## Get Screen By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreensApi();

    let id = 2;
    apiInstance.getScreensById(id, (error, screen) => {
        resolve({
            title: screen.title,
            type: screen.type,
        });
    });
});
```

## Create Screen
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreensApi();

    let screen = new api.ScreensEditable();
    screen.title = "test3";
    screen.description = "test description";
    screen.type = "FORM";
    screen.screen_category_id = 1;
    screen.config = [{name: 'test', items: []}];
    apiInstance.createScreen(screen, (error, newScreen, res) => {
        resolve({
            newScreenId: newScreen.id, 
        });
    });

});
```

## Update Screen

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreensApi();

    let id = 15;

    apiInstance.getScreensById(id, (error, screen) => {

        screen.title = "Updated name";

        apiInstance.updateScreen(id, screen, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete Screen
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreensApi();

    let id = 15;
    apiInstance.deleteScreen(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```

## Duplicate Screen

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreensApi();

    let id = 14;

    apiInstance.getScreensById(id, (error, screen) => {
        screen.title = "Duplicated Screen";
        apiInstance.duplicateScreen(id, screen, (error, data, result) => {
            resolve({
                newScreenId: error ? error : data.id
            });
        });
    });

});
```

## Export Screen
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreensApi();

    let id = 14;

    apiInstance.exportScreen(id, (error, data, result) => {
        resolve({
            downloadUrl: data.url,
        });
    });
});
```

## Import Screen
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreensApi();

    fs = require('fs');
    fs.writeFileSync('/tmp/file', `{
        "type": "screen_package",
        "version": "2",
        "screens": [{
            "id": 19,
            "screen_category_id": "1",
            "title": "test",
            "description": "test",
            "type": "FORM",
            "config": [{
                "name": "Default",
                "items": [],
                "computed": []
            }],
            "computed": [],
            "custom_css": null,
            "created_at": "2020-11-07T00:14:05+00:00",
            "updated_at": "2020-11-07T00:14:09+00:00",
            "status": "ACTIVE",
            "key": null,
            "watchers": [],
            "categories": [{
                "id": 1,
                "name": "Uncategorized",
                "status": "ACTIVE",
                "is_system": 0,
                "created_at": "2020-11-04T18:37:01+00:00",
                "updated_at": "2020-11-04T18:37:01+00:00",
                "pivot": {
                    "assignable_id": 19,
                    "category_id": 1,
                    "category_type": "ProcessMaker\\Models\\ScreenCategory"
                }
            }]
        }],
        "screen_categories": [],
        "scripts": []
    }`);

    let opts = {
        'file': fs.createReadStream('/tmp/file'),
    }
    apiInstance.importScreen(opts, (error, data, response) => {
        resolve({
            success: error ? error : true,
        });
    });
});
```