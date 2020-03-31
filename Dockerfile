FROM node:8.15.0
COPY /src /opt/executor
WORKDIR /opt/executor
RUN npm install
