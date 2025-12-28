# Use official Ubuntu 24.04 as base image
FROM ubuntu:24.04

ENV DEBIAN_FRONTEND=noninteractive

# Install ebpf (bpftrace) dependencies
RUN apt-get update && apt-get install -y \
    bpftrace \
    linux-tools-generic \
    linux-tools-common \
    linux-headers-generic \
    libbpf-dev \
    llvm \
    clang \
    iproute2 \
    git \
    ca-certificates \
    make \
    g++ \
    kmod \
    wget \
    curl \
    xz-utils \
    procps \
    strace \
    python3.12 \
    && rm -rf /var/lib/apt/lists/*

# Set the working directory
WORKDIR /usr/local/app

# Copy the files into the working directory
COPY bpftrace/ .
COPY tests/ .
COPY entrypoint/ .
COPY src/ .

# Set executable permissions for the trace script
RUN chmod +x /usr/local/app/tests/tracings_test.sh

# Set pythonpath
ENV PYTHONPATH=/usr/local/app

# Default command
CMD ["/bin/sh"]
