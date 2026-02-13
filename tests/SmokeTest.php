<?php
use PHPUnit\Framework\TestCase;

final class SmokeTest extends TestCase
{
    public function testPhpUnitWorks(): void
    {
        $this->assertTrue(true);
    }

    public function testMongoExtensionLoaded(): void
    {
        $this->assertTrue(extension_loaded('mongodb'), "Extension mongodb non chargée");
    }
}
