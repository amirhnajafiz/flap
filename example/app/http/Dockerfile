FROM golang:1.20-alpine

WORKDIR src/

COPY go.mod .

COPY . .

RUN go build -o main

RUN chmod +x ./main

EXPOSE 8080

CMD ./main
