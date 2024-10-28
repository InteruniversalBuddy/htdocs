<?php
include "vendor/autoload.php";
use PHPUnit\Framework\TestCase;
use app\app\app;

class TestApp extends TestCase
{
    private app $app;

    protected function setUp(): void
    {
        // Setup, wird vor jedem Test aufgerufen
        $this->app = new app();
    }

    public function testIsStatusArray() {
        ob_start();
        $this->app->status();
        $output = ob_get_clean();

        $this->assertJson($output);
    }

    public function testIsStufeCorrect() {
        ob_start();
        $this->app->stufe();
        $output = ob_get_clean();

    }
}
// php vendor/bin/phpunit test/testCars.php --colors