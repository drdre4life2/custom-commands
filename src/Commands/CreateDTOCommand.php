<?php

namespace Drdre4life2\CustomCommand\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateDTOCommand extends Command
{
    protected $signature = 'make:dto {name : The name of the DTO class}';
    protected $description = 'Create a new Data Transfer Object (DTO) class';

    public function handle()
    {
        $name = $this->argument('name');
        $namespace = 'App\\DTOs';
        $path = app_path('DTOs');
        $filePath = $path . '/' . $name . '.php';

        // Ensure the DTOs directory exists
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Check if the DTO already exists
        if (File::exists($filePath)) {
            $this->error("DTO already exists: {$filePath}");
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

    public static function fromRequest(Request \$request): self
    {
        return new self(\$request->all());
    }
}
EOT;

        // Write the file
        File::put($filePath, $template);
        $this->info("DTO created successfully: {$filePath}");
        return Command::SUCCESS;
    }
}
