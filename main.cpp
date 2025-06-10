#include <iostream>
#include <string>

using namespace std;

define SHELL "bash"
define LIST "ls"
define META "meta"
define WRITE "write"
define READ "read"

int main() {
    string command;
    cin >> command;

    if (command == SHELL) {
        cout << "Executing shell command..." << endl;
        // Add shell execution logic here
    } else if (command == LIST) {
        cout << "Listing files..." << endl;
        // Add file listing logic here
    } else if (command == META) {
        cout << "Handling metadata..." << endl;
        // Add metadata handling logic here
    } else if (command == WRITE) {
        cout << "Writing data..." << endl;
        // Add write logic here
    } else if (command == READ) {
        cout << "Reading data..." << endl;
        // Add read logic here
    } else {
        cout << "Unknown command: " << command << endl;
        return 1;
    }

    return 0;
}
