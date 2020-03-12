<?php
namespace ProcessMaker\Package\DockerExecutorNode;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Traits\PluginServiceProviderTrait;

class DockerExecutorNodeServiceProvider extends ServiceProvider
{
    use PluginServiceProviderTrait;

    const version = '1.0.0'; // Required for PluginServiceProviderTrait

    public function register()
    {
    }

    public function boot()
    {
        // Note: `processmaker4/executor-node` is now the base image that the instance inherits from
        $image = env('SCRIPTS_NODE_IMAGE', 'processmaker4/executor-instance-javascript:v1.0.0');

        \Artisan::command('docker-executor-node:install', function () {
            
            // Copy the default custom dockerfile to the storage folder
            copy(
                __DIR__ . '/../storage/docker-build-config/Dockerfile-javascript',
                storage_path("docker-build-config/Dockerfile-javascript")
            );

            // Restart the workers so they know about the new supported language
            \Artisan::call('horizon:terminate');

            // Build the base image that `executor-instance-node` inherits from
            system("docker build -t processmaker4/executor-node:latest " . __DIR__ . '/..');

            // Build the instance image. This is the same as if you were to build it from the admin UI
            \Artisan::call('processmaker:build-script-executor javascript');
        });

        $config = [
            'name' => 'JavaScript',
            'runner' => 'NodeRunner',
            'mime_type' => 'text/javascript',
            'image' => $image,
            'options' => ['gitRepoId' => 'sdk-node'],
            'init_dockerfile' => "FROM processmaker4/executor-node:latest\nARG SDK_DIR\n",
        ];
        config(['script-runners.javascript' => $config]);

        $this->completePluginBoot();
    }
}
