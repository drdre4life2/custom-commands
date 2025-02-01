<?php
namespace Drdre4life2\CustomCommand;

use Illuminate\Support\ServiceProvider;
use Drdre4life2\CustomCommand\Commands\CreateActionCommand;
use Drdre4life2\CustomCommand\Commands\CreateDTOCommand;
use Drdre4life2\CustomCommand\Commands\CreateServiceCommand;

class CustomCommandServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            CreateActionCommand::class,
            CreateDTOCommand::class,
            CreateServiceCommand::class

        ]);
    }

}
