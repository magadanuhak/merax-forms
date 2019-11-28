<?php


namespace MeraxForms\Layouts;


class FieldGroups extends Layout
{
    protected $type = 'fieldGroups';
    private $groupMode = null;
    protected $content = [];
    private $groupedFields = [];
    private $defaultGroupLabel = '';

    public function __construct($mode, $defaultGroupLabel = '')
    {
        $this->groupMode = $mode;
        $this->defaultGroupLabel = $defaultGroupLabel;
    }

    public function makeGroup($name, $label, $fields): void
    {
        foreach ($fields as $field) {
            $this->groupedFields[] = $field;
        }
        $this->content[$name] = [
            'label'  => $label,
            'fields' => $fields
        ];
    }

    public function get(): array
    {
        if (!empty($this->content)) {
            $this->makeGroup('ungrouped', $this->defaultGroupLabel, array_values(array_diff($this->allFields, $this->groupedFields)));
        }

        return [
            'type'    => $this->type,
            'mode'    => $this->groupMode,
            'content' => $this->content
        ];
    }
}
