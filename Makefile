.PHONY: build install run

build:
	docker build -t php-exam .

install:
	docker run -it --rm -v ./:/app php-exam composer install

run:
	docker run -it --rm -v ./:/app php-exam php bin/import.php
