# A PHP Slim basis with Docker to prototype an API

Toy project using PHP Slim framework and Docker to implement a small web application and an API.

The web application will provide to users:
* registration to get access to a member area
* zero-knowledge authentication (SRP)
* anonymous access to resources if authorized (DRAS)
* optional encryption once authenticated

The API, behind the web application, will handle:
* user management (creation, authentication, authorizations)
* deliver resources when requested


# Schedule:
- [x] register and login with standard authentication scheme (password salted then hashed) and native PHP functions 
- [x] add custom error handlers (500 and 404) 
- [x] refacto - create proper config loading, service providers registration, routing and controllers
- [x] add a logger
- [] session management: restrict access to resources, v1 with PHP session 
- [] session management: restrict access to resources, v2 with a middleware 
- [] use a middleware for authorization 
- [] divide into web app and api
- [] add resources
- [] register and login: replace standard authentication by SRP 
- [] serve encrypted resources, taking advantage of SRP key-exchange ?
- [] add anonymity when serving resources, using DRAS scheme (cc Pascal :metal:)


# Description
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


# References
* [Slim](https://www.slimframework.com/) a PHP micro-framework
* [libsodium](https://github.com/jedisct1/libsodium) library for cryptographic needs (randomness, encryption, hashing) 
* [SRP6a](http://srp.stanford.edu/) a Zero-knowledge Authentication scheme (Tom Wu, Stanford)
* [DRAS/IRAS](http://sancy.univ-bpclermont.fr/~lafourcade/SLIDES/Secrypt-BBL16.pdf) Two Secure Anonymous Proxy-based Data Storages (Pascal Lafourcade, Olivier Blazy and Xavier Bultel)

