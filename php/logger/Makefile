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
	--name fluentbit \
	-v $(shell pwd)/env/docker/fluentbit-forwarder:/etc/td-agent-bit \
	-v $(shell pwd)/log/td-agent-bit:/data/log/td-agent-bit \
	${FLUENT_BIT_RUNTIME_TAG}

td-agent-d-in-runtime:
	docker run -it \
	--rm \
    -p 24231:24231 \
    -p 24224:24224 \
	--name fluentd \
	-v $(shell pwd)/env/docker/fluentd-aggregator/fluent.conf:/fluentd/etc/fluent.conf \
	${FLUENTD_RUNTIME_TAG}

start: \
	td-agent-d-in-runtime
# tail -F /data/log/scribe/default_primary/bie-sc2bq-log/bie-sc2bq-log_current
# dstat
# watch -n1 --color 'ls -lsth /data/log/scribe/default_primary/bie-sc2bq-log/ --color'
# /data/app/proof-of-concept/php/logger/bin/test_stress.sh  (x parallel)

prometheus:
	docker run -it \
    	--rm \
    	-p 9090:9090 \
    	--name prometheus \
    	-v $(shell pwd)/env/docker/prometheus/prometheus.yml:/etc/prometheus/prometheus.yml \
        prom/prometheus