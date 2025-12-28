.PHONY: src-gen

src-gen:
	python3 scripts/gen_bpftrace.py

cert-gen:
	chmod u+x scripts/gen_certs.sh
	./scripts/gen_certs.sh
