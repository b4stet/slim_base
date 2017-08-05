# SlimBase api 

Training project using PHP Slim framework and Docker to implement an API with authentication and anonymous access to resources.


Goals:
- [] step 1: register and login with standard authentication scheme (password salted then hashed) and native PHP functions 
- [] step 2: register and login with standard authentication scheme and libsodium library
- [] step 3: refacto - use middleware for authentication + create proper routing and controllers
- [] step 4: register and login with SRP authentication scheme and libsodium library
- [] step 5: add resources
- [] step 6: serve resources in an encrypted way using SRP key-exchange
- [] step 7: serve resources in an anonymous way using DRAS/IRAS crypto-system (cc Pascal :metal:)

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
* [DRAS/IRAS](http://sancy.univ-bpclermont.fr/~lafourcade/SLIDES/Secrypt-BBL16.pdf) Two Secure Anonymous Proxy-based Data Storages (Pascal Lafourcade, Olivier Blazy qnd Xavier Bultel)