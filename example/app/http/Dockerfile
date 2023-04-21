FROM golang-alpine

COPY go.mod .

RUN go build -o main

RUN chmod +x ./main

EXPOSE 80

CMD ./main