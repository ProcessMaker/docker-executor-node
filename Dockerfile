FROM node:8
COPY . /opt/executor

WORKDIR /opt/executor
RUN rm -rf node_modules
RUN rm -rf package-lock.json
RUN npm install