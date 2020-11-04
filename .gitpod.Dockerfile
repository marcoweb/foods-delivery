FROM gitpod/workspace-mysql

USER root

RUN apt-get update \
 && apt-get install -y sendmail \
 && chown root:smmsp /usr/lib/sm.bin/sendmail \
 && chmod 2555 /usr/lib/sm.bin/sendmail \
 && sendmail -L sm-mta -bd -q1h \
 && sendmail -L sm-msp-queue -Ac -q30m