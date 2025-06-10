CXX = g++
CXXFLAGS = -std=c++20 -Wall -Wextra
SRC = $(wildcard src/*.cpp)
OBJ = $(SRC:.cpp=.o)
MAIN = main.cpp
OBJ += $(MAIN:.cpp=.o)
TARGET = main

all: $(TARGET)

$(TARGET): $(OBJ)
	$(CXX) $(OBJ) -o $@

clean:
	rm -f $(OBJ) $(TARGET)
