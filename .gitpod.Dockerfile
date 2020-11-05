FROM gitpod/workspace-mysql

USER root

RUN apt-get update \
 && apt-get install -y sendmail \
 && chown root:smmsp /usr/lib/sm.bin/sendmail \
 && chmod 2555 /usr/lib/sm.bin/sendmail \
 && chmod 777 /var/spool/mqueue \
 && chmod 777 /var/spool/mqueue-client \
 && chmod 777 /var/spool/mail \
 && cat /etc/hostname > /etc/hosts

RUN sed -i '/#!\/bin\/sh/aservice sendmail restart' /usr/local/bin/docker-php-entrypoint

RUN sed -i '/#!\/bin\/sh/aecho "$(hostname -i)\t$(hostname) $(hostname).localhost" >> /etc/hosts' /usr/local/bin/docker-php-entrypoint