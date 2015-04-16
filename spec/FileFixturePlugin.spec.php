<?php

use holyshared\fixture\peridot\FileFixturePlugin;
use Prophecy\Prophet;
use Prophecy\Argument;

describe('FileFixturePlugin', function() {
    describe('#registerTo()', function() {
        beforeEach(function() {
            $this->plugin = new FileFixturePlugin();

            $this->prophet = new Prophet();

            $emitter = $this->prophet->prophesize('Evenement\EventEmitterInterface');
            $emitter->on(FileFixturePlugin::START_EVENT, [ $this->plugin, 'onStart' ]);
            $emitter->on(FileFixturePlugin::SUITE_START_EVENT, [ $this->plugin, 'onSuiteStart' ]);

            $this->plugin->registerTo( $emitter->reveal() );
        });
        it('regiser plugin', function() {
            $this->prophet->checkPredictions();
        });
    });
});
