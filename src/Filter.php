<?php


namespace MeraxForms\Prototype;


use MeraxForms\Init;
use MeraxForms\Components\Component;

abstract class Filter implements Init
{
    private $title;
    private $description;
    private $components = [];
    private $data = [];
    private $params = [];

    /**
     * Filter constructor
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
        }

        return $this;
    }

    /**
     * @param string $componentName
     * @return Component
     */
    public function getComponent(string $componentName): Component
    {
        return $this->components[$componentName];
    }

    public function fill(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function build(): array
    {
        $this->prepareFields();

        return [
            'schema' => [
                'title'       => $this->getTitle(),
                'description' => $this->getDescription(),
                'fields'      => $this->getComponents(),
                'dataObject'  => $this->getData(),
                'params'      => $this->getParams()
            ],

        ];
    }

    private function prepareFields(): void
    {
        array_map(static function (&$value) {
            $value = $value->toArray();
        }, $this->components);
        $this->components = array_values($this->components);
    }

    /**
     * @return array
     */
    public function getComponents(): array
    {
        return $this->components;
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
     * @param mixed  $value = 'unsavedFilter'
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
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
