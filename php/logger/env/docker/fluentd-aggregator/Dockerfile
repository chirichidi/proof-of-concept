FROM fluent/fluentd:v1.14-1
MAINTAINER chirichidi <chirichidi@com2us.com>

USER root

RUN apk add --no-cache --update --virtual .build-deps \
        sudo build-base ruby-dev \
 && sudo gem install fluent-plugin-bigquery \
 && sudo fluent-gem install fluent-plugin-scribe \
 && sudo fluent-gem install fluent-plugin-prometheus \
 && sudo gem sources --clear-all \
 && apk del .build-deps \
 && rm -rf /tmp/* /var/tmp/* /usr/lib/ruby/gems/*/cache/*.gem

COPY entrypoint.sh /bin/
RUN chmod +x /bin/entrypoint.sh

USER fluent
