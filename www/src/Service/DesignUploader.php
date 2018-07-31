<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class DesignUploader
{
    /**
     * @var string
     */
    private $targetDirectory;

    /**
     * @param string $targetDirectory
     */
    public function __construct( $targetDirectory )
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param UploadedFile $design
     * @param null|string $extension
     * @return string
     */
    public function upload( UploadedFile $design, $extension = null )
    {
        if( is_null( $extension ) ) {
            $extension = $design->guessExtension();
        }

        $fileName = self::getUniqueFileName( $extension );

        $design->move(
            $this->targetDirectory,
            $fileName
        );

        return $fileName;
    }

    /**
     * @param string $extension
     * @return string
     */
    public static function getUniqueFileName( $extension = '' )
    {
        return md5( uniqid() ) . '.' . $extension;
    }
}