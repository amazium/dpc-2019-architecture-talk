<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Identity;

use Amazium\Kernel\UI\Web\Form\Form;
use Amazium\SampleApp\Domain\ValueObject\IdentityState;
use Zend\Form\Element\Select as SelectElement;
use Zend\Form\Element\Submit as SubmitButton;
use Zend\Form\Element\Text as TextElement;
use Zend\Validator\InArray as InArrayValidator;

class IdentityOverviewFilter extends Form
{
    /**
     * @return string
     */
    public static function name(): string
    {
        return 'frm_identity_overview_search';
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
        static::addStateElement($config);
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
    protected static function addStateElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'state',
                'type' => SelectElement::class,
                'options' => [
                    'label' => 'State',
                    'value_options' => [ '' => '' ] + IdentityState::$states,
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
                        'haystack' => IdentityState::possibleValues(),
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
    protected static function addIdentityNumberElement(array &$config)
    {
        $config['elements'][] = [
            'spec' => [
                'name' => 'identity_number',
                'type' => TextElement::class,
                'options' => [
                    'label' => 'Identity Number',
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
