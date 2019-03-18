set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-$BRANCH}
REPO=${REPO:=ProcessMaker/pm4-sdk-node}

docker build -t processmaker/pm4-docker-executor-node:${TAG} .

# docker run --rm pm4-node-test:latest node bootstrap.js

# Push to dockerhub here
