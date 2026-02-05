<?php

namespace App\Modules\Base\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}
                            {--model= : Specify a different model name}
                            {--api : Create API controllers only}
                            {--dashboard : Create Dashboard controllers only}
                            {--with-tests : Generate test files}
                            {--with-factory : Generate factory files}
                            {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module with Model, Repository, Service, Request, Controller, Resource, and Routes';

    /**
     * Validate module name
     */
    protected function validateModuleName(string $moduleName): bool
    {
        return preg_match('/^[A-Z][a-zA-Z0-9]*$/', $moduleName);
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
     * Execute the console command.
     */
    public function handle()
    {
        $moduleName = $this->argument('name');

        // Validate module name
        if (! $this->validateModuleName($moduleName)) {
            $this->error('Invalid module name! Module name must start with an uppercase letter and contain only letters and numbers.');
            $this->comment('Example: make:module Products');

            return 1;
        }

        $modelName = $this->option('model') ?: $moduleName;

        $this->info("Creating module: {$moduleName}");

        // Create directories
        $this->createDirectories($moduleName);

        // Create files
        $this->createModel($moduleName, $modelName);
        $this->createMigration($moduleName, $modelName);
        $this->createRepositoryInterface($moduleName, $modelName);
        $this->createRepository($moduleName, $modelName);
        $this->createService($moduleName, $modelName);
        $this->createStoreRequest($moduleName, $modelName);
        $this->createUpdateRequest($moduleName, $modelName);
        $this->createController($moduleName, $modelName);
        $this->createResource($moduleName, $modelName);
        $this->createDetailsResource($moduleName, $modelName);
        $this->createRoutes($moduleName, $modelName);
        $this->createServiceProvider($moduleName);
        $this->createViews($moduleName, $modelName);

        // Optional files
        if ($this->option('with-factory')) {
            $this->createFactory($moduleName, $modelName);
        }

        if ($this->option('with-tests')) {
            $this->createTests($moduleName, $modelName);
        }

        // Always create seeder
        $this->createSeeder($moduleName, $modelName);

        $this->info("Module {$moduleName} created successfully!");
        $this->comment('Note: Routes and Repository bindings are automatically loaded. ServiceProvider registration is optional.');
        $this->comment("Don't forget to run: php artisan migrate");
    }

    /**
     * Create module directories
     *
     * @param  string  $moduleName
     */
    protected function createDirectories($moduleName)
    {
        $directories = [
            "app/Modules/{$moduleName}/Models",
            "app/Modules/{$moduleName}/Repositories",
            "app/Modules/{$moduleName}/Services",
            "app/Modules/{$moduleName}/Http/Requests",
            "app/Modules/{$moduleName}/Http/Controllers/Dashboard",
            "app/Modules/{$moduleName}/Http/Controllers/Api",
            "app/Modules/{$moduleName}/Http/Resources",
            "app/Modules/{$moduleName}/Routes",
            "app/Modules/{$moduleName}/Providers",
            "app/Modules/{$moduleName}/Database/Migrations",
            "app/Modules/{$moduleName}/Database/Seeders",
            "app/Modules/{$moduleName}/Database/Factories",
            "app/Modules/{$moduleName}/Tests/Feature",
            "app/Modules/{$moduleName}/Tests/Unit",
            "app/Modules/{$moduleName}/Resources/views",
        ];

        foreach ($directories as $directory) {
            if (! File::exists(base_path($directory))) {
                File::makeDirectory(base_path($directory), 0755, true);
            }
        }
    }

    protected function createMigration($moduleName, $modelName)
    {
        $stub = $this->getStub('Migration');
        $tableName = Str::snake(Str::plural($modelName));
        $className = 'Create'.Str::plural($modelName).'Table';
        $content = str_replace(
            ['{{ClassName}}', '{{tableName}}'],
            [$className, $tableName],
            $stub
        );

        // Add microseconds to avoid timestamp conflicts
        $timestamp = date('Y_m_d_His').'_'.substr(microtime(true) * 10000, -6);
        $fileName = "{$timestamp}_create_{$tableName}_table.php";
        $path = base_path("app/Modules/{$moduleName}/Database/Migrations/{$fileName}");
        File::put($path, $content);
        $this->info("Created Migration: {$path}");
    }

    protected function createModel($moduleName, $modelName)
    {
        $stub = $this->getStub('Model');
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Models/{$modelName}.php");
        if ($this->shouldCreateFile($path)) {
            File::put($path, $content);
            $this->info("Created Model: {$path}");
        }
    }

    protected function createRepositoryInterface($moduleName, $modelName)
    {
        $stub = $this->getStub('RepositoryInterface');
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Repositories/{$modelName}RepositoryInterface.php");
        File::put($path, $content);
        $this->info("Created Repository Interface: {$path}");
    }

    protected function createRepository($moduleName, $modelName)
    {
        $stub = $this->getStub('Repository');
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Repositories/{$modelName}Repository.php");
        File::put($path, $content);
        $this->info("Created Repository: {$path}");
    }

    protected function createService($moduleName, $modelName)
    {
        $stub = $this->getStub('Service');
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}', '{{modelVariable}}'],
            [$moduleName, $modelName, Str::camel($modelName)],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Services/{$modelName}Service.php");
        if ($this->shouldCreateFile($path)) {
            File::put($path, $content);
            $this->info("Created Service: {$path}");
        }
    }

    protected function createStoreRequest($moduleName, $modelName)
    {
        $stub = $this->getStub('StoreRequest');
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Http/Requests/Store{$modelName}Request.php");
        File::put($path, $content);
        $this->info("Created Store Request: {$path}");
    }

    protected function createUpdateRequest($moduleName, $modelName)
    {
        $stub = $this->getStub('UpdateRequest');
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Http/Requests/Update{$modelName}Request.php");
        File::put($path, $content);
        $this->info("Created Update Request: {$path}");
    }

    protected function createController($moduleName, $modelName)
    {
        $createApi = $this->option('api') || ! $this->option('dashboard');
        $createDashboard = $this->option('dashboard') || ! $this->option('api');

        // Create API Controller
        if ($createApi) {
            $stub = $this->getStub('ApiController');
            $content = str_replace(
                ['{{ModuleName}}', '{{ModelName}}', '{{modelVariable}}'],
                [$moduleName, $modelName, Str::camel($modelName)],
                $stub
            );

            $path = base_path("app/Modules/{$moduleName}/Http/Controllers/Api/{$modelName}Controller.php");
            if ($this->shouldCreateFile($path)) {
                File::put($path, $content);
                $this->info("Created API Controller: {$path}");
            }
        }

        // Create Dashboard Controller
        if ($createDashboard) {
            $stub = $this->getStub('DashboardController');
            $content = str_replace(
                ['{{ModuleName}}', '{{ModelName}}', '{{modelVariable}}'],
                [$moduleName, $modelName, Str::camel($modelName)],
                $stub
            );

            $path = base_path("app/Modules/{$moduleName}/Http/Controllers/Dashboard/{$modelName}Controller.php");
            if ($this->shouldCreateFile($path)) {
                File::put($path, $content);
                $this->info("Created Dashboard Controller: {$path}");
            }
        }
    }

    protected function createResource($moduleName, $modelName)
    {
        $stub = $this->getStub('Resource');
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Http/Resources/{$modelName}Resource.php");
        File::put($path, $content);
        $this->info("Created Resource: {$path}");
    }

    protected function createDetailsResource($moduleName, $modelName)
    {
        $stub = $this->getStub('DetailsResource');
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Http/Resources/{$modelName}DetailsResource.php");
        File::put($path, $content);
        $this->info("Created Details Resource: {$path}");
    }

    protected function createRoutes($moduleName, $modelName)
    {
        $routeName = Str::kebab(Str::plural($modelName));

        // Create mobile.php routes
        $mobileStub = $this->getStub('MobileRoutes');
        $mobileContent = str_replace(
            ['{{ModuleName}}', '{{ModelName}}', '{{routeName}}'],
            [$moduleName, $modelName, $routeName],
            $mobileStub
        );
        $mobilePath = base_path("app/Modules/{$moduleName}/Routes/mobile.php");
        File::put($mobilePath, $mobileContent);
        $this->info("Created Mobile Routes: {$mobilePath}");

        // Create dashboard.php routes
        $dashboardStub = $this->getStub('DashboardRoutes');
        $dashboardContent = str_replace(
            ['{{ModuleName}}', '{{ModelName}}', '{{routeName}}'],
            [$moduleName, $modelName, $routeName],
            $dashboardStub
        );
        $dashboardPath = base_path("app/Modules/{$moduleName}/Routes/dashboard.php");
        File::put($dashboardPath, $dashboardContent);
        $this->info("Created Dashboard Routes: {$dashboardPath}");

        // Create web.php routes
        $webStub = $this->getStub('WebRoutes');
        $webContent = str_replace(
            ['{{ModuleName}}', '{{ModelName}}', '{{routeName}}'],
            [$moduleName, $modelName, $routeName],
            $webStub
        );
        $webPath = base_path("app/Modules/{$moduleName}/Routes/web.php");
        File::put($webPath, $webContent);
        $this->info("Created Web Routes: {$webPath}");

        // Create console.php routes
        $consoleStub = $this->getStub('ConsoleRoutes');
        $consoleContent = str_replace(
            ['{{ModuleName}}'],
            [$moduleName],
            $consoleStub
        );
        $consolePath = base_path("app/Modules/{$moduleName}/Routes/console.php");
        File::put($consolePath, $consoleContent);
        $this->info("Created Console Routes: {$consolePath}");
    }

    protected function createServiceProvider($moduleName)
    {
        $stub = $this->getStub('ServiceProvider');
        $content = str_replace(
            ['{{ModuleName}}'],
            [$moduleName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Providers/{$moduleName}ServiceProvider.php");
        if ($this->shouldCreateFile($path)) {
            File::put($path, $content);
            $this->info("Created Service Provider: {$path}");
        }
    }

    protected function createSeeder($moduleName, $modelName)
    {
        $stub = $this->getStub('Seeder');
        $tableName = Str::snake(Str::plural($modelName));
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}', '{{tableName}}'],
            [$moduleName, $modelName, $tableName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Database/Seeders/{$modelName}Seeder.php");
        if ($this->shouldCreateFile($path)) {
            File::put($path, $content);
            $this->info("Created Seeder: {$path}");
        }
    }

    protected function createFactory($moduleName, $modelName)
    {
        $stub = $this->getStub('Factory');
        $content = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $stub
        );

        $path = base_path("app/Modules/{$moduleName}/Database/Factories/{$modelName}Factory.php");
        if ($this->shouldCreateFile($path)) {
            File::put($path, $content);
            $this->info("Created Factory: {$path}");
        }
    }

    protected function createTests($moduleName, $modelName)
    {
        // Feature Test
        $featureStub = $this->getStub('FeatureTest');
        $featureContent = str_replace(
            ['{{ModuleName}}', '{{ModelName}}', '{{modelVariable}}'],
            [$moduleName, $modelName, Str::camel($modelName)],
            $featureStub
        );

        $featurePath = base_path("app/Modules/{$moduleName}/Tests/Feature/{$modelName}Test.php");
        if ($this->shouldCreateFile($featurePath)) {
            File::put($featurePath, $featureContent);
            $this->info("Created Feature Test: {$featurePath}");
        }

        // Unit Test
        $unitStub = $this->getStub('UnitTest');
        $unitContent = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $unitStub
        );

        $unitPath = base_path("app/Modules/{$moduleName}/Tests/Unit/{$modelName}Test.php");
        if ($this->shouldCreateFile($unitPath)) {
            File::put($unitPath, $unitContent);
            $this->info("Created Unit Test: {$unitPath}");
        }
    }

    protected function createViews($moduleName, $modelName)
    {
        $routeName = Str::kebab(Str::plural($modelName));

        // Create index view
        $indexStub = $this->getStub('IndexView');
        $indexContent = str_replace(
            ['{{ModuleName}}', '{{ModelName}}', '{{routeName}}'],
            [$moduleName, $modelName, $routeName],
            $indexStub
        );

        $indexPath = base_path("app/Modules/{$moduleName}/Resources/views/index.blade.php");
        if ($this->shouldCreateFile($indexPath)) {
            File::put($indexPath, $indexContent);
            $this->info("Created View: {$indexPath}");
        }

        // Create show view
        $showStub = $this->getStub('ShowView');
        $showContent = str_replace(
            ['{{ModuleName}}', '{{ModelName}}'],
            [$moduleName, $modelName],
            $showStub
        );

        $showPath = base_path("app/Modules/{$moduleName}/Resources/views/show.blade.php");
        if ($this->shouldCreateFile($showPath)) {
            File::put($showPath, $showContent);
            $this->info("Created View: {$showPath}");
        }
    }

    protected function getStub($type)
    {
        $stubs = [
            'Model' => '<?php

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
',
            'Migration' => '<?php

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
',
            'RepositoryInterface' => '<?php

namespace App\Modules\{{ModuleName}}\Repositories;

use App\Modules\Base\Repositories\RepositoryInterface;

interface {{ModelName}}RepositoryInterface extends RepositoryInterface
{
    //
}
',
            'Repository' => '<?php

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
',
            'Service' => '<?php

namespace App\Modules\{{ModuleName}}\Services;

use App\Modules\{{ModuleName}}\Repositories\{{ModelName}}RepositoryInterface;
use App\Modules\{{ModuleName}}\Http\Resources\{{ModelName}}Resource;
use App\Modules\{{ModuleName}}\Http\Resources\{{ModelName}}DetailsResource;
use App\Modules\Base\Http\Traits\Responser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class {{ModelName}}Service
{
    use Responser;

    public function __construct(
        protected {{ModelName}}RepositoryInterface ${{modelVariable}}Repository
    ) {}

    /**
     * Get all items with filters
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $filters = request()->all();
            $perPage = request()->get(\'per_page\', 15);

            // Use Repository paginate with filters
            $items = $this->{{modelVariable}}Repository->paginate($perPage);

            return $this->responseSuccess(200, \'Success\', {{ModelName}}Resource::collection($items));
        } catch (\Exception $e) {
            Log::error(\'Error in {{ModelName}}Service@index: \' . $e->getMessage(), [
                \'trace\' => $e->getTraceAsString()
            ]);
            return $this->responseFail(500, \'Failed to retrieve items\');
        }
    }

    /**
     * Get single item by ID
     *
     * @param int|string $id
     * @return JsonResponse
     */
    public function show(int|string $id): JsonResponse
    {
        try {
            ${{modelVariable}} = $this->{{modelVariable}}Repository->getById($id);
            return $this->responseSuccess(200, \'Success\', new {{ModelName}}DetailsResource(${{modelVariable}}));
        } catch (ModelNotFoundException $e) {
            return $this->responseFail(404, \'Item not found\');
        } catch (\Exception $e) {
            Log::error(\'Error in {{ModelName}}Service@show: \' . $e->getMessage(), [
                \'id\' => $id,
                \'trace\' => $e->getTraceAsString()
            ]);
            return $this->responseFail(500, \'Failed to retrieve item\');
        }
    }

    /**
     * Create new item
     *
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data): JsonResponse
    {
        DB::beginTransaction();
        try {
            ${{modelVariable}} = $this->{{modelVariable}}Repository->create($data);
            DB::commit();
            return $this->responseSuccess(201, \'Created successfully\', new {{ModelName}}DetailsResource(${{modelVariable}}));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(\'Error in {{ModelName}}Service@store: \' . $e->getMessage(), [
                \'data\' => $data,
                \'trace\' => $e->getTraceAsString()
            ]);
            return $this->responseFail(500, \'Failed to create item\');
        }
    }

    /**
     * Update existing item
     *
     * @param int|string $id
     * @param array $data
     * @return JsonResponse
     */
    public function update(int|string $id, array $data): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->{{modelVariable}}Repository->update($id, $data);
            ${{modelVariable}} = $this->{{modelVariable}}Repository->getById($id);
            DB::commit();
            return $this->responseSuccess(200, \'Updated successfully\', new {{ModelName}}DetailsResource(${{modelVariable}}));
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return $this->responseFail(404, \'Item not found\');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(\'Error in {{ModelName}}Service@update: \' . $e->getMessage(), [
                \'id\' => $id,
                \'data\' => $data,
                \'trace\' => $e->getTraceAsString()
            ]);
            return $this->responseFail(500, \'Failed to update item\');
        }
    }

    /**
     * Delete item
     *
     * @param int|string $id
     * @return JsonResponse
     */
    public function destroy(int|string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->{{modelVariable}}Repository->delete($id);
            DB::commit();
            return $this->responseSuccess(200, \'Deleted successfully\');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return $this->responseFail(404, \'Item not found\');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(\'Error in {{ModelName}}Service@destroy: \' . $e->getMessage(), [
                \'id\' => $id,
                \'trace\' => $e->getTraceAsString()
            ]);
            return $this->responseFail(500, \'Failed to delete item\');
        }
    }
}
',
            'StoreRequest' => '<?php

namespace App\Modules\{{ModuleName}}\Http\Requests;

use App\Modules\Base\Http\Requests\BaseRequest;

class Store{{ModelName}}Request extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Example validation rules:
            // \'name\' => [\'required\', \'string\', \'max:255\'],
            // \'email\' => [\'required\', \'email\', \'unique:users,email\'],
            // \'price\' => [\'required\', \'numeric\', \'min:0\'],
            // \'status\' => [\'required\', \'in:active,inactive\'],
            // \'image\' => [\'nullable\', \'image\', \'mimes:jpeg,png,jpg\', \'max:2048\'],
        ];
    }
}
',
            'UpdateRequest' => '<?php

