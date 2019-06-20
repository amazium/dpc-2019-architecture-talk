<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Address;

use Amazium\Kernel\Domain\ValueObject\Text\Country;
use Amazium\Kernel\UI\Web\Form\Form;
use Amazium\SampleApp\Domain\ValueObject\AddressType;
use Zend\Form\Element\Date as DateElement;
use Zend\Form\Element\Hidden as HiddenElement;
use Zend\Form\Element\Select as SelectElement;
use Zend\Form\Element\Submit as SubmitButton;
use Zend\Form\Element\Text as TextElement;
use Zend\Validator\Uuid as UuidValidator;
use Zend\Validator\Date as DateValidator;
use Zend\Validator\InArray as InArrayValidator;

abstract class AbstractAddressForm extends Form
{
    /**
     * @var bool
     */
    protected static $hasAddressId = false;

    /**
     * @var bool
     */
    protected static $hasIdentityId = false;

    /**
     * @return array
     */
    public static function formConfig(): array
    {
        $config = [
            'elements' => [
            ],
            'input_filter' => [
            ],
        ];
        static::addAddressIdElement($config);
        static::addIdentityIdElement($config);
        static::addAddressTypeElement($config);
        static::addBuildingElement($config);
        static::addStreetElement($config);
        static::addNumberElement($config);
        static::addBoxElement($config);
        static::addZipCodeElement($config);
        static::addCityElement($config);
        static::addRegionElement($config);
        static::addCountryElement($config);
        static::addActiveFromElement($config);
        static::addActiveUntilElement($config);
        static::addSubmitButton($config);
        foreach ($config['elements'] as &$element) {
            if (!isset($element['spec']['attributes']['id'])) {
                $element['spec']['attributes']['id'] = $element['spec']['name'];
            }
            if (!isset($element['spec']['attributes']['class'])) {
                $element['spec']['attributes']['class'] = 'form-control';
            }
        }
        unset($element);
        return $config;
    }

    /**
     * @param array $config
     */
    protected static function addAddressIdElement(array &$config)
    {
        if (static::$hasAddressId) {
            $config['elements'][] = [
                'spec' => [
                    'name' => 'address_id',
                    'type' => HiddenElement::class,
                ]
            ];
            $config['input_filter'][] = [
                'name' => 'address_id',
                'required' => true,
                'validators' => [
                    [ 'name' => UuidValidator::class ],
                ],
            ];
        }
    }

    /**
     * @param array $config
     */
    protected static function addIdentityIdElement(array &$config)
    {
        if (static::$hasIdentityId) {
            $config['elements'][] = [
                'spec' => [
                    'name' => 'identity_id',
                    'type' => HiddenElement::class,
                ]
            ];
            $config['input_filter'][] = [
                'name' => 'identity_id',
                'required' => false,
                'validators' => [
                    [ 'name' => UuidValidator::class ],
                ],
            ];
        }
    }

    /**
     * @param array $config
     */
    protected static function addAddressTypeElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'address_type',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'Address Type',
                    'value_options' => AddressType::$addressTypes,
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'address_type',
            'required' => true,
            'validators' => [
                [
                    'name' => InArrayValidator::class,
                    'options' => [
                        'haystack' => AddressType::possibleValues(),
                    ]
                ],
            ],
        ];
    }

    /**
     * @param array $config
     */
    protected static function addBuildingElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'building',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Building',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addStreetElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'street',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Street',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addNumberElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'number',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Number',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addBoxElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'box',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Box',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addZipCodeElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'zipcode',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Zip Code',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addCityElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'city',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'City',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addRegionElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'region',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Region',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addCountryElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'country',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'Country',
                    'value_options' => Country::$countries,
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'country',
            'required' => false,
            'validators' => [
                [
                    'name' => InArrayValidator::class,
                    'options' => [
                        'haystack' => Country::possibleValues(),
                    ],
                ],
            ],
        ];
    }

    /**
     * @param array $config
     */
    protected static function addActiveFromElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'active_from',
                'type' => DateElement::class,
                'options' => [
                    'label' => 'Active From',
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'active_from',
            'required' => false,
            'validators' => [
                [ 'name' => DateValidator::class ],
            ],
        ];
    }

    /**
     * @param array $config
     */
    protected static function addActiveUntilElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'active_until',
                'type' => DateElement::class,
                'options' => [
                    'label' => 'Active Until',
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'active_until',
            'required' => false,
            'validators' => [
                [ 'name' => DateValidator::class ],
            ],
        ];
    }

    /**
     * @param array $config
     */
    protected static function addSubmitButton(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'submit_button',
                'type' => SubmitButton::class,
                'attributes' => [
                    'value' => 'Save address',
                    'class' => 'btn btn-primary',
                ],
            ]
        ];
    }
}
