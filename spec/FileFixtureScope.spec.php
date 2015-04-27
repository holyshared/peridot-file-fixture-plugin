<?php

use holyshared\fixture\FileFixture;
use holyshared\peridot\FileFixtureScope;
use Prophecy\Prophet;

describe('FileFixtureScope', function() {
    beforeEach(function() {
        $prophet = new Prophet();

        $loader = $prophet->prophesize('holyshared\fixture\Loader');
        $loader->load('/path/to/fixture', [])->willReturn('fixture content');

        $fixtures = $prophet->prophesize('holyshared\fixture\Container');
        $fixtures->get('text:test')->willReturn('/path/to/fixture');

        $loaders = $prophet->prophesize('holyshared\fixture\Container');
        $loaders->get('text')->willReturn( $loader->reveal() );

        $fileFixture = new FileFixture($fixtures->reveal(), $loaders->reveal());

        $this->scope = new FileFixtureScope($fileFixture);
    });

    describe('#loadFixture()', function() {
        it('return loaded fixture content', function() {
            expect($this->scope->loadFixture('text:test'))->toEqual('fixture content');
        });
    });

    describe('#fixturePath()', function() {
        it('return path of fixture', function() {
            expect($this->scope->fixturePath('text:test'))->toEqual('/path/to/fixture');
        });
    });

});
