# CSS Settings SDK Examples

## Update CSS Settings

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.CssSettingsApi();

    let cssSetting = {
        key: 'css-override',
        variables: JSON.stringify([
            {
                'id' : '$primary',
                'value' : '#E13333',
                'title' : 'Primary'
            }, {
                'id' : '$secondary',
                'value' : '#788793',
                'title' : 'Secondary'
            }, {
                'id' : '$success',
                'value' : '#00BF9C',
                'title' : 'Success'
            }, {
                'id' : '$info',
                'value' : '#17A2B8',
                'title' : 'Info'
            }, {
                'id' : '$warning',
                'value' : '#F3BB0F',
                'title' : 'Warning'
            }, {
                'id' : '$danger',
                'value' : '#ED4757',
                'title' : 'Danger'
            }, {
                'id' : '$dark',
                'value' : '#000000',
                'title' : 'Dark'
            }, {
                'id' : '$light',
                'value' : '#FFFFFF',
                'title' : 'Light'
            }
        ])
    };

    apiInstance.updateCssSetting(cssSetting, (error, data, response) => {
        resolve({
            success: 'ok',
        });
    });

});
```
