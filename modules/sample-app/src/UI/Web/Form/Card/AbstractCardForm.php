<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Card;

use Amazium\Kernel\UI\Web\Form\Form;
use Amazium\SampleApp\Domain\ValueObject\CardType;
use Zend\Form\Element\Date as DateElement;
use Zend\Form\Element\Hidden as HiddenElement;
use Zend\Form\Element\Select as SelectElement;
use Zend\Form\Element\Submit as SubmitButton;
use Zend\Form\Element\Text as TextElement;
use Zend\Validator\InArray as InArrayValidator;
use Zend\Validator\Uuid as UuidValidator;

abstract class AbstractCardForm extends Form
{
    /**
     * @var bool
     */
    protected static $hasCardId = false;

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
        static::addCardIdElement($config);
        static::addIdentityIdElement($config);
        static::addIssuerElement($config);
        static::addCardTypeElement($config);
        static::addCardNumberElement($config);
        static::addNameOnCardElement($config);
        static::addValidFromElement($config);
        static::addValidThruElement($config);
        static::addCvvCodeElement($config);
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
    protected static function addCardIdElement(array &$config)
    {
        if (static::$hasCardId) {
            $config['elements'][] = [
                'spec' => [
                    'name' => 'card_id',
                    'type' => HiddenElement::class,
                ]
            ];
            $config['input_filter'][] = [
                'name' => 'card_id',
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
    protected static function addIssuerElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'issuer',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'Issuer',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addCardTypeElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'card_type',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'State',
                    'value_options' => CardType::$types,
                ],
            ]
        ];
        $config['input_filter'][] = [
            'name' => 'card_type',
            'required' => false,
            'validators' => [
                [
                    'name' => InArrayValidator::class,
                    'options' => [
                        'haystack' => CardType::possibleValues(),
                    ]
                ],
            ],
        ];
    }

    /**
     * @param array $config
     */
    protected static function addCardNumberElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'card_number',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'CardNumber',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addNameOnCardElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'name_on_card',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Name on Card',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addValidFromElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'valid_from',
                'type' => DateElement::class,
                'options' => [
                    'label' => 'Valid From',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addValidThruElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'valid_thru',
                'type' => DateElement::class,
                'options' => [
                    'label' => 'Valid Thru',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addCvvCodeElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'cvv_code',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'CVV Code',
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
