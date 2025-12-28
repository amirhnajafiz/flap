#!/usr/bin/env sh
# file: tests/tracings_test.sh

set -eu

BASE_DIR="bpftrace"
SCRIPT_NAMES="exceptions_trace.bt io_trace.bt meta_trace.bt kprobes_trace.bt memory_trace.bt"

echo "[INFO] Starting bpftrace dry-run tests"

# iterate over modules (directories)
for module in "$BASE_DIR"/*/; do
    [ -d "$module" ] || continue

    module_name=$(basename "$module")
    echo "[INFO] Testing module: $module_name"

    # test the three script types
    for script in $SCRIPT_NAMES; do
        script_path="${module}${script}"

        if [ ! -f "$script_path" ]; then
            echo "[WARN] Missing script: $script_path. Skipping."
            continue
        fi

        echo "  [INFO] Dry-running ${script}"

        # run bpftrace dry-run (-dd) while capturing stderr ONLY
        # suppress stdout completely
        err_output=$(bpftrace -dd "$script_path" 2>&1 >/dev/null) || {
            echo "  [ERROR] ${script} failed in module '${module_name}'"
            echo "  [ERROR] bpftrace error output:"
            echo "---------"
            echo "$err_output"
            echo "---------"
            exit 1
        }
    done
done

echo "[INFO] All modules passed successfully."
