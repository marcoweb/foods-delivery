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