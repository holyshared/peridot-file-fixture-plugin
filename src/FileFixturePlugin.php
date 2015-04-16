<?php

/**
 * This file is part of file-fixture-plugin.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace holyshared\fixture\peridot;

use holsyahred\fixture\FileFixture;
use holsyahred\fixture\factory\FxitureContainerFactory;
use holsyahred\fixture\container\LoaderContainer;
use holsyahred\fixture\loader\TextLoader;
use holsyahred\fixture\loader\MustacheLoader;
use holsyahred\fixture\loader\ArtLoader;
use Evenement\EventEmitterInterface;
use Peridot\Core\Suite;


class FileFixturePlugin implements Registrar
{

    private $scope;
    private $configFile;

    public function __construct($configFile)
    {
        $this->configFile = $configFile;
    }

    public function registerTo(EventEmitterInterface $emitter)
    {
        $emitter->on(self::START_EVENT, [ $this, 'onStart' ]);
        $emitter->on(self::SUITE_START_EVENT, [ $this, 'onSuiteStart' ]);
    }

    public function onStart()
    {
        $textLoader = new TextLoader();
        $mustacheLoader = new MustacheLoader($textLoader);
        $artLoader = new ArtLoader($mustacheLoader);

        $loaders = new LoaderContainer([ $textLoader, $mustacheLoader, $artLoader]);

        $factory = new FxitureContainerFactory();
        $fixtures = $factory->createFromFile($this->configFile);

        $fixture = new FileFixture($fixtures, $loaders);
        $this->scope = new FileFixtureScope($fixture);

        return $this;
    }

    public function onSuiteStart(Suite $suite)
    {
        $parentScope = $suite->getScope();
        $parentScope->peridotAddChildScope($this->scope);
    }

}
