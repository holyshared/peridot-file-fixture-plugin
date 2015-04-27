<?php

/**
 * This file is part of file-fixture-plugin.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace holyshared\peridot;

use holyshared\fixture\FileFixture;
use holyshared\fixture\factory\FixtureContainerFactory;
use holyshared\fixture\container\LoaderContainer;
use holyshared\fixture\loader\TextLoader;
use holyshared\fixture\loader\CacheLoader;
use holyshared\fixture\loader\MustacheLoader;
use holyshared\fixture\loader\ArtLoader;
use Evenement\EventEmitterInterface;
use Peridot\Core\Suite;


class FileFixturePlugin implements Registrar
{

    /**
     * @var \holyshared\peridot\FileFixtureScope
     */
    private $scope;

    /**
     * @var string
     */
    private $configFile;


    /**
     * Create a new plugin
     *
     * @param string $configFile
     */
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
        $textLoader = new CacheLoader(new TextLoader());
        $mustacheLoader = new MustacheLoader($textLoader);
        $artLoader = new ArtLoader($mustacheLoader);

        $loaders = new LoaderContainer([
            $textLoader,
            $mustacheLoader,
            $artLoader
        ]);

        $factory = new FixtureContainerFactory();
        $fixtures = $factory->createFromFile($this->configFile);

        $fixture = new FileFixture($fixtures, $loaders);
        $this->scope = new FileFixtureScope($fixture);

        return $this;
    }

    /**
     * @param \Peridot\Core\Suite $suite
     */
    public function onSuiteStart(Suite $suite)
    {
        $parentScope = $suite->getScope();
        $parentScope->peridotAddChildScope($this->scope);
    }

}
