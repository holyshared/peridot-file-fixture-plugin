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
use Peridot\Core\Scope;


final class FileFixtureScope extends Scope
{

    /**
     * @var \holyshared\fixture\FileFixture
     */
    private $loader;

    /**
     * @param \holyshared\fixture\FileFixture $loader
     */
    public function __construct(FileFixture $loader)
    {
        $this->loader = $loader;
    }

    /**
     * Load the fixture file content by name
     *
     * @param string $name
     * @param array $arguments
     * @return string content of fixture
     */
    public function loadFixture($name, array $arguments = [])
    {
        return $this->loader->load($name, $arguments);
    }

    /**
     * Get the Path from the name of the fixture
     *
     * @param string $name
     * @return string the path of fixture
     */
    public function fixturePath($name)
    {
        return $this->loader->resolveName($name);
    }

}
