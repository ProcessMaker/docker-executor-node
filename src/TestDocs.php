<?php

namespace ProcessMaker\Package\DockerExecutorNode;

use Illuminate\Console\Command;
use ProcessMaker\Models\Script;
use ProcessMaker\Models\User;

class TestDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docker-executor-node:test-docs {file} {--last}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test examples in SDK docs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $fileContents = file_get_contents(
            __DIR__ . '/../docs/sdk/' . $this->argument('file') . '.md'
        );

        if (preg_match_all('/```javascript[\r\n]+(.*?)```/s', $fileContents, $matches)) {
            $codes = $matches[1];
        }

        if ($this->option('last')) {
            $codes = array_slice($codes, -1);
        }

        try {
            foreach($codes as $code) {
                $this->runCode($code);
            }
        } catch(\ProcessMaker\Exception\ScriptException $e) {
            $stack = $e->getMessage();
            $stack = explode("\n", $stack);
            $stack = array_slice($stack, 0, 15);
            $stack = join("\n", $stack);

            $this->info($stack);
        }
    }

    private function runCode($code)
    {
        $script = Script::create([
            'code' => $code,
            'title' => '_temp',
            'language' => 'javascript',
            'run_as_user_id' => User::where('is_administrator', true)->first()->id,
            'timeout' => 60,
        ]);

        $result = $script->runScript([],[]);

        $script->delete();

        $this->info(print_r($result, true));
    }
}
