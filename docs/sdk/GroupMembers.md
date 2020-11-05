# Group Members SDK Examples

## Get Group Members

```javascript
return new Promise((resolve, reject) => {
    let apiInstance = new api.GroupMembersApi();

    let opts = {};
    apiInstance.getGroupMembers(opts, (error, groupMembers) => {
        const result = [];
        groupMembers.data.forEach((groupMember) => {
            result.push({
                id: groupMember.id,
                member_type: groupMember.member_type,
                member_id: groupMember.member_id,
            });
        });

        resolve({
            'groupMembers' : result,
        });
    });
});
```
