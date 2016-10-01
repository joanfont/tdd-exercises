FROM library/php:7.0.11-cli

RUN apt-get update && \
	apt-get -y install git zip unzip&& \
	rm -fr /var/lib/cache/apt/*

ADD . /code/
WORKDIR /code/

ENTRYPOINT ["php"]
CMD ["-h"]

