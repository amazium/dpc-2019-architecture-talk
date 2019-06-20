<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Identity;

use Amazium\Kernel\Domain\ValueObject\Text\Country;
use Amazium\Kernel\Domain\ValueObject\Text\Language;
use Amazium\Kernel\UI\Web\Form\Form;
use Zend\Form\Element\Date as DateElement;
use Zend\Form\Element\Hidden as HiddenElement;
use Zend\Form\Element\Select as SelectElement;
use Zend\Form\Element\Submit as SubmitButton;
use Zend\Form\Element\Text as TextElement;
use Zend\Validator\Uuid as UuidValidator;
use Zend\Validator\Date as DateValidator;
use Zend\Validator\InArray as InArrayValidator;

abstract class AbstractIdentityForm extends Form
{
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
        static::addIdentityIdElement($config);
        static::addFirstNameElement($config);
        static::addMiddleNameElement($config);
        static::addLastNameElement($config);
        static::addBirthDateElement($config);
        static::addBirthPlaceElement($config);
        static::addBirthCountryElement($config);
        static::addNationalityElement($config);
        static::addLanguageElement($config);
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
        if (static::$hasIdentityId) {
            $config['elements'][] = [
                'spec' => [
                    'name' => 'identity_id',
                    'type' => HiddenElement::class,
                ]
            ];
            $config['input_filter'][] = [
                'name' => 'identity_id',
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
    protected static function addFirstNameElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'first_name',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'First Name',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addMiddleNameElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'middle_name',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Middle Name',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addLastNameElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'last_name',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Last Name',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addBirthPlaceElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'birth_place',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Birth Place',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addBirthDateElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'birth_date',
                'type' => DateElement::class,
                'options' => [
                    'label' => 'Birth Date',
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'birth_date',
            'required' => false,
            'validators' => [
                [ 'name' => DateValidator::class ],
            ],
        ];
    }

    /**
     * @param array $config
     */
    protected static function addBirthCountryElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'birth_country',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'Country',
                    'value_options' => Country::$countries,
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'birth_country',
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
    protected static function addNationalityElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'nationality',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'Nationality',
                    'value_options' => Country::$countries,
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'nationality',
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
    protected static function addLanguageElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'language',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'Language',
                    'value_options' => Language::$languages,
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'language',
            'required' => false,
            'validators' => [
                [
                    'name' => InArrayValidator::class,
                    'options' => [
                        'haystack' => Language::possibleValues(),
                    ],
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
                    'value' => 'Save address',
                    'class' => 'btn btn-primary',
                ],
            ]
        ];
    }
}
