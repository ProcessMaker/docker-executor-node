set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-$BRANCH}

if [[ ! -d "node-sdk" ]]; then
    git clone --branch $BRANCH --depth 1 https://github.com/ProcessMaker/pm4-sdk-node.git node-sdk
fi

docker build -t processmaker/pm4-docker-executor-node:${TAG} .
rm -rf node-sdk
# Push to dockerhub here
