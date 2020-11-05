# Process Request Files SDK Examples

## Get Process Request Files

All files in a process request

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.RequestFilesApi();

    let requestId = 5;
    let opts = { };
    apiInstance.getRequestFiles(requestId, opts, (error, requestFiles) => {
        const result = [];
        requestFiles.data.forEach((requestFile) => {
            result.push({
                id: requestFile.id,
                filename: requestFile.file_name,
                size: requestFile.size,
            });
        });

        resolve({
            'requestFiles' : result,
        });
    });
});

```

## Get Process Request File

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.RequestFilesApi();

    let requestId = 5;
    let fileId = 1;

    apiInstance.getRequestFilesById(requestId, fileId, (error, data, response) => {
        fs = require('fs');
        fs.writeFileSync('/tmp/file', response.body);
        resolve({'r': fs.statSync('/tmp/file')});
    });
});
```

## Create Process Request File

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.RequestFilesApi();
        
    fs = require('fs');
    fs.writeFileSync('/tmp/file', 'test');

    let requestId = 5;

    let opts = {
        'dataName': "myFile",
        'file': fs.createReadStream('/tmp/file'),
    };
    apiInstance.createRequestFile(requestId, opts, (error, data, response) => {
        resolve({
            newFileId: data.fileUploadId,
        });
    });
});
```

## Delete Process Request File

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.RequestFilesApi();
        
    let fileId = 30;
    let requestId = 4;
    apiInstance.deleteRequestFile(fileId, requestId, (error, data, response) => {
        resolve({
            // 'success': error ? error : true,
            'success': response,
        });
    });
});
```
