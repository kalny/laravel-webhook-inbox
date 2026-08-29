<?php

it('loads package configuration', function () {
    expect(config('webhook-inbox.providers.paddle.webhook_secret'))
        ->toBe('paddle-test-secret');
});
