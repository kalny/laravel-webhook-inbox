<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Kalny\LaravelWebhookInbox\Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in('Feature');