namespace App\Modules\{{ModuleName}}\Http\Requests;

use App\Modules\Base\Http\Requests\BaseRequest;

class Update{{ModelName}}Request extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Example validation rules:
            // \'name\' => [\'sometimes\', \'required\', \'string\', \'max:255\'],
            // \'email\' => [\'sometimes\', \'required\', \'email\', \'unique:users,email,\' . $this->route(\'id\')],
            // \'price\' => [\'sometimes\', \'required\', \'numeric\', \'min:0\'],
            // \'status\' => [\'sometimes\', \'required\', \'in:active,inactive\'],
            // \'image\' => [\'nullable\', \'image\', \'mimes:jpeg,png,jpg\', \'max:2048\'],
        ];
    }
}
',
            'ApiController' => '<?php

namespace App\Modules\{{ModuleName}}\Http\Controllers\Api;

use App\Modules\Base\Http\Controllers\BaseController;
use App\Modules\{{ModuleName}}\Http\Requests\Store{{ModelName}}Request;
use App\Modules\{{ModuleName}}\Http\Requests\Update{{ModelName}}Request;
use App\Modules\{{ModuleName}}\Services\{{ModelName}}Service;
use Illuminate\Http\JsonResponse;

class {{ModelName}}Controller extends BaseController
{
    public function __construct(
        protected {{ModelName}}Service ${{modelVariable}}Service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->{{modelVariable}}Service->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store{{ModelName}}Request $request): JsonResponse
    {
        return $this->{{modelVariable}}Service->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->{{modelVariable}}Service->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update{{ModelName}}Request $request, string $id): JsonResponse
    {
        return $this->{{modelVariable}}Service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->{{modelVariable}}Service->destroy($id);
    }
}
',
            'DashboardController' => '<?php

