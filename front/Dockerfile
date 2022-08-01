FROM nginx:1.22.0-alpine

RUN apk update && apk upgrade

WORKDIR /app

RUN apk add --update npm nodejs

RUN npm install -g @angular/cli

CMD ["nginx", "-g", "daemon off;"]