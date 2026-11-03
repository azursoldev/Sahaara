#!/bin/sh
# Support Railway's dynamic PORT if provided, else default to 80
if [ -n "$PORT" ]; then
    find /etc/nginx -type f -exec sed -i "s/listen 80;/listen ${PORT};/g" {} + 2>/dev/null || true
    find /etc/nginx -type f -exec sed -i "s/listen \[::\]:80;/listen [::]:${PORT};/g" {} + 2>/dev/null || true
fi

exec /start.sh
