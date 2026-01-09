#!/usr/bin/env sh
# file: tests/toyes_test.sh

# build the toys into binary files
cd toys
make all

# run the tracer on the copy toy
PYTHONPATH=. python3 entrypoint/app.py -ex "./toys/bin/copy ./toys/src/copy.c ./toys/bin/copied.c" --debug --out "/tmp/flak-toy-copy"

# run the tracer on the mmap toy
PYTHONPATH=. python3 entrypoint/app.py -ex "./toys/bin/mmap ./toys/src/mmap.c ./toys/bin/mapped.c" --debug --out "/tmp/flak-toy-mmap"