namespace App\Modules\{{ModuleName}}\Http\Controllers\Dashboard;

use App\Modules\Base\Http\Controllers\BaseController;
use App\Modules\{{ModuleName}}\Http\Requests\Store{{ModelName}}Request;
use App\Modules\{{ModuleName}}\Http\Requests\Update{{ModelName}}Request;
use App\Modules\{{ModuleName}}\Services\{{ModelName}}Service;
use Illuminate\Http\JsonResponse;

class {{ModelName}}Controller extends BaseController
{
    public function __construct(
        protected {{ModelName}}Service ${{modelVariable}}Service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->{{modelVariable}}Service->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store{{ModelName}}Request $request)
    {
        return $this->{{modelVariable}}Service->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->{{modelVariable}}Service->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update{{ModelName}}Request $request, string $id)
    {
        return $this->{{modelVariable}}Service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->{{modelVariable}}Service->destroy($id);
    }
}
',
            'Resource' => '<?php

namespace App\Modules\{{ModuleName}}\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class {{ModelName}}Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            \'id\' => $this->id,
            \'created_at\' => $this->created_at,
            \'updated_at\' => $this->updated_at,
        ];
    }
}
',
            'DetailsResource' => '<?php

namespace App\Modules\{{ModuleName}}\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class {{ModelName}}DetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            \'id\' => $this->id,
            \'created_at\' => $this->created_at,
            \'updated_at\' => $this->updated_at,
        ];
    }
}
',
            'MobileRoutes' => '<?php

