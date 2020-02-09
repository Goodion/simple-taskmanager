<?php

if (ini_get("session.name") !== 'session_id') {
    return ini_set("session.name", 'session_id');
}
