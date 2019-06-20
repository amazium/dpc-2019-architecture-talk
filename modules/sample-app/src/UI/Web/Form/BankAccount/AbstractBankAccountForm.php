<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\BankAccount;

use Amazium\Kernel\UI\Web\Form\Form;
use Zend\Form\Element\Hidden as HiddenElement;
use Zend\Form\Element\Submit as SubmitButton;
use Zend\Form\Element\Text as TextElement;
use Zend\Validator\Uuid as UuidValidator;

abstract class AbstractBankAccountForm extends Form
{
    /**
     * @var bool
     */
    protected static $hasBankAccountId = false;

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
        static::addBankAccountIdElement($config);
        static::addIdentityIdElement($config);
        static::addAccountNumberElement($config);
        static::addNameOnAccountElement($config);
        static::addBankNameElement($config);
        static::addBankAddressLine1Element($config);
        static::addBankAddressLine2Element($config);
        static::addBankAddressLine3Element($config);
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
    protected static function addBankAccountIdElement(array &$config)
    {
        if (static::$hasBankAccountId) {
            $config['elements'][] = [
                'spec' => [
                    'name' => 'bank_account_id',
                    'type' => HiddenElement::class,
                ]
            ];
            $config['input_filter'][] = [
                'name' => 'bank_account_id',
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
    protected static function addAccountNumberElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'account_number',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Account Number',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addNameOnAccountElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'name_on_account',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Account Owner',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addBankNameElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'bank_name',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Bank Name',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addBankAddressLine1Element(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'bank_address_line_1',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Bank Address Line 1',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addBankAddressLine2Element(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'bank_address_line_2',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Bank Address Line 2',
                ],
            ]
        ];
    }

    /**
     * @param array $config
     */
    protected static function addBankAddressLine3Element(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'bank_address_line_3',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Bank Address Line 3',
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
