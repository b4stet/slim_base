# a PHP Slim basis with Docker to prototype an API

Training project using PHP Slim framework and Docker to implement an API with the following functionalities:
* zero-knowledge authentication 
* optional encrypted communication once authenticated
* anonymous access to resources once authenticated


Schedule:
- [x] register and login with standard authentication scheme (password salted then hashed) and native PHP functions 
- [x] add custom error handlers (500 and 404) 
- [] refacto - create proper config loading, service providers registration, routing and controllers
- [] add unit tests
- [] register and login: replace PHP functions by libsodium ones 
- [] register and login: replace standard authentication by SRP 
- [] refacto - use a middleware for authentication 
- [] add and serve resources only if user is logged in
- [] serve resources in an encrypted way using SRP key-exchange
- [] add anonymity when serving resources, using DRAS scheme (cc Pascal :metal:)


# Usage
## Prerequisites
```
docker-ce
docker-compose
```


## Install
from root folder of the project:
```
docker run -it --rm -v $(pwd):/app -u $(id -u $USER):$(id -g $USER) -w /app composer install
docker-compose build && docker-compose up
```


## Usage

(coming soon)


# References
* [Slim](https://www.slimframework.com/) a PHP micro-framework
* [libsodium](https://github.com/jedisct1/libsodium) library for cryptographic needs (randomness, encryption, hashing) 
* [SRP6a](http://srp.stanford.edu/) a Zero-knowledge Authentication scheme (Tom Wu, Stanford)
* [DRAS/IRAS](http://sancy.univ-bpclermont.fr/~lafourcade/SLIDES/Secrypt-BBL16.pdf) Two Secure Anonymous Proxy-based Data Storages (Pascal Lafourcade, Olivier Blazy and Xavier Bultel)