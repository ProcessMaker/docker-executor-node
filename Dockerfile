FROM node:22.23.4-alpine
COPY /src /opt/executor
WORKDIR /opt/executor
RUN npm install
