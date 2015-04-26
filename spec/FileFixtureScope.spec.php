<?php

use holyshared\peridot\FileFixtureScope;
use Prophecy\Prophet;

describe('FileFixtureScope', function() {
    describe('#loadFixture()', function() {
        beforeEach(function() {
            $prophet = new Prophet();

            $loader = $prophet->prophesize('holyshared\fixture\Loader');
            $loader->load('text:test', [])->willReturn('fixture content');

            $this->scope = new FileFixtureScope( $loader->reveal() );
        });
        it('return loaded fixture content', function() {
            expect($this->scope->loadFixture('text:test'))->toEqual('fixture content');
        });
    });
});
