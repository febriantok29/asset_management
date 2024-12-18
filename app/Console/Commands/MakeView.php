<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create index, create, edit, and show views for a resource';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $viewPath = resource_path("views/{$name}");

        // Cek jika folder sudah ada
        if (File::exists($viewPath)) {
            $this->error("The view folder '{$name}' already exists!");
            return Command::FAILURE;
        }

        // Buat folder
        File::makeDirectory($viewPath, 0755, true);

        // Buat file view
        $views = ['index', 'create', 'edit', 'show'];
        foreach ($views as $view) {
            $filePath = "{$viewPath}/{$view}.blade.php";
            File::put($filePath, "<!-- {$view} view for {$name} -->");
        }

        $this->info("Views for '{$name}' have been created successfully.");
        return Command::SUCCESS;
    }
}
