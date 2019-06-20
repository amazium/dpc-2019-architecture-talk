<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\Kernel\UI\Web\Form;

use Zend\Form\Factory as FormFactory;
use Zend\Form\Form as ZendForm;
use Zend\Hydrator\ArraySerializableHydrator;

/**
 * Class Form
 * @package Amazium\Kernel\UI\Web\Form
 */
abstract class Form extends ZendForm
{
    /**
     * @return string
     */
    abstract public static function name(): string;

    /**
     * @return array
     */
    abstract public static function formConfig(): array;

    /**
     * Form constructor.
     * @param null $name
     * @param array $options
     */
    private function __construct()
    {
    }

    /**
     * @param string $action
     * @param string $method
     * @return ZendForm
     */
    public static function create(
        string $action,
        string $method = 'POST'
    ): ZendForm {
        $formConfig = static::formConfig();
        if (empty($formConfig['hydrator'])) {
            $formConfig['hydrator'] = ArraySerializableHydrator::class;
        }
        $formConfig['name'] = static::name();
        $formConfig['attributes']['action'] = $action;
        $formConfig['attributes']['id'] = static::name();
        $formConfig['attributes']['method'] = strtolower(trim($method)) === 'get' ? 'get' : 'post';
        return (new FormFactory())->createForm($formConfig);
    }
}
