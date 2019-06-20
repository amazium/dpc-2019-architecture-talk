<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Phone;

use Amazium\Kernel\UI\Web\Form\Form;
use Amazium\SampleApp\Domain\ValueObject\PhoneType;
use Zend\Form\Element\Hidden as HiddenElement;
use Zend\Form\Element\Select as SelectElement;
use Zend\Form\Element\Submit as SubmitButton;
use Zend\Form\Element\Text as TextElement;
use Zend\Validator\Uuid as UuidValidator;
use Zend\Validator\InArray as InArrayValidator;

abstract class AbstractPhoneForm extends Form
{
    /**
     * @var bool
     */
    protected static $hasPhoneId = false;

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
        static::addPhoneIdElement($config);
        static::addIdentityIdElement($config);
        static::addProviderElement($config);
        static::addPhoneNumberElement($config);
        static::addPinCodeElement($config);
        static::addPukCodeElement($config);
        static::addPuk2CodeElement($config);
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
    protected static function addPhoneIdElement(array &$config)
    {
        if (static::$hasPhoneId) {
            $config['elements'][] = [
                'spec' => [
                    'name' => 'phone_id',
                    'type' => HiddenElement::class,
                ]
            ];
            $config['input_filter'][] = [
                'name' => 'phone_id',
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
    protected static function addStateElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'state',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'State',
                    'value_options' => PhoneState::$states,
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
                        'haystack' => PhoneState::possibleValues(),
                    ]
                ],
            ],
        ];
    }

    /**
     * @param array $config
     */
    protected static function addProviderElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'provider',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Provider',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addPhoneNumberElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'phone_number',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Phone Number',
                ],
            ],
        ];
    }

    /**
     * @param array $config
     */
    protected static function addPinCodeElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'pin_code',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'PIN Code',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addPukCodeElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'puk_code',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'PUK Code',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addPuk2CodeElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'puk2_code',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'PUK2 Code',
                ],
            ]
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
