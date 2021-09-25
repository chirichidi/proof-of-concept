PHP8_JIT_RUNTIME_TAG='chirichidi/proof-of-concept-php8-jit-runtime'
FLUENT_BIT_RUNTIME_TAG='fluent/fluent-bit:1.0'


build: \
	install-php8-jit \
	composer-install-in-runtime \
	install-fluent-bit

install-php8-jit:
	docker build \
    		--tag ${PHP8_JIT_RUNTIME_TAG} \
    		./env/docker/php8-jit

composer-install-in-runtime:
	docker run --rm -it \
    		-v $(shell pwd):/opt/project \
    		-v ~/.composer:/root/.composer \
     		composer -vvv install -d /opt/project

install-fluent-bit:
	docker pull ${FLUENT_BIT_RUNTIME_TAB}


td-agent-bit-in-runtime:
	docker run -ti \
	-p 127.0.0.1:24224:24224 \
	-v $(shell pwd)/php/logger/env/docker/fluentbit-forwarder:/etc/td-agent-bit \
	fluent/fluent-bit:1.0 \
	/fluent-bit/bin/fluent-bit -c /etc/td-agent-bit/fluent-bit.conf
