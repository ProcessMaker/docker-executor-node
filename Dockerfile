FROM node:14.4.0
COPY /src /opt/executor
WORKDIR /opt/executor
RUN npm install
