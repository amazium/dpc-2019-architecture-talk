<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\Kernel\UI\Web\Form;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigZendFormExtension extends AbstractExtension
{
    public function getName()
    {
        return static::class;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('form', new \Zend\Form\View\Helper\Form()),
            new TwigFunction('formButton', new \Zend\Form\View\Helper\FormButton()),
            new TwigFunction('formCaptcha', new \Zend\Form\View\Helper\FormCaptcha()),
            new TwigFunction('formCheckbox', new \Zend\Form\View\Helper\FormCheckbox()),
            new TwigFunction('formCollection', new \Zend\Form\View\Helper\FormCollection()),
            new TwigFunction('formColor', new \Zend\Form\View\Helper\FormColor()),
            new TwigFunction('formDate', new \Zend\Form\View\Helper\FormDate()),
            new TwigFunction('formDateSelect', new \Zend\Form\View\Helper\FormDateSelect()),
            new TwigFunction('formDateTime', new \Zend\Form\View\Helper\FormDateTime()),
            new TwigFunction('formDateTimeLocal', new \Zend\Form\View\Helper\FormDateTimeLocal()),
            new TwigFunction('formDateTimeSelect', new \Zend\Form\View\Helper\FormDateTimeSelect()),
            new TwigFunction('formElement', new \Zend\Form\View\Helper\FormElement()),
            new TwigFunction('formElementErrors', new \Zend\Form\View\Helper\FormElementErrors()),
            new TwigFunction('formEmail', new \Zend\Form\View\Helper\FormEmail()),
            new TwigFunction('formFile', new \Zend\Form\View\Helper\FormFile()),
            new TwigFunction('formHidden', new \Zend\Form\View\Helper\FormHidden()),
            new TwigFunction('formImage', new \Zend\Form\View\Helper\FormImage()),
            new TwigFunction('formInput', new \Zend\Form\View\Helper\FormInput()),
            new TwigFunction('formLabel', new \Zend\Form\View\Helper\FormLabel()),
            new TwigFunction('formMonth', new \Zend\Form\View\Helper\FormMonth()),
            new TwigFunction('formMonthSelect', new \Zend\Form\View\Helper\FormMonthSelect()),
            new TwigFunction('formMultiCheckbox', new \Zend\Form\View\Helper\FormMultiCheckbox()),
            new TwigFunction('formNumber', new \Zend\Form\View\Helper\FormNumber()),
            new TwigFunction('formPassword', new \Zend\Form\View\Helper\FormPassword()),
            new TwigFunction('formRadio', new \Zend\Form\View\Helper\FormRadio()),
            new TwigFunction('formRange', new \Zend\Form\View\Helper\FormRange()),
            new TwigFunction('formReset', new \Zend\Form\View\Helper\FormReset()),
            new TwigFunction('formRow', new \Zend\Form\View\Helper\FormRow()),
            new TwigFunction('formSearch', new \Zend\Form\View\Helper\FormSearch()),
            new TwigFunction('formSelect', new \Zend\Form\View\Helper\FormSelect()),
            new TwigFunction('formSubmit', new \Zend\Form\View\Helper\FormSubmit()),
            new TwigFunction('formTel', new \Zend\Form\View\Helper\FormTel()),
            new TwigFunction('formText', new \Zend\Form\View\Helper\FormText()),
            new TwigFunction('formTextarea', new \Zend\Form\View\Helper\FormTextarea()),
            new TwigFunction('formTime', new \Zend\Form\View\Helper\FormTime()),
            new TwigFunction('formUrl', new \Zend\Form\View\Helper\FormUrl()),
            new TwigFunction('formWeek', new \Zend\Form\View\Helper\FormWeek()),
        ];
    }
}
