FROM node:8
COPY /src /opt/executor

WORKDIR /opt/executor
RUN npm install