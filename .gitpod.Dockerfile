FROM gitpod/workspace-mysql

USER root

#RUN apt-get update \
# && apt-get install -y sendmail \
# && chown root:smmsp /usr/lib/sm.bin/sendmail \
# && chmod 2555 /usr/lib/sm.bin/sendmail \
# && chmod 777 /var/spool/mqueue \
# && chmod 777 /var/spool/mqueue-client \
# && chmod 777 /var/spool/mail \
# && cat /etc/hostname > /etc/hosts

RUN apt-get update \
    && apt-get install -q -y ssmtp mailutils

# root is the person who gets all mail for userids < 1000
RUN echo "root=yourAdmin@email.com" >> /etc/ssmtp/ssmtp.conf

# Here is the gmail configuration (or change it to your private smtp server)
RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthUser="${GMAIL_ACCOUNT} >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthPass="${GMAIL_PASSWORD} >> /etc/ssmtp/ssmtp.conf

RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf

RUN adduser gitpod mail

# Set up php sendmail config
# RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini
