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

use Evenement\EventEmitterInterface;

/**
 * Interface Registrar
 * @package holyshared\peridot
 */
interface Registrar
{
    const START_EVENT = 'runner.start';
    const SUITE_START_EVENT = 'suite.start';

    /**
     * @param EventEmitterInterface $emitter
     */
    public function registerTo(EventEmitterInterface $emitter);
}
