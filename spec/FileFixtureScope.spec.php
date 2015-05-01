<?php

use holyshared\fixture\FileFixture;
use holyshared\peridot\FileFixtureScope;
use holyshared\fixture\Loader;
use holyshared\fixture\Container;
use Prophecy\Prophet;

describe(FileFixtureScope::class, function() {
    beforeEach(function() {
        $prophet = new Prophet();

        $loader = $prophet->prophesize(Loader::class);
        $loader->load('/path/to/fixture', [])->willReturn('fixture content');

        $fixtures = $prophet->prophesize(Container::class);
        $fixtures->get('text:test')->willReturn('/path/to/fixture');

        $loaders = $prophet->prophesize(Container::class);
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
