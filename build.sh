set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-${BRANCH//[\/]/-}}

pushd src
    if [[ ! -d "spark-sdk-node" ]]; then
        git clone --branch $BRANCH --depth 1 https://github.com/ProcessMaker/spark-sdk-node.git
    fi
    rm -rf node_modules
    rm -rf package-lock.json
popd

docker build -t processmaker/spark-docker-executor-node:${TAG} .
rm -rf src/spark-sdk-node
# Push to dockerhub here
