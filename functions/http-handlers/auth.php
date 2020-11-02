<?php
function login_get() {
    return view();
}

function login_post($email = null, $password = null) {
    if(openSession($email, $password)) {
        redirectTo(LOGGED_HOME);
    } else {
        redirectTo(LOGIN_FORM);
    }
}

function logout_get() {
    logout();
    redirectTo(HOME_PAGE);
}