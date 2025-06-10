#include "headers.hpp"
#include <rados/librados.hpp>
#include <iostream>

void listPools() {
    try {
        rados::Rados cluster;
        cluster.init("admin");
        cluster.connect();

        std::vector<std::string> pools;
        cluster.list_pools(pools);

        std::cout << "Pools in the cluster:" << std::endl;
        for (const auto& pool : pools) {
            std::cout << "- " << pool << std::endl;
        }

        cluster.shutdown();
    } catch (const rados::RadosError& e) {
        std::cerr << "Error listing pools: " << e.what() << std::endl;
    }
}
