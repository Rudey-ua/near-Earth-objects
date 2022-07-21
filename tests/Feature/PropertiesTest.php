<?php

test('it can get index page', function (){

    $response = $this->getJson(route('api.index.page'));
    $response->assertOk();
});

test('it can get render fastest page', function (){

    $response = $this->getJson(route('api.fastest.page'));
    $response->assertOk();
});

test('it can get render danger page', function (){

    $response = $this->getJson(route('api.danger.page'));
    $response->assertOk();
});
