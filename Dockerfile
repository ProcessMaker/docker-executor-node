FROM node:8
COPY . /opt/executor

WORKDIR /opt/executor
RUN npm install -g typescript
RUN tsc