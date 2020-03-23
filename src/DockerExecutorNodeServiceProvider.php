<?php
namespace ProcessMaker\Package\DockerExecutorNode;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Traits\PluginServiceProviderTrait;
use ProcessMaker\Models\ScriptExecutor;

class DockerExecutorNodeServiceProvider extends ServiceProvider
{
    use PluginServiceProviderTrait;

    const version = '1.0.0'; // Required for PluginServiceProviderTrait

    public function register()
    {
    }

    public function boot()
    {
        \Artisan::command('docker-executor-node:install', function () {
            $scriptExecutor = ScriptExecutor::install([
                'language' => 'javascript',
                'title' => 'Node Executor',
                'description' => 'Default Javascript/Node Executor'
            ]);

            // Build the instance image. This is the same as if you were to build it from the admin UI
            \Artisan::call('processmaker:build-script-executor ' . $scriptExecutor->id);
            
            // Restart the workers so they know about the new supported language
            \Artisan::call('horizon:terminate');
        });

        $config = [
            'name' => 'JavaScript',
            'runner' => 'NodeRunner',
            'mime_type' => 'text/javascript',
            'options' => ['gitRepoId' => 'sdk-node'],
            'init_dockerfile' => [
                'ARG SDK_DIR',
                'COPY $SDK_DIR /opt/sdk-node',
                'WORKDIR /opt/sdk-node',
                'RUN npm install',
                'RUN npm run build',
                'WORKDIR /opt/executor',
                'RUN npm install /opt/sdk-node',
            ],
            'package_path' => __DIR__ . '/..',
        ];
        config(['script-runners.javascript' => $config]);

        $this->completePluginBoot();
    }
}
