<?php

use Projek\Slim\Flysystem;

use function Kahlan\{describe, expect, given, it};

describe(Flysystem::class, function () {
    given('settings', function() {
        return [
            'local' => [
                'path' => null,
            ],
        ];
    });

    given('fs', function() {
        return new Flysystem($this->settings);;
    });

    it('Should return plates engine', function () {
        expect($this->fs)->toBeAnInstanceOf(Flysystem::class);
    });
});
