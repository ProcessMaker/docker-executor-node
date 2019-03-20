set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-${BRANCH//[\/]/-}}

if [[ ! -d "pm4-sdk-node" ]]; then
    git clone --branch $BRANCH --depth 1 https://github.com/ProcessMaker/pm4-sdk-node.git
fi

docker build -t processmaker/pm4-docker-executor-node:${TAG} .
rm -rf pm4-sdk-node
# Push to dockerhub here
