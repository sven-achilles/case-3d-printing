<?php
namespace App\Tests\Service;

use App\Service\DesignUploader;
use PHPUnit\Framework\TestCase;

class DesignUploaderTest extends TestCase
{
    /**
     * @var string $extension
     *
     * @testWith ["stl"]
     *           ["obj"]
     *           ["exe"]
     *           ["xls"]
     */
    public function testUniqueFileNameGenerator( $extension )
    {
        $filename = DesignUploader::getUniqueFileName( $extension );

        $this->assertEquals( 32 + strlen( $extension ) + 1, strlen($filename) );
        $this->assertTrue( !preg_match('/[A-Z]+[a-z]+[0-9]+\.' . $extension . '/', $filename) );
    }
}