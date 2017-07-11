#!/bin/sh
tvservice --preferred > /dev/null
fbset -depth 8; fbset -depth 16; xrefresh
pkill -HUP chromium
