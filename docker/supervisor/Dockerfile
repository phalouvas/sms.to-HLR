FROM phpdockerio/php80-cli:latest
#WORKDIR "/application"
# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php8.0-mysql php8.0-redis php8.0-gd php8.0-imagick php8.0-intl php8.0-mongodb php8.0-xsl php8.0-yaml vim php8.0-soap php8.0-sqlite3

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
COPY php-ini-overrides.ini /etc/php/8.0/cli/conf.d/99-overrides.ini

#enable apcu
RUN echo apc.enable_cli=1 >> /etc/php/8.0/cli/conf.d/20-apcu.ini
RUN echo apc.shm_size=512M >> /etc/php/8.0/cli/conf.d/20-apcu.ini

# Switch container to superevisord
ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
# initial is on

# Expose port for Supervisor and php-fpm
EXPOSE 8001