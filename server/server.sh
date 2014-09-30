#!/bin/bash
echo "upstream dev {
    server $HHVM_PORT_1337_TCP_ADDR:1337;
}

# Fill in servers for load balancing
upstream production {
    server $HHVM_PORT_1337_TCP_ADDR:1337;
}" > /etc/nginx/sites-enabled/0_streams.conf

memcached -du root;
service nginx start;