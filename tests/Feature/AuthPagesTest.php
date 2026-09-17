<?php

test('public auth pages load without missing asset references', function () {
    $login = $this->get('/login');
    $login->assertOk();
    $login->assertDontSee('css/auth.css');
    $login->assertDontSee('js/auth.js');

    $signup = $this->get('/signup');
    $signup->assertOk();
    $signup->assertDontSee('css/auth.css');
    $signup->assertDontSee('js/auth.js');
});
