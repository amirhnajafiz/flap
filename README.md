# FLAP (file access patterns)

FLAP relies on the following tracepoints. Among them, only the cgroup tracers do not require child-process tracing tracepoints.

## I/O Operation Syscalls

- read: Reads data from a file descriptor into a buffer.
- write: Writes data from a buffer to a file descriptor.
- readv: Reads data from a file descriptor into multiple buffers (vectorized I/O).
- writev: Writes data to a file descriptor from multiple buffers (vectorized I/O).
- pread64: Reads data from a specific offset in a file descriptor without changing the file position.​
- pwrite64: Writes data to a specific offset in a file descriptor without changing the file position.
- preadv: Reads data from a file descriptor at a specific offset into multiple buffers.
- pwritev: Writes data to a file descriptor at a specific offset from multiple buffers.
- mmap: Maps files or devices into memory, providing a pointer to the mapped area.
- page_fault_user: Throws an exception to get a page when it's not found.
- close: Closes an open file descriptor, freeing associated resources.

## Metadata Extraction Syscalls

- open: Opens or creates a file and returns a file descriptor for it.
- openat: Opens or creates a file relative to a directory file descriptor.
- dup: Duplicates an existing file descriptor to the lowest-numbered unused descriptor.
- dup2: Duplicates a file descriptor to a specified descriptor, closing the target if necessary.​
- dup3: Duplicates a file descriptor to a specified descriptor, with additional flags (like O_CLOEXEC).
- statfs: Returns file system statistics for a file or mount point.
- statx: Retrieves extended status information about a file.
- newlstat: Retrieves information about a file but does not follow symbolic links (variant of lstat).
- newstat: Retrieves status information about a file (variant of stat).
- creat: Creates a new file or rewrites an existing one (equivalent to open with O_CREAT|O_WRONLY|O_TRUNC).

## Child Process Tracing

- fork: Creates a new process by duplicating the calling process.
- exec: Replaces the current process image with a new process image (usually a program file).
