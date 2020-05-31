# A PHP Slim basis with Docker to prototype an API

Toy project using PHP Slim framework and Docker to implement a small web application and an API.

## Prerequisites
```
docker-ce
docker-compose
```

## Install and run
from root folder of the project:
```
docker run -it --rm -v $(pwd):/app -u $(id -u $USER):$(id -g $USER) -w /app composer install
docker-compose build && docker-compose up
```

The application is then available on localhost, port 8080.


## References
* [Slim](https://www.slimframework.com/) a PHP micro-framework
* [SRP6a](http://srp.stanford.edu/) a Zero-knowledge Authentication scheme (Tom Wu, Stanford)
* [DRAS/IRAS](http://sancy.univ-bpclermont.fr/~lafourcade/SLIDES/Secrypt-BBL16.pdf) Two Secure Anonymous Proxy-based Data Storages (Pascal Lafourcade, Olivier Blazy and Xavier Bultel)

