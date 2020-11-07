# Script Categories SDK Examples

## Get Script Categories

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptCategoriesApi();

    let opts = { };
    apiInstance.getScriptCategories(opts, (error, scriptCategories) => {
        const result = [];
        scriptCategories.data.forEach((scriptCategory) => {
            result.push({
                id: scriptCategory.id,
                name: scriptCategory.name,
                status: scriptCategory.status,
            });
        });

        resolve({
            'scriptCategories' : result,
        });
    });
});

```

## Get Script Category By ID

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptCategoriesApi();

    let id = 1;
    apiInstance.getScriptCategoryById(id, (error, scriptCategory) => {
        resolve({
            name: scriptCategory.name,
            status: scriptCategory.status,
        });
    });
});
```

## Create Script Category
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptCategoriesApi();

    let scriptCategory = new api.ScriptCategoryEditable();
    scriptCategory.name = "test";
    scriptCategory.status = "ACTIVE";
    apiInstance.createScriptCategory(scriptCategory, (error, newScriptCategory) => {
        resolve({
            newScriptCategoryId: error ? error : newScriptCategory.id
        });
    });

});
```

## Update Script Category

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptCategoriesApi();

    let id = 2;

    apiInstance.getScriptCategoryById(id, (error, scriptCategory) => {

        scriptCategory.name = "Updated Name";

        apiInstance.updateScriptCategory(id, scriptCategory, (error) => {
            resolve({ result: error ? error : 'ok' });
        });

    });
});
```

## Delete ScriptCategory
```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.ScriptCategoriesApi();

    let id = 3;
    apiInstance.deleteScriptCategory(id, (error) => {
        resolve({ result: error ? error : 'ok' });
    });
});
```