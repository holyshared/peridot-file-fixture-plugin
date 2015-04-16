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

use holsyahred\fixture\Loadable;
use Peridot\Core\Scope;


final class FileFixtureScope extends Scope
{

    private $loader;


    public function __construct(Loadable $loader)
    {
        $this->loader = $loader;
    }

    public function loadFixture($name, $arguments = [])
    {
        return $this->loader->load($name, $arguments);
    }

}
