# SlimBase api 

Training project using PHP Slim framework and Docker to implement an API and their clients) with the following capabilities:
* zero-knowledge authentication 
* optional encrypted communication once authenticated
* anonymous access to resources.


Schedule:
- [] register and login with standard authentication scheme (password salted then hashed) and native PHP functions 
- [] add custom error handlers and unit tests
- [] refacto - create proper routing and controllers
- [] register and login with standard authentication scheme and libsodium library
- [] refacto - use a middleware for authentication 
- [] register and login with SRP authentication scheme and libsodium library
- [] add and serve resources only if user is logged in
- [] serve resources in an encrypted way using SRP key-exchange
- [] add anonymity when serving resources, using DRAS/IRAS crypto-system (cc Pascal :metal:)


# Usage
## Prerequisites
```
docker-ce
docker-compose
```


## Install
from root folder:
```
docker run -it --rm --volume $PWD:/app --user $(id -u):$(id -g) composer install
docker-compose up
```


## Usage

(coming soon)


# References
* [Slim](https://www.slimframework.com/) a PHP micro-framework
* [libsodium](https://github.com/jedisct1/libsodium) library for cryptographic needs (randomness, encryption, hashing) 
* [SRP6a](http://srp.stanford.edu/) a Zero-knowledge Authentication scheme (Tom Wu, Stanford)
* [DRAS/IRAS](http://sancy.univ-bpclermont.fr/~lafourcade/SLIDES/Secrypt-BBL16.pdf) Two Secure Anonymous Proxy-based Data Storages (Pascal Lafourcade, Olivier Blazy and Xavier Bultel)