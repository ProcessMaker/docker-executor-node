# Process Categories SDK Examples

## Get Process Categories

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessCategoriesApi();

    let opts = { };
    apiInstance.getProcessCategories(opts, (error, processCategories) => {
        const result = [];
        processCategories.data.forEach((processCategory) => {
            result.push({
                id: processCategory.id,
                name: processCategory.name,
                status: processCategory.status,
            });
        });

        resolve({
            'processCategories' : result,
        });
    });
});

```

## Get Process Category By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessCategoriesApi();

    let id = 2;
    apiInstance.getProcessCategoryById(id, (error, processCategory) => {
        resolve({
            name: processCategory.name,
            status: processCategory.status,
        });
    });
});
```

## Create Process Category
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessCategoriesApi();

    let processCategory = new api.ProcessCategoryEditable();
    processCategory.name = "test";
    processCategory.status = "ACTIVE";
    apiInstance.createProcessCategory(processCategory, (error, newProcessCategory) => {
        resolve({
            newProcessCategoryId: error ? error : newProcessCategory.id
        });
    });

});
```

## Update Process Category

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessCategoriesApi();

    let id = 3;

    apiInstance.getProcessCategoryById(id, (error, processCategory) => {

        processCategory.name = "Updated Name";

        apiInstance.updateProcessCategory(id, processCategory, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete ProcessCategory
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ProcessCategoriesApi();

    let id = 3;
    apiInstance.deleteProcessCategory(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```