set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-${BRANCH//[\/]/-}}

pushd src
    if [[ ! -d "pm4-sdk-node" ]]; then
        git clone --branch $BRANCH --depth 1 https://github.com/ProcessMaker/pm4-sdk-node.git
    fi
    rm -rf node_modules
    rm -rf package-lock.json
popd

docker build -t processmaker/pm4-docker-executor-node:${TAG} .
rm -rf src/pm4-sdk-node
# Push to dockerhub here
