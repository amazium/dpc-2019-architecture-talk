<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Address;

use Amazium\Kernel\UI\Web\Form\Form;
use Amazium\SampleApp\Domain\ValueObject\AddressState;

use Amazium\Kernel\Domain\ValueObject\Text\Country;
use Amazium\SampleApp\Domain\ValueObject\AddressType;
use Zend\Form\Element\Hidden as HiddenElement;
use Zend\Form\Element\Select as SelectElement;
use Zend\Form\Element\Submit as SubmitButton;
use Zend\Form\Element\Text as TextElement;
use Zend\Validator\Uuid as UuidValidator;
use Zend\Validator\InArray as InArrayValidator;

class AddressOverviewFilter extends Form
{
    /**
     * @return string
     */
    public static function name(): string
    {
        return 'frm_address_overview_search';
    }

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
        static::addIdentityIdElement($config);
        static::addAddressTypeElement($config);
        static::addStateElement($config);
        static::addZipCodeElement($config);
        static::addCountryElement($config);
        static::addStateElement($config);
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
    protected static function addIdentityIdElement(array &$config)
    {
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
                    'value_options' => [ '' => '' ] + AddressType::$addressTypes,
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'address_type',
            'required' => false,
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
    protected static function addCountryElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'country',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'Country',
                    'value_options' => [ '' => '' ] + Country::$countries,
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
    protected static function addStateElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'state',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'State',
                    'value_options' => [ '' => '' ] + AddressState::$states,
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'state',
            'required' => false,
            'validators' => [
                [
                    'name' => InArrayValidator::class,
                    'options' => [
                        'haystack' => AddressState::possibleValues(),
                    ]
                ],
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
                    'value' => 'Search address',
                    'class' => 'btn btn-primary',
                ],
            ]
        ];
    }
}
