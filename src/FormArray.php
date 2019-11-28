<?php


namespace MeraxForms;


class FormArray
{
    private $forms = [];


    /**
     * @param String $key
     * @param Form   $formObject
     *
     * @return $this
     */
    public function push(string $key, Form $formObject): self
    {
        $this->forms[$key] = $formObject;

        return $this;
    }

    public function getALl(): array
    {
        $result = [];
        foreach ($this->forms as $index => $form) {
            $result[$index] = $form->build();
        }

        return [
            'forms' => $result
        ];
    }

}
