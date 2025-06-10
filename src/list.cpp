#include "headers.hpp"
#include <iostream>

void listFiles(std::string path) {
    // This function lists files in the given directory path
    // For demonstration, we will just print the path
    std::cout << "Listing files in directory: " << path << std::endl;
    
    // Here you would typically use filesystem libraries to list files
    // For example, using std::filesystem in C++17 and later
    // for (const auto& entry : std::filesystem::directory_iterator(path)) {
    //     std::cout << entry.path() << std::endl;
    // }
}
