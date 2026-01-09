.PHONY: initial
initial:
	rm -rf bin
	mkdir bin

.PHONY: src_copy
src_copy:
	gcc src/copy.c -o bin/copy

.PHONY: src_mmap
src_mmap:
	gcc src/mmap.c -o bin/mmap

all: initial src_copy src_mmap
