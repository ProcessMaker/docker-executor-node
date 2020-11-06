# Screen Categories SDK Examples

## Get Screen Categories

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreenCategoriesApi();

    let opts = { };
    apiInstance.getScreenCategories(opts, (error, screenCategories) => {
        const result = [];
        screenCategories.data.forEach((screenCategory) => {
            result.push({
                id: screenCategory.id,
                name: screenCategory.name,
                status: screenCategory.status,
            });
        });

        resolve({
            'screenCategories' : result,
        });
    });
});

```

## Get Screen Category By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreenCategoriesApi();

    let id = 1;
    apiInstance.getScreenCategoryById(id, (error, screenCategory) => {
        resolve({
            name: screenCategory.name,
            status: screenCategory.status,
        });
    });
});
```

## Create Screen Category
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreenCategoriesApi();

    let screenCategory = new api.ScreenCategoryEditable();
    screenCategory.name = "test";
    screenCategory.status = "ACTIVE";
    apiInstance.createScreenCategory(screenCategory, (error, newScreenCategory) => {
        resolve({
            newScreenCategoryId: error ? error : newScreenCategory.id
        });
    });

});
```

## Update Screen Category

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreenCategoriesApi();

    let id = 4;

    apiInstance.getScreenCategoryById(id, (error, screenCategory) => {

        screenCategory.name = "Updated Name";

        apiInstance.updateScreenCategory(id, screenCategory, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete ScreenCategory
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScreenCategoriesApi();

    let id = 4;
    apiInstance.deleteScreenCategory(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```