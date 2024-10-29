<?php
session_start();

include "vendor/autoload.php";

use app\app\app;

class TestApp extends PHPUnit\Framework\TestCase {
    private app $app;
    protected function setUp(): void
    {
        $this->app = new app();
    }
    // php vendor/bin/phpunit test/TestApp.php --colors
    public function testIsStatusArray(){

        ob_start();
        $this->app->status();
        $output = ob_get_clean();

        $this->assertJson($output);
    }

    public function testSetStufe()
    {
        $this->assertTrue($this->app->setStufe(1));
        $this->assertTrue($this->app->setStufe(2));
        $this->assertTrue($this->app->setStufe(3));
        $this->assertFalse($this->app->setStufe(4));
    }
}