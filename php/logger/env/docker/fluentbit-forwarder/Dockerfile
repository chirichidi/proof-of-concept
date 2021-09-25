#fluent bit, google sdk 들은 composer 에서 설치하면 될듯하고,
#fluent bit 환경 설정은 따로 만들어야 함
FROM ubuntu:20.04

# change timezone from UTC to KST
RUN apt-get update && \
    apt-get install -y tzdata && \
    ln -fs /usr/share/zoneinfo/Asia/Seoul /etc/localtime && \
    dpkg-reconfigure --frontend noninteractive tzdata


#1 패키지 설치
# 이렇게 하면 도커 컨테이너 안에서 프로세스 실행 안되지 않나?
WORKDIR /tmp
RUN wget -qO - https://packages.fluentbit.io/fluentbit.key | apt-key add - && \
    echo "deb https://packages.fluentbit.io/ubuntu/focal focal main" >> /etc/apt/sources.list && \
    apt-get update -y && \
    apt-get install -y td-agent-bit


#2 소스코드 설치 \
# 이렇게 하면 도커 컨테이너 안에서 프로세스 실행 안되지 않나?
# install cmake 3.x. why reason is https://docs.fluentbit.io/manual/installation/sources/build-and-install
RUN apt-get update -y && \
    apt-get install -y wget openssl libssl-dev build-essential git && \
    wget https://github.com/Kitware/CMake/releases/download/v3.21.3/cmake-3.21.3.tar.gz && \
    tar -xvf cmake-3.21.3.tar.gz && cd cmake-3.21.3 && \
    ./bootstrap --prefix=/usr && make && make install

# install fluent-bit
COPY ./fluent-bit.conf /tmp/fluent-bit.conf
RUN git clone https://github.com/fluent/fluent-bit && \
    cd fluent-bit/ && cmake -DFLB_STATIC_CONF=/tmp/fluent-bit.conf && make


CMD /opt/td-agent-bit/bin/td-agent-bit -c /etc/td-agent-bit/td-agent-bit.conf