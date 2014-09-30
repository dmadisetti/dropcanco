# DOCKER-VERSION 0.3.4
FROM ubuntu:trusty

ENV DEBIAN_FRONTEND noninteractive

RUN sudo apt-get -y update
RUN sudo apt-get install -y wget
RUN sudo apt-get install -y libmemcached-dev
RUN wget -O - http://dl.hhvm.com/conf/hhvm.gpg.key | sudo apt-key add -
RUN echo deb http://dl.hhvm.com/ubuntu trusty main | sudo tee /etc/apt/sources.list.d/hhvm.list
RUN sudo apt-get -y update
RUN sudo apt-get install -y hhvm
ADD scripts/run.sh /bin/run
RUN chmod +x /bin/run
ADD scripts/debug.sh /bin/debug
RUN chmod +x /bin/debug

VOLUME ["/core"]
EXPOSE 1337
