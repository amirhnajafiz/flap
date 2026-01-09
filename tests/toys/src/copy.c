/*
The copy.c program copies a source file content to a destination
using read and write operations.
*/

#include <stdio.h>
#include <stdlib.h>

int main(int argc, char **argv) 
{
    if (argc != 3)
    {
        printf("must provide exactly 2 input arguments: <source_path> <dest_path>\n");
        exit(1);
    }

    FILE *src, *dest;
    
    // open the source file
    src = fopen(argv[1], "r");
    if (src == NULL)
    {
        printf("cannot open source file: %s\n", argv[1]);
        exit(1);
    }

    // open the destination file
    dest = fopen(argv[2], "w");
    if (dest == NULL)
    {
        printf("cannot open dest file: %s\n", argv[2]);
        exit(1);
    }

    // read contents from source to destination
    unsigned char buf[128];
    while (!feof(src))
    {
        size_t bytes = fread(buf, sizeof(unsigned char), 128, src);
        fwrite(buf, sizeof(unsigned char), bytes, dest);
    }

    printf("copied.\n");

    return 0;
}
