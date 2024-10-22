<?php

use Projek\Slim\Flysystem;

use function Kahlan\{describe, expect, given, it};

describe(Flysystem::class, function () {
    it('Should return plates engine', function () {
        $fs = new Flysystem($this->settings);

        expect($fs)->toBeAnInstanceOf(Flysystem::class);
    });
});
