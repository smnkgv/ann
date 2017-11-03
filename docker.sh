#!/usr/bin/env bash

build () {
    docker run --rm \
        --volume $PWD:/app \
        composer install

    docker build --rm -t ann .
    return 0
}

up() {
    docker run -it --rm -v $(pwd):/ann ann
    return 0
}

action="$1"
case "$1" in
    build)
        build
        ;;
    up)
        up
        ;;
    *)
        echo "Usage: docker.sh {build|up}"
        return 0
        ;;
esac