<?php

namespace Drdre4life2\CustomCommand\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateServiceCommand extends Command
{
    protected $signature = 'make:service {name : The name of the Service class}';
    protected $description = 'Create service class';

    public function handle()
    {
        $name = $this->argument('name');
        $namespace = 'App\\Services';
        $path = app_path('Services');
        $filePath = $path . '/' . $name . '.php';

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Check if the DTO already exists
        if (File::exists($filePath)) {
            $this->error("Service class already exists: {$filePath}");
            return Command::FAILURE;
        }

        // DTO template
        $template = <<<EOT
<?php

namespace $namespace;

use Illuminate\Http\Request;

class $name
{
    public function __construct(
        public array \$data
    ) {}

    public static function $name(Request \$request)
    {
    
    }
}
EOT;

        // Write the file
        File::put($filePath, $template);
        $this->info("Service class created successfully: {$filePath}");
        return Command::SUCCESS;
    }
}
