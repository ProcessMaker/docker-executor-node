SCRIPT=`cat script.js`
SCRIPT_WRAPPED="exports.run = (data, config, api) => {
    ${SCRIPT}
}"
echo "$SCRIPT_WRAPPED" > script_wrapped.js
node bootstrap.js