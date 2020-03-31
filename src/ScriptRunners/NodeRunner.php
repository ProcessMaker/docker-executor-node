<?php

namespace ProcessMaker\ScriptRunners;

class NodeRunner extends Base
{
    /**
     * Configure docker with node executor
     *
     * @param string $code
     * @param array $dockerConfig
     *
     * @return array
     */
    public function config($code, array $dockerConfig)
    {
        $dockerConfig['image'] = config('script-runners.javascript.image');
        $dockerConfig['command'] = '/bin/sh /opt/executor/run.sh';
        $dockerConfig['inputs']['/opt/executor/script.js'] = $code;
        return $dockerConfig;
    }
}
