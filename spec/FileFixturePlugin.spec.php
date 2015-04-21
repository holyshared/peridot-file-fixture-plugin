<?php

use holyshared\fixture\peridot\FileFixturePlugin;
use Peridot\Core\Suite;
use Prophecy\Prophet;
use Prophecy\Argument;


describe('FileFixturePlugin', function() {
    describe('#registerTo()', function() {
        beforeEach(function() {
            $this->prophet = new Prophet();
            $this->plugin = new FileFixturePlugin(__DIR__ . '/fixtures/fixtures.toml');

            $emitter = $this->prophet->prophesize('Evenement\EventEmitterInterface');
            $emitter->on(FileFixturePlugin::START_EVENT, [ $this->plugin, 'onStart' ]);
            $emitter->on(FileFixturePlugin::SUITE_START_EVENT, [ $this->plugin, 'onSuiteStart' ]);

            $this->plugin->registerTo( $emitter->reveal() );
        });
        it('registered plugin object to emitter', function() {
            $this->prophet->checkPredictions();
        });
    });
    describe('#onSuiteStart()', function() {
        beforeEach(function() {
            $this->suite = new Suite('default', function() {});
            $this->plugin = new FileFixturePlugin(__DIR__ . '/fixtures/fixtures.toml');
            $this->plugin->onStart();
            $this->plugin->onSuiteStart($this->suite);
            $this->scope = $this->suite->getScope();
        });
        it('registered the fixture scope object to the parent of scope object', function() {
            $content = $this->scope->loadFixture('text:default:ok');
            expect($content)->toEqual("static");
        });
    });
});
