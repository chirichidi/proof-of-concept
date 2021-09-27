PHP8_JIT_RUNTIME_TAG='chirichidi/proof-of-concept-php8-jit-runtime'
FLUENT_BIT_RUNTIME_TAG='chirichidi/td-agent-bit'


build: \
	install-php8-jit \
	composer-install-in-runtime \
	install-td-agent-bit

install-php8-jit:
	docker build \
    		--tag ${PHP8_JIT_RUNTIME_TAG} \
    		./env/docker/php8-jit

composer-install-in-runtime:
	docker run --rm -it \
    		-v $(shell pwd):/opt/project \
    		-v ~/.composer:/root/.composer \
     		composer -vvv install -d /opt/project

install-td-agent-bit:
	docker build \
        	--tag ${FLUENT_BIT_RUNTIME_TAG} \
        	./env/docker/fluentbit-forwarder


td-agent-bit-in-runtime:
	docker run -ti \
	--rm \
	-p 24224:24224 \
	-v $(shell pwd)/env/docker/fluentbit-forwarder:/etc/td-agent-bit \
	${FLUENT_BIT_RUNTIME_TAG}
