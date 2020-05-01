<?php

/*
 * @author Michal Škop <programatorsk@gmail.com>
 * @copyright 2020 Michal Škop
 * @link https://github.com/otazniksk/git-hooks.git
 */

namespace Hooks;

use Hooks\Exception\PreCommitException;

class PreCommit
{
    private const PHP_CS_FIXER_PHAR = 'php-cs-fixer-v2-16-3.phar';

    private $startTime;

    private $currentDir;

    private $currentDirName;

    public function __construct($currentDir)
    {
        $this->currentDir = $currentDir;
        $this->currentDirName = basename($this->currentDir);
    }

    /**
     * @param bool $test
     */
    public function proccess(bool $test = false): void
    {
        //start pre-commit proccess
        $this->start();

        try {
            $csFixerConfig = $this->checkCsFixerConfig();

            $output = [];
            if ($test) {
                $output[] = '/Tests/file.php';
            } else {
                exec('git diff --cached --name-status --diff-filter=ACM', $output);
            }

            foreach ($output as $file) {
                $fileName = trim(substr($file, 1));
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if ('php' === $ext) {
                    $this->checkPhpSyntax($fileName);
                }

                exec('php '.$csFixerConfig['cs_fixer'].' fix '.escapeshellarg($fileName).' --config="'.$csFixerConfig['cs_fixer_config'].'"', $csFixerOutput, $returnCode);

                if (!$test) {
                    exec('git add '.escapeshellarg($fileName));
                }
            }
        } catch (PreCommitException $e) {
            echo $e->getMessage();
            exit(1);
        }

        //end pre-commit proccess
        $this->end();
    }

    private function start(): void
    {
        $this->startTime = microtime(true);
        echo '*** Pre-commit Hook ***', "\n";
    }

    private function end(): void
    {
        echo '*** Done in ', number_format(microtime(true) - $this->startTime, 2), 's ***', "\n";
        exit(0);
    }

    /**
     * @param string $fileName
     *
     * @throws PreCommitException
     */
    private function checkPhpSyntax(string $fileName): void
    {
        $lintOutput = [];
        exec('php -l '.escapeshellarg($fileName), $lintOutput, $returnCode);

        if (0 !== $returnCode) {
            throw new PreCommitException(implode("\n", $lintOutput));
        }
    }

    /**
     * @throws PreCommitException
     *
     * @return array
     */
    private function checkCsFixerConfig(): array
    {
        $phpCsFixerPath = sprintf('%s/%s', $this->currentDir, self::PHP_CS_FIXER_PHAR);
        $phpCsFixerConfigPath = $this->currentDir.'/.php_cs';

        if (!file_exists($phpCsFixerPath)) {
            throw new PreCommitException(sprintf('%s doesn`t exist.', $phpCsFixerPath));
        }

        if (!file_exists($phpCsFixerConfigPath)) {
            throw new PreCommitException(sprintf('%s doesn`t exist.', $phpCsFixerPath));
        }

        return [
            'cs_fixer' => $phpCsFixerPath,
            'cs_fixer_config' => $phpCsFixerConfigPath,
        ];
    }
}
