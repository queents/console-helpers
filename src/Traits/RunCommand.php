<?php

namespace Queents\ConsoleHelpers\Traits;

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

trait RunCommand
{

    /**
     * Get the path to the appropriate PHP binary.
     *
     * @return string
     */
    protected function phpBinary(): string
    {
        return (new PhpExecutableFinder())->find(false) ?: 'php';
    }

    /**
     * @param array $commands
     * @return void
     */
    public function phpCommand(array $commands): void
    {
        (new Process(array_merge([$this->phpBinary()], $commands), base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * @param array $commands
     * @return void
     */
    public function yarnCommand(array $commands): void
    {
        (new Process(array_merge([config('console-helpers.yarn-path')], $commands), base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * @param array $command
     * @return void
     */
    public function artisanCommand(array $command): void
    {
        $this->phpCommand(array_merge(['artisan'], $command));
    }
}
