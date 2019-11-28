<?php


namespace MeraxForms;


use MeraxForms\Components\Component;
use MeraxForms\Layouts\Layout;
use Illuminate\Support\Facades\Auth;

abstract class Form implements Init
{
    private $title = '';
    private $description = '';
    private $components = [];
    private $componentNames = [];
    private $data;
    private $params = [];
    private $rules = [];
    private $layout;

    /**
     * Form constructor
     */
    public function __construct()
    {
        $module = request()->segments()[2];
        $title = "modules.{$module}.title";
        $trans = __($title);
        $this->setTitle($title === $trans ? '' : $trans);
        $description = "modules.{$module}.description";
        $trans = __($description);
        $this->setDescription($description === $trans ? '' : $trans);
        $this->setParams('created_at', time());
        $this->init();
    }

    /**
     * @param Layout $layout
     *
     * @return $this
     */
    public function setLayout(Layout $layout): self
    {
        $this->layout = $layout;
        $this->layout->setFields($this->componentNames);

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function addComponents(Component ...$components): self
    {
        foreach ($components as $component) {
            $this->components[$component->getName()] = $component;
            $this->componentNames[] = $component->getName();
        }

        return $this;
    }

    /**
     * @param string $componentName
     *
     * @return Component
     */
    public function getComponent(string $componentName): Component
    {
        return $this->components[$componentName];
    }

    public function hasComponent(string $componentName) : bool
    {
        return isset($this->components[$componentName]);
    }

    public function fill($data): self
    {
        $this->data = $data;

        return $this;
    }

    public function build(): array
    {
        $this->prepareFields();
        $formObject = [
            'schema' => [
                'title'       => $this->getTitle(),
                'description' => $this->getDescription(),
                'fields'      => $this->getComponents(),
                'params'      => $this->getParams()
            ]
        ];

        $dataObject = $this->getData();

        if ($dataObject) {
            $formObject['dataObject'] = $dataObject;
        }

        if ($this->layout !== null) {
            $formObject['schema']['layout'] = $this->layout->get($this->componentNames);
        }

        return $formObject;
    }

    private function prepareFields(): void
    {
        $result = [];
        foreach ($this->components as $componentName => $component) {
            $result[$componentName] = $component->toArray();
        }
        $this->components = $result;
    }

    /**
     * @return array
     */
    public function getComponents(): array
    {
        return $this->components;
    }

    public function getValidateRules(): array
    {
        $toReturn = [];
        foreach ($this->components as $componentName => $component) {
            if ($rules = $component->getRules()) {
                $toReturn[$componentName] = $rules;
            }
        }

        return $toReturn;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $key   = 'created_at' ?: 'guard'
     * @param mixed  $value = 'unsavedForm'
     *
     * @return $this
     */
    public function setParams(string $key, $value): self
    {
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return $this
     */
    public function applyPermissions(): self
    {
        $fields = Auth::user()->getFields();
        foreach ($this->components as $key => $value) {
            if (!in_array($key, $fields, true)) {
                unset($this->components[$key]);
            }

        }

        return $this;
    }

    public function setRules(array $rules)
    {
        $this->rules = $rules;
        return $this->applyRules();
    }

    public function setRulesFromRequest(string $request)
    {
        $this->setRules((new $request)->rules());
        return $this->applyRules();
    }

    public function applyRules()
    {
        foreach ($this->getRules() as $componentName => $rule) {
            $this->getComponent($componentName)->setRules($rule);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}
