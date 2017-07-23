from app/ folder:
docker run -it --rm --volume $PWD:/app --user $(id -u):$(id -g) composer require slim/slim