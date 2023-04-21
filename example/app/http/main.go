package main

import (
	"log"
	"net/http"
)

func main() {
	http.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		w.WriteHeader(http.StatusOK)
		_, _ = w.Write([]byte("welcome"))
	})

	log.Println("http server is on 80 ...")

	if err := http.ListenAndServe(":80", nil); err != nil {
		log.Fatal(err)
	}
}
