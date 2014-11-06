<?php
/**
 * Example
 *
 * @author Richard Knop
 */
class Example extends Zend_Form
{
    private $elementDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element')),
        'Label',
        array(array('row' => 'HtmlTag'), array('tag' => 'li')),
    );

    private $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'button')),
        array(array('row' => 'HtmlTag'), array('tag' => 'li')),
    );

    private $checkboxDecorators = array(
        'Label',
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'checkbox')),
        array(array('row' => 'HtmlTag'), array('tag' => 'li')),
    );

    private $radioDecorators = array(
        'Label',
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'radio')),
        array(array('row' => 'HtmlTag'), array('tag' => 'li')),
    );

    private $captchaDecorators = array(
        array('Label', array('tag' => 'div')),
        array(array('row' => 'HtmlTag'), array('tag' => 'li'))
    );

    private $fileDecorators = array(
        'File',
        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element')),
        'Label',
        array(array('row' => 'HtmlTag'), array('tag' => 'li')),
    );

    public function init()
    {
        $this->setMethod('post');

        $text = new Zend_Form_Element_Text('name', array(
            'decorators' => $this->elementDecorators,
            'label' => 'Text',
            'required' => true,
            'filters' => array(
                'StringTrim'
            ),
            'validators' => array(
                array('StringLength', false, array(3, 100))
            ),
            'class' => 'input-text'
        ));

        $email = new Zend_Form_Element_Text('email', array(
            'decorators' => $this->elementDecorators,
            'label' => 'Your email',
            'required' => true,
            'filters' => array(
                'StringTrim'
            ),
            'validators' => array(
                'EmailAddress'
            ),
            'class' => 'input-text'
        ));

        $textarea = new Zend_Form_Element_Textarea('textarea', array(
            'decorators' => $this->elementDecorators,
            'label' => 'Textarea',
            'rows' => 10,
            'cols' => 50,
            'required' => true,
            'filters' => array(
                'StringTrim'
            ),
            'validators' => array(
                array('StringLength', false, array(20, 1500))
            )
        ));

        $select = new Zend_Form_Element_Select('select', array(
            'decorators' => $this->elementDecorators,
            'label' => 'Select',
            'required' => true,
            'multiOptions' => array(
                'option1' => 'option1',
                'option2' => 'option2',
            )
        ));

        $checkbox = new Zend_Form_Element_Checkbox('checkbox', array(
            'decorators' => $this->checkboxDecorators,
            'label' => 'Checkbox',
            'required' => true,
            'class' => 'input-checkbox'
        ));

        $radio = new Zend_Form_Element_Radio('radio', array(
            'decorators' => $this->radioDecorators,
            'label' => 'Radio',
            'required' => true,
            'class' => 'input-radio',
            'multiOptions' => array(
                'option1' => 'option1',
                'option2' => 'option2',
            )
        ));

        $file = new Zend_Form_Element_File('file', array(
            'decorators' => $this->fileDecorators,
            'label' => 'File',
            'required' => true,
            'MaxFileSize' => 51200,
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 51200),
                array('IsImage', false, 'gif,jpeg'),
                array('ImageSize', false, array('minwidth' => 200,
                                                'minheight' => 200,
                                                'maxwidth' => 400,
                                                'maxheight' => 400))
            ),
            'class' => 'input-file'
        ));

        $captcha = new Zend_Form_Element_Captcha('captcha', array(
            'decorators' => $this->captchaDecorators,
            'label' => 'Are you a human?',
            'helper' => null,
            'captcha' => array(
                'captcha' => 'Figlet',
                'wordLen' => 6,
            ),
            'class' => 'input-text'
        ));

        $submit = new Zend_Form_Element_Submit('submit', array(
            'decorators' => $this->buttonDecorators,
            'label' => 'Submit',
            'class' => 'input-submit'
        ));

        $this->addElements(array(
            $text,
            $email,
            $textarea,
            $select,
            $checkbox,
            $radio,
            $file,
            $captcha,
            $submit
        ));
    }

    public function loadDefaultDecorators()
    {
        $this->setDecorators(array(
            'FormErrors',
            'FormElements',
            array('HtmlTag', array('tag' => 'ol')),
            'Form'
        ));
    }
}