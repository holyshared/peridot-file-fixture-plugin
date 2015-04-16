<?php

use holyshared\fixture\peridot\FileFixtureScope;
use Prophecy\Prophet;

describe('FileFixtureScope', function() {
    describe('#loadFixture()', function() {
        beforeEach(function() {
            $prophet = new Prophet();

            $loader = $prophet->prophesize('holyshared\fixture\Loadable');
            $loader->load('text:test', [])->willReturn('fixture content');

            $this->scope = new FileFixtureScope( $loader->reveal() );
        });
        it('return loaded fixture content', function() {
            expect($this->scope->loadFixture('text:test'))->toEqual('fixture content');
        });
    });
});
