# l5cp-module
A basic example module for LaravelCP v2

This Module requires LaravelCP for the base template and management features.

Module example is http://localhost:8000/module

* Clone Module
* Rename
* Rename the "Module" part in namespace Askedio\Laravelcp\Module\
* Rename "l5cp-module" to your module name


# Install

Require
    "askedio/laravelcp": "dev-master",
    "askedio/l5cp-module": "dev-master"


Providers
    Askedio\Laravelcp\Providers\LaravelcpServiceProvider::class,
    Askedio\Laravelcp\Module\Providers\LaravelcpServiceProvider::class,

