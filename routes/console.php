<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('make:service-impl-controller {param}', function ($param) {
    $serviceInterfaceDirectory = app_path("Http/Src/v1/Controllers");
    $serviceInterfacePath = "{$serviceInterfaceDirectory}/Controller.php";

    if (!File::exists($serviceInterfaceDirectory)) {
        File::makeDirectory($serviceInterfaceDirectory, 0755, true);

        $serviceInterfaceContent = "<?php\n\n";
        $serviceInterfaceContent .= "namespace App\Http\Src\\v1\Controllers;\n\n";
        $serviceInterfaceContent .= "use App\Http\Src\\v1\Services\\{$param}Service;\n\n";
        $serviceInterfaceContent .= "use Illuminate\Foundation\Auth\Access\AuthorizesRequests;\n";
        $serviceInterfaceContent .= "use Illuminate\Foundation\Validation\ValidatesRequests;\n";
        $serviceInterfaceContent .= "use Illuminate\Routing\Controller as BaseController;\n\n";
        $serviceInterfaceContent .= "class Controller extends BaseController\n";
        $serviceInterfaceContent .= "{\n";
        $serviceInterfaceContent .= "    use AuthorizesRequests, ValidatesRequests;\n";
        $serviceInterfaceContent .= "}\n";
        File::put($serviceInterfacePath, $serviceInterfaceContent);

        $this->info("Base Controller generated successfully: {$serviceInterfacePath}");
    }


    $serviceInterfaceDirectory = app_path("Http/Src/v1/Controllers");
    $serviceInterfacePath = "{$serviceInterfaceDirectory}/{$param}Controller.php";

    if (!File::exists($serviceInterfaceDirectory)) {
        File::makeDirectory($serviceInterfaceDirectory, 0755, true);
    }

    $injection = '$'.strtolower($param);

    $serviceInterfaceContent = "<?php\nnamespace App\Http\Src\\v1\Controllers;\n\n";
    $serviceInterfaceContent .= "use App\Http\Src\\v1\Services\\{$param}Service;\n";
    $serviceInterfaceContent .= "use App\Http\Src\\v1\Controllers\Controller;\n";
    $serviceInterfaceContent .= "class {$param}Controller extends Controller\n";
    $serviceInterfaceContent .= "{\n";
    $serviceInterfaceContent .= "    public function __construct(public {$param}Service {$injection}Service){\n";
    $serviceInterfaceContent .= "       \n";
    $serviceInterfaceContent .= "   }\n";
    $serviceInterfaceContent .= "}\n";
    File::put($serviceInterfacePath, $serviceInterfaceContent);

    $this->info("Controller generated successfully: {$serviceInterfacePath}");


    $serviceInterfaceDirectory = app_path("Http/Src/v1/Services");
    $serviceInterfacePath = "{$serviceInterfaceDirectory}/{$param}Service.php";

    if (!File::exists($serviceInterfaceDirectory)) {
        File::makeDirectory($serviceInterfaceDirectory, 0755, true);
    }

    $serviceInterfaceContent = "<?php\n\nnamespace App\Http\Src\\v1\Services;\n\ninterface {$param}Service\n{\n";
    $serviceInterfaceContent .= "    //Define your methods here\n";
    $serviceInterfaceContent .= "}\n";
    File::put($serviceInterfacePath, $serviceInterfaceContent);

    $this->info("Service interface generated successfully: {$serviceInterfacePath}");


    $serviceInterfaceDirectory = app_path("Http/Src/v1/Implementations");
    $serviceInterfacePath = "{$serviceInterfaceDirectory}/{$param}ServiceImpl.php";

    if (!File::exists($serviceInterfaceDirectory)) {
        File::makeDirectory($serviceInterfaceDirectory, 0755, true);
    }

    $serviceInterfaceContent = "<?php\n\nnamespace App\Http\Src\\v1\Implementations;\n\n\nuse App\Http\Src\\v1\Services\\{$param}Service;\n\nClass {$param}ServiceImpl implements {$param}Service\n{\n";
    $serviceInterfaceContent .= "    //Define your methods here\n";
    $serviceInterfaceContent .= "}\n";
    File::put($serviceInterfacePath, $serviceInterfaceContent);

    $this->info("Service Implementation generated successfully: {$serviceInterfacePath}");
});

