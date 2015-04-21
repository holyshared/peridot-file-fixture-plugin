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

use holyshared\fixture\Loader;
use Peridot\Core\Scope;


final class FileFixtureScope extends Scope
{

    /**
     * @var \holyshared\fixture\Loader
     */
    private $loader;

    /**
     * @param \holyshared\fixture\Loader $loader
     */
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * Load the fixture file content by name
     *
     * @param string $name
     * @param array $arguments
     */
    public function loadFixture($name, array $arguments = [])
    {
        return $this->loader->load($name, $arguments);
    }

}