use Illuminate\Support\Facades\Route;
use App\Modules\{{ModuleName}}\Http\Controllers\Api\{{ModelName}}Controller;

/*
|--------------------------------------------------------------------------
| {{ModuleName}} Module Mobile Routes
|--------------------------------------------------------------------------
*/

Route::prefix(\'v1\')->middleware([\'auth:api\'])->group(function () {
    Route::apiResource(\'{{routeName}}\', {{ModelName}}Controller::class);
});
',
            'DashboardRoutes' => '<?php

use Illuminate\Support\Facades\Route;
use App\Modules\{{ModuleName}}\Http\Controllers\Dashboard\{{ModelName}}Controller;

/*
|--------------------------------------------------------------------------
| {{ModuleName}} Module Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::prefix(\'dashboard\')->middleware([\'auth:api\', \'role:admin\'])->group(function () {
    Route::apiResource(\'{{routeName}}\', {{ModelName}}Controller::class);
});
',
            'WebRoutes' => '<?php

use Illuminate\Support\Facades\Route;
use App\Modules\{{ModuleName}}\Http\Controllers\Api\{{ModelName}}Controller;

/*
|--------------------------------------------------------------------------
| {{ModuleName}} Module Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware([\'web\'])->group(function () {
    Route::apiResource(\'{{routeName}}\', {{ModelName}}Controller::class);
});
',
            'ConsoleRoutes' => '<?php

use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| {{ModuleName}} Module Console Routes
|--------------------------------------------------------------------------
*/

