PHP8_JIT_RUNTIME_TAG='chirichidi/proof-of-concept-php8-jit-runtime'
FLUENT_BIT_RUNTIME_TAG='chirichidi/td-agent-bit'
FLUENTD_RUNTIME_TAG='chirichidi/td-agent-d'


build: \
	install-php8-jit \
	composer-install-in-runtime \
	install-td-agent-bit \
	install-td-agent-d

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

install-td-agent-d:
	docker build \
            --tag ${FLUENTD_RUNTIME_TAG} \
            ./env/docker/fluentd-aggregator

td-agent-bit-in-runtime:
	docker run -ti \
	--rm \
	--network host \
	-p 24225:24225 \
	--name fluentbit \
	-v $(shell pwd)/env/docker/fluentbit-forwarder:/etc/td-agent-bit \
	-v $(shell pwd)/log/td-agent-bit:/data/log/td-agent-bit \
	${FLUENT_BIT_RUNTIME_TAG}

td-agent-d-in-runtime:
	docker run -it \
	--rm \
	--network host \
	-p 24224:24224 \
	--name fluentd \
	-v $(shell pwd)/env/docker/fluentd-aggregator/fluent.conf:/fluentd/etc/fluent.conf \
	-v $(shell pwd)/log/td-agent-bit:/fluentd/tmp/log \
	-v $(shell pwd)/log/td-agent-d:/fluentd/log \
	${FLUENTD_RUNTIME_TAG}