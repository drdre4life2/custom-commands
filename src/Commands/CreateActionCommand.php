<?php
namespace Drdre4life2\CustomCommand\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateActionCommand extends Command
{
    protected $signature = 'make:action {name : The name of the Action class}';
    protected $description = 'Create a new Action class';

    public function handle()
    {
        $name = $this->argument('name');
        $namespace = 'App\\Actions';
        $path = app_path('Actions');
        $filePath = $path . '/' . $name . '.php';

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($filePath)) {
            $this->error("Action already exists: {$filePath}");
            return Command::FAILURE;
        }

        $template = <<<EOT
<?php

namespace $namespace;

class $name
{
    public function execute(\$data)
    {
        // Implement the action logic here
    }
}
EOT;

        File::put($filePath, $template);
        $this->info("Action created successfully: {$filePath}");
        return Command::SUCCESS;
    }
}