// Schedule::command(\'inspire\')->hourly();
',
            'Routes' => '<?php

use Illuminate\Support\Facades\Route;
use App\Modules\{{ModuleName}}\Http\Controllers\{{ModelName}}Controller;

/*
|--------------------------------------------------------------------------
| {{ModuleName}} Module API Routes
|--------------------------------------------------------------------------
*/

Route::prefix(\'v1\')->group(function () {
    Route::apiResource(\'{{routeName}}\', {{ModelName}}Controller::class);
});
',
            'ServiceProvider' => '<?php

namespace App\Modules\{{ModuleName}}\Providers;

use Illuminate\Support\ServiceProvider;

class {{ModuleName}}ServiceProvider extends ServiceProvider
{
    /**
     * Register any application services for the module.
     */
    public function register(): void
    {
        // Repository bindings are automatically registered by RepositoryServiceProvider
        // If you need custom bindings, add them here
    }

    /**
     * Bootstrap any module services.
     */
    public function boot(): void
    {
        // Routes, migrations, views, and translations are automatically loaded by AppServiceProvider
        // If you need custom boot logic, add it here
    }
}
',
            'Seeder' => '<?php

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
',
            'Factory' => '<?php

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
',
            'FeatureTest' => '<?php

namespace App\Modules\{{ModuleName}}\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class {{ModelName}}Test extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index endpoint
     */
    public function test_can_list_items(): void
    {
        $response = $this->getJson(\'/api/v1/items\');

        $response->assertStatus(200);
    }

    /**
     * Test store endpoint
     */
    public function test_can_create_item(): void
    {
        $data = [
            // Add your test data here
        ];

        $response = $this->postJson(\'/api/v1/items\', $data);

        $response->assertStatus(201);
    }

    /**
     * Test show endpoint
     */
    public function test_can_show_item(): void
    {
        // Create test data first
        // $item = {{ModelName}}::factory()->create();

        // $response = $this->getJson(\'/api/v1/items/\' . $item->id);

        // $response->assertStatus(200);
    }
}
',
            'UnitTest' => '<?php

namespace App\Modules\{{ModuleName}}\Tests\Unit;

use Tests\TestCase;
use App\Modules\{{ModuleName}}\Models\{{ModelName}};

class {{ModelName}}Test extends TestCase
{
    /**
     * Test model creation
     */
    public function test_can_create_model(): void
    {
        $model = new {{ModelName}}();

        $this->assertInstanceOf({{ModelName}}::class, $model);
    }
}
',
            'IndexView' => '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>{{ModelName}} List</h1>

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Your table data here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
',
            'ShowView' => '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>{{ModelName}} Details</h1>

            <div class="card">
                <div class="card-body">
                    <!-- Your detail view here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
',
        ];

        return $stubs[$type];
    }
}
