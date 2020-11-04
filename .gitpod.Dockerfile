FROM gitpod/workspace-mysql

USER root

RUN apt-get update \
 && apt-get install -y sendmail