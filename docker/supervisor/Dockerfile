FROM phpdockerio/php74-cli:latest
#WORKDIR "/application"
# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.4-mysql php7.4-redis php7.4-gd php7.4-imagick php7.4-intl php7.4-mongodb php7.4-xsl php7.4-yaml vim php7.4-soap php7.4-sqlite3

# Update Composer
RUN composer self-update

# Install supervisor
RUN apt-get -y install cron supervisor

# Add supervisord config file
COPY supervisord.conf /etc/supervisord.conf

# Create log directory
RUN mkdir -p /var/log/supervisor

# Configure CRON and fix permissions
COPY crontab /etc/crontab
RUN chmod 644 /etc/crontab

# Cleanup
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && export TERM=xterm

# Apply custom php.ini
COPY php-ini-overrides.ini /etc/php/7.4/cli/conf.d/99-overrides.ini

#enable apcu
RUN echo apc.enable_cli=1 >> /etc/php/7.4/cli/conf.d/20-apcu.ini
RUN echo apc.shm_size=512M >> /etc/php/7.4/cli/conf.d/20-apcu.ini

# Switch container to superevisord
ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
# initial is on

# Expose port for Supervisor and php-fpm
EXPOSE 8001