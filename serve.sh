#!/bin/bash

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "Error: PHP is not installed."
    exit 1
fi

# Function to get the LAN IP address
get_lan_ip() {
    lan_ip=$(ip addr show up | grep -E 'inet\s' | grep -Ev 'inet6|127.0.0.1' | awk '{print $2}' | cut -d'/' -f1 | head -n1)
    if [[ -z "$lan_ip" ]]; then
        echo "Error: Could not determine LAN IP address."
        exit 1
    fi
    echo "$lan_ip"
}

# Get the LAN IP address
LAN_IP=$(get_lan_ip)

# Default port
PORT=8000

# Check if a custom port is specified
if [[ ! -z "$1" ]]; then
    PORT="$1"
fi

# Start PHP server
php_version=$(php --version | head -n1 | cut -d' ' -f2)
if [[ $php_version =~ ^5.[0-3] ]]; then
    php -S "$LAN_IP":"$PORT" &> /dev/null &
else
    php -S "$LAN_IP":"$PORT" &> /dev/null &
fi

if [[ $? -eq 0 ]]; then
    echo "Server started at http://$LAN_IP:$PORT"
else
    echo "Error: Failed to start server."
    exit 1
fi