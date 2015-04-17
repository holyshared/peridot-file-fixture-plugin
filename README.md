peridot-file-fixture-plugin
====================================

[![Build Status](https://travis-ci.org/holyshared/peridot-file-fixture-plugin.svg?branch=master)](https://travis-ci.org/holyshared/peridot-file-fixture-plugin)
[![HHVM Status](http://hhvm.h4cc.de/badge/holyshared/peridot-file-fixture-plugin.svg)](http://hhvm.h4cc.de/package/holyshared/peridot-file-fixture-plugin)
[![Coverage Status](https://coveralls.io/repos/holyshared/peridot-file-fixture-plugin/badge.svg)](https://coveralls.io/r/holyshared/peridot-file-fixture-plugin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/holyshared/peridot-file-fixture-plugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/holyshared/peridot-file-fixture-plugin/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/552f70b810e714f9e5000d0c/badge.svg?style=flat)](https://www.versioneye.com/user/projects/552f70b810e714f9e5000d0c)
[![Stories in Ready](https://badge.waffle.io/holyshared/peridot-file-fixture-plugin.png?label=ready&title=Ready)](https://waffle.io/holyshared/peridot-file-fixture-plugin)

Basic usage
------------------------------------

Register the plugin to be able to use in peridot.  
Please the configuration file see the [file-fixture](https://github.com/holyshared/file-fixture).

```php
use Evenement\EventEmitterInterface;
use holyshared\fixture\peridot\FileFixturePlugin;

return function(EventEmitterInterface $emitter)
{
    $plugin = new FileFixturePlugin(__DIR__ . '/fixtures.toml');
    $plugin->registerTo($emmiter);
};
```

By calling the **loadFixture** method in spec, you can load the fixture.

```php
describe('Example', function() {
    describe('output', function() {
        it('return message for user', function() {
            $content = $this->loadFixture('text:console', [ 'name' => 'Jhon' ]);
            expect('My name is Jhon')->toEqual($content);
        });
    });
});
```
