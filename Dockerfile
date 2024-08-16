# Use an official Ubuntu as a parent image
FROM ubuntu:20.04

# Set environment variables
ENV DEBIAN_FRONTEND=noninteractive

# Install necessary packages
RUN apt-get update && \
    apt-get install -y slapd ldap-utils && \
    rm -rf /var/lib/apt/lists/*

# Reconfigure LDAP with explicit settings
RUN echo "slapd slapd/internal/generated_adminpw password admin" | debconf-set-selections && \
    echo "slapd slapd/internal/adminpw password admin" | debconf-set-selections && \
    echo "slapd slapd/password1 password admin" | debconf-set-selections && \
    echo "slapd slapd/password2 password admin" | debconf-set-selections && \
    echo "slapd slapd/domain string example.com" | debconf-set-selections && \
    echo "slapd shared/organization string org" | debconf-set-selections && \
    dpkg-reconfigure -f noninteractive slapd

# Copy the LDIF file
COPY add_user.ldif /etc/ldap/

# Start the LDAP service and drop into a shell for manual testing
CMD service slapd start && sleep 10 && /bin/bash
