<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\SampleApp\Domain\ValueObject;

use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\Domain\ValueObject\Enum;

class FileType extends Enum
{
    const TYPE_JPG = 'JPG';
    const TYPE_PNG = 'PNG';
    const TYPE_PDF = 'PDF';
    const TYPE_WORD = 'WORD';
    const TYPE_XLS = 'XLS';
    const TYPE_XLSX = 'XLSX';
    const TYPE_TIFF = 'TIFF';

    public static $types = [
        self::TYPE_JPG => 'JPEG Image',
        self::TYPE_PNG => 'PNG Image',
        self::TYPE_PDF => 'PDF',
        self::TYPE_WORD => 'WORD document',
        self::TYPE_XLS => 'Excel Document (xls)',
        self::TYPE_XLSX => 'Excel Document (xlss)',
        self::TYPE_TIFF => 'TIFF Image',
    ];

    /**
     * @return array
     */
    public static function possibleValues(): array
    {
        return array_keys(self::$types);
    }

    /**
     * @return |null
     */
    public static function defaultValue()
    {
        return null;
    }

    /**
     * @param $value
     * @return static
     * @throws \Exception
     */
    public static function fromValue($value)
    {
        switch (strtolower(trim(trim($value, '.'), ' '))) {
            case 'jpeg':
            case 'jpg':
                $value = self::TYPE_JPG;
                break;
            case 'png':
                $value = self::TYPE_PNG;
                break;
            case 'pdf':
                $value = self::TYPE_PDF;
                break;
            case 'doc':
            case 'docx':
            case 'word':
                $value = self::TYPE_WORD;
                break;
            case 'xls':
                $value = self::TYPE_XLS;
                break;
            case 'xlsx':
                $value = self::TYPE_XLSX;
                break;
            case 'tif':
            case 'tiff':
                $value = self::TYPE_TIFF;
                break;
            default:
                throw new LogicException(sprintf('Unsupported file extension: %s', var_export($value, true)));
                break;
        }
        return new static($value);
    }
}
