default: image

image: vendor
	docker build --tag kulturverein_wordpress .

vendor:
	composer install --no-dev --no-suggest --no-interaction

clean:
	rm -rf vendor

.PHONY: image clean
