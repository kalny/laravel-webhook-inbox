<?php

it('successfully call webhook', function () {
    $response = $this->postJson('/webhooks/paddle');

    expect($response->json('provider'))->toBe('paddle');
});
