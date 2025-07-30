<?php

namespace ProcessMaker\Package\DockerExecutorNode;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Models\ScriptExecutor;
use ProcessMaker\Traits\PluginServiceProviderTrait;

class DockerExecutorNodeServiceProvider extends ServiceProvider
{
    use PluginServiceProviderTrait;

    public const version = '1.1.1'; // Required for PluginServiceProviderTrait

    public function register()
    {
    }

    public function boot()
    {
        \Artisan::command('docker-executor-node:install {--rebuild} {--no-build : Skip building the script executor image}', function () {
            $scriptExecutor = ScriptExecutor::install([
                'language' => 'javascript',
                'title' => 'Node Executor',
                'description' => 'Default Javascript/Node Executor',
            ]);

            // Build the instance image. This is the same as if you were to build it from the admin UI
            // Skip building the image if the --no-build option is passed
            if (!$this->option('no-build')) {
                $cmd = 'processmaker:build-script-executor ' . $scriptExecutor->id;
                if ($this->option('rebuild')) {
                    $cmd .= ' --rebuild';
                }
                $this->info("Running artisan cmd: $cmd");
                \Artisan::call($cmd);
                $this->info(\Artisan::output());
            }

            // Restart the workers so they know about the new supported language
            //\Artisan::call('horizon:terminate');
        });

        $this->commands([TestDocs::class]);

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
            'package_version' => self::version,
        ];
        config(['script-runners.javascript' => $config]);

        $this->completePluginBoot();
    }
}
