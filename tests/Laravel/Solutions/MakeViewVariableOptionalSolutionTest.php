<?php

use Illuminate\Support\Facades\View;
use Spatie\LaravelIgnition\Solutions\MakeViewVariableOptionalSolution;
use Spatie\ErrorSolutions\Laravel\Support\Composer\ComposerClassMap;

beforeEach(function () {
    View::addLocation(__DIR__.'/../stubs/views');

    app()->bind(
        ComposerClassMap::class,
        function () {
            return new ComposerClassMap(__DIR__.'/../../../vendor/autoload.php');
        }
    );
});

it('does not open scheme paths', function () {
    $solution = getSolutionForPath('php://filter/resource=./tests/Laravel/stubs/views/blade-exception.blade.php');
    expect($solution->isRunnable())->toBeFalse();
});

it('does open relative paths', function () {
    $solution = getSolutionForPath('./tests/Laravel/stubs/views/blade-exception.blade.php');
    expect($solution->isRunnable())->toBeTrue();
});

it('does not open other extensions', function () {
    $solution = getSolutionForPath('./tests/Laravel/stubs/views/php-exception.php');
    expect($solution->isRunnable())->toBeFalse();
});

// Helpers
function getSolutionForPath($path): MakeViewVariableOptionalSolution
{
    return new MakeViewVariableOptionalSolution('notSet', $path);
}
