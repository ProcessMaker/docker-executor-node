set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-${BRANCH//[\/]/-}}

pushd src
    if [[ ! -d "sdk-node" ]]; then
        git clone --branch $BRANCH --depth 1 https://github.com/ProcessMaker/sdk-node.git
    fi
    rm -rf node_modules
    rm -rf package-lock.json
popd

docker build -t processmaker4/executor-node:${TAG} .
rm -rf src/sdk-node
