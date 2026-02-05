<?php

namespace App\Modules\Base\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModuleModelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-model {module} {model}
                            {--migration : Create a migration file for the model}
                            {--factory : Create a factory for the model}
                            {--seeder : Create a seeder for the model}
                            {--repository : Create repository and interface for the model}
                            {--all : Create migration, factory, seeder, and repository}
                            {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model inside an existing module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $moduleName = $this->argument('module');
        $modelName = $this->argument('model');

        // Validate module exists
        $modulePath = base_path("app/Modules/{$moduleName}");
        if (! File::exists($modulePath)) {
            $this->error("Module {$moduleName} does not exist!");
            $this->comment('Available modules:');
            $modules = File::directories(base_path('app/Modules'));
            foreach ($modules as $module) {
                $this->line('  - '.basename($module));
            }

            return 1;
        }

        // Validate model name
        if (! preg_match('/^[A-Z][a-zA-Z0-9]*$/', $modelName)) {
            $this->error('Invalid model name! Model name must start with an uppercase letter.');
            $this->comment('Example: make:module-model Products Product');

            return 1;
        }

        $this->info("Creating model {$modelName} in module {$moduleName}");

        // Create model
        $this->createModel($moduleName, $modelName);

        // Check for --all option
        if ($this->option('all')) {
            $this->createMigration($moduleName, $modelName);
            $this->createFactory($moduleName, $modelName);
            $this->createSeeder($moduleName, $modelName);
            $this->createRepository($moduleName, $modelName);
        } else {
            // Create optional components
            if ($this->option('migration')) {
                $this->createMigration($moduleName, $modelName);
            }

            if ($this->option('factory')) {
                $this->createFactory($moduleName, $modelName);
            }

            if ($this->option('seeder')) {
                $this->createSeeder($moduleName, $modelName);
            }

            if ($this->option('repository')) {
                $this->createRepository($moduleName, $modelName);
            }
        }

        $this->info("Model {$modelName} created successfully in {$moduleName} module!");

        if (! $this->option('migration') && ! $this->option('all')) {
            $this->comment('Tip: Use --migration to create a migration file');
        }

        return 0;
    }

    /**
     * Check if file should be created (respects --force option)
     */
    protected function shouldCreateFile(string $path): bool
    {
        if (! File::exists($path)) {
            return true;
        }

        if ($this->option('force')) {
            return true;
        }

        return $this->confirm("File {$path} already exists. Overwrite?", false);
    }

    /**
     * Create the model file
     */
    protected function createModel($moduleName, $modelName)
    {
        $stub = $this->getModelStub();
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        // Ensure Models directory exists
        $modelsDir = base_path("app/Modules/{$moduleName}/Models");
        if (! File::exists($modelsDir)) {
            File::makeDirectory($modelsDir, 0755, true);
        }

        $path = base_path("app/Modules/{$moduleName}/Models/{$modelName}.php");
        if ($this->shouldCreateFile($path)) {
            File::put($path, $content);
            $this->info("✓ Created Model: {$path}");
        } else {
            $this->warn("✗ Skipped Model: {$path}");
        }
    }

    /**
     * Create the migration file
     */
    protected function createMigration($moduleName, $modelName)
    {
        $stub = $this->getMigrationStub();
        $tableName = Str::snake(Str::plural($modelName));
        $className = 'Create'.Str::plural($modelName).'Table';

        $content = str_replace(
            ['{{ClassName}}', '{{tableName}}'],
            [$className, $tableName],
            $stub
        );

        // Ensure Migrations directory exists
        $migrationsDir = base_path("app/Modules/{$moduleName}/Database/Migrations");
        if (! File::exists($migrationsDir)) {
            File::makeDirectory($migrationsDir, 0755, true);
        }

        // Add microseconds to avoid timestamp conflicts
        $timestamp = date('Y_m_d_His').'_'.substr(microtime(true) * 10000, -6);
        $fileName = "{$timestamp}_create_{$tableName}_table.php";
        $path = base_path("app/Modules/{$moduleName}/Database/Migrations/{$fileName}");

        File::put($path, $content);
        $this->info("✓ Created Migration: {$path}");
    }

    /**
     * Create the factory file
     */
    protected function createFactory($moduleName, $modelName)
    {
        $stub = $this->getFactoryStub();
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        // Ensure Factories directory exists
        $factoriesDir = base_path("app/Modules/{$moduleName}/Database/Factories");
        if (! File::exists($factoriesDir)) {
            File::makeDirectory($factoriesDir, 0755, true);
        }

        $path = base_path("app/Modules/{$moduleName}/Database/Factories/{$modelName}Factory.php");
        if ($this->shouldCreateFile($path)) {
            File::put($path, $content);
            $this->info("✓ Created Factory: {$path}");
        } else {
            $this->warn("✗ Skipped Factory: {$path}");
        }
    }

    /**
     * Create the seeder file
     */
    protected function createSeeder($moduleName, $modelName)
    {
        $stub = $this->getSeederStub();
        $tableName = Str::snake(Str::plural($modelName));
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}', '{{tableName}}'],
            [$moduleName, $modelName, $tableName],
            $stub
        );

        // Ensure Seeders directory exists
        $seedersDir = base_path("app/Modules/{$moduleName}/Database/Seeders");
        if (! File::exists($seedersDir)) {
            File::makeDirectory($seedersDir, 0755, true);
        }

        $path = base_path("app/Modules/{$moduleName}/Database/Seeders/{$modelName}Seeder.php");
        if ($this->shouldCreateFile($path)) {
            File::put($path, $content);
            $this->info("✓ Created Seeder: {$path}");
        } else {
            $this->warn("✗ Skipped Seeder: {$path}");
        }
    }

    /**
     * Create repository and interface
     */
    protected function createRepository($moduleName, $modelName)
    {
        // Ensure Repositories directory exists
        $repositoriesDir = base_path("app/Modules/{$moduleName}/Repositories");
        if (! File::exists($repositoriesDir)) {
            File::makeDirectory($repositoriesDir, 0755, true);
        }

        // Create Repository Interface
        $interfaceStub = $this->getRepositoryInterfaceStub();
        $interfaceContent = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $interfaceStub
        );

        $interfacePath = base_path("app/Modules/{$moduleName}/Repositories/{$modelName}RepositoryInterface.php");
        if ($this->shouldCreateFile($interfacePath)) {
            File::put($interfacePath, $interfaceContent);
            $this->info("✓ Created Repository Interface: {$interfacePath}");
        } else {
            $this->warn("✗ Skipped Repository Interface: {$interfacePath}");
        }

        // Create Repository
        $repositoryStub = $this->getRepositoryStub();
        $repositoryContent = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $repositoryStub
        );

        $repositoryPath = base_path("app/Modules/{$moduleName}/Repositories/{$modelName}Repository.php");
        if ($this->shouldCreateFile($repositoryPath)) {
            File::put($repositoryPath, $repositoryContent);
            $this->info("✓ Created Repository: {$repositoryPath}");
        } else {
            $this->warn("✗ Skipped Repository: {$repositoryPath}");
        }
    }

    /**
     * Get the model stub
     */
    protected function getModelStub()
    {
        return '<?php

namespace App\Modules\{{ModuleName}}\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Base\Http\Traits\Filterable;

class {{ModelName}} extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [];

    protected $hidden = [];

    protected $casts = [];

    /**
     * Searchable fields for filtering
     * @var array
     */
    protected $searchableFields = [\'name\'];
}
';
    }

    /**
     * Get the migration stub
     */
    protected function getMigrationStub()
    {
        return '<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(\'{{tableName}}\', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(\'{{tableName}}\');
    }
};
';
    }

    /**
     * Get the factory stub
     */
    protected function getFactoryStub()
    {
        return '<?php

namespace App\Modules\{{ModuleName}}\Database\Factories;

use App\Modules\{{ModuleName}}\Models\{{ModelName}};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\{{ModuleName}}\Models\{{ModelName}}>
 */
class {{ModelName}}Factory extends Factory
{
    protected $model = {{ModelName}}::class;

    /**
     * Define the model\'s default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Add your factory fields here
            // \'name\' => fake()->name(),
            // \'email\' => fake()->unique()->safeEmail(),
            // \'description\' => fake()->sentence(),
        ];
    }
}
';
    }

    /**
     * Get the seeder stub
     */
    protected function getSeederStub()
    {
        return '<?php

namespace App\Modules\{{ModuleName}}\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class {{ModelName}}Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example seeding
        // DB::table(\'{{tableName}}\')->insert([
        //     [\'name\' => \'Example 1\', \'created_at\' => now(), \'updated_at\' => now()],
        //     [\'name\' => \'Example 2\', \'created_at\' => now(), \'updated_at\' => now()],
        // ]);

        // Or using factory
        // \App\Modules\{{ModuleName}}\Models\{{ModelName}}::factory(10)->create();
    }
}
';
    }

    /**
     * Get the repository interface stub
     */
    protected function getRepositoryInterfaceStub()
    {
        return '<?php

namespace App\Modules\{{ModuleName}}\Repositories;

use App\Modules\Base\Repositories\RepositoryInterface;

interface {{ModelName}}RepositoryInterface extends RepositoryInterface
{
    //
}
';
    }

    /**
     * Get the repository stub
     */
    protected function getRepositoryStub()
    {
        return '<?php

namespace App\Modules\{{ModuleName}}\Repositories;

use App\Modules\Base\Repositories\Eloquent\Repository;
use App\Modules\{{ModuleName}}\Models\{{ModelName}};

class {{ModelName}}Repository extends Repository implements {{ModelName}}RepositoryInterface
{
    public function __construct({{ModelName}} $model)
    {
        parent::__construct($model);
    }
}
';
    }
}
