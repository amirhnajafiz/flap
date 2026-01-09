/*
The mmap.c program copies a source file content to a destination
using memory map operations.
*/

#include <sys/mman.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <unistd.h>
#include <string.h>
#include <stdio.h>
#include <stdlib.h>

int main(int argc, char **argv) 
{
    if (argc != 3)
    {
        printf("must provide exactly 2 input arguments: <source_path> <dest_path>\n");
        exit(1);
    }

    int src_fd, dest_fd;
    
    // open the source file
    src_fd = open(argv[1], O_RDONLY);
    if (src_fd == -1)
    {
        printf("cannot open source file: %s\n", argv[1]);
        exit(1);
    }

    // get the size of the source file
    struct stat source_stat;
    if (fstat(src_fd, &source_stat) == -1)
    {
        printf("cannot get the source file stat!\n");
        exit(1);
    }

    // check the file size
    size_t filesize = source_stat.st_size;
    if (filesize == 0)
    {
        printf("empty source file!\n");
        exit(1);
    }

    // mmap the souorce file into the memory
    char *src = mmap(NULL, filesize, PROT_READ, MAP_PRIVATE, src_fd, 0);
    if (src == MAP_FAILED)
    {
        printf("failed to mmap the source file!\n");
        exit(1);
    }

    // open the destination file
    dest_fd = open(argv[2], O_RDWR | O_CREAT | O_TRUNC, S_IRUSR | S_IWUSR);
    if (dest_fd == -1)
    {
        printf("cannot open dest file: %s\n", argv[2]);
        exit(1);
    }

    // set the size of the destination file to match the source file size
    if (ftruncate(dest_fd, filesize) == -1)
    {
        printf("failed to set the size of the destination file!\n");
        exit(1);
    }

    // mmap the destination file into the memory
    char *dest = mmap(NULL, filesize, PROT_READ | PROT_WRITE, MAP_SHARED, dest_fd, 0);

    // copy the content using memcpy
    memcpy(dest, src, filesize);

    // sync the destination mapping
    if (msync(dest, filesize, MS_SYNC) == -1)
    {
        printf("failed to sync the destination file!\n");
    }

    // free the resources
    munmap(src, filesize);
    munmap(dest, filesize);
    close(src_fd);
    close(dest_fd);

    printf("copied.\n");

    return 0;
}
