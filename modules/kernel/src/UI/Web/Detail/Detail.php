<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-04}
 */

namespace Amazium\Kernel\UI\Web\Detail;

abstract class Detail
{

    /**
     * @var array
     */
    private $items;

    /**
     * @var array
     */
    private $actions;

    /**
     * Overview constructor.
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->init($data);
    }

    /**
     * @param array $data
     * @return static
     */
    public static function create(array $data)
    {
        return new static($data);
    }

    /**
     * @return array
     */
    public function actions(): array
    {
        return empty($this->actions) ? [] : $this->actions;
    }

    /**
     * @return array
     */
    public function items(): array
    {
        return empty($this->items) ? [] : $this->items;
    }

    protected function init(array $data)
    {
        $config = $this->config();

        foreach ($config['items'] as $item) {
            $lineData = [
                'label' => null,
                'icon' => null,
                'raw_value' => null,
                'value' => null,
                'action' => null,
                'action_params' => [],
            ];

            $label = $item['label'] ?? null;
            $key = $item['key'] ?? null;
            $value = $item['value'] ?? null;

            if (!empty($label)) {
                if (is_callable($label)) {
                    $lineData['label'] = call_user_func_array($label, [ $data ]);
                } else {
                    $lineData['label'] = $label;
                }
            }

            if (!empty($key)) {
                $lineData['raw_value'] = $data[$key] ?? null;
            }

            if (!empty($value)) {
                if (is_callable($value)) {
                    $value = call_user_func_array($value, [ $data ]);
                }
                $lineData['value'] = $value;
            } else {
                $lineData['value'] = $lineData['raw_value'] ?? null;
            }

            $action = $item['action'] ?? null;
            if ($action) {
                $lineData['action'] = $action;
                $actionParams = $item['action_params'] ?? [];
                foreach ($actionParams as $paramKey => $paramValue) {
                    if (is_callable($paramValue)) {
                        $paramValue = call_user_func_array($paramValue, [ $data ]);
                    }
                    $lineData['action_params'][$paramKey] = $paramValue;
                }
            }

            $icons = $item['icons'] ?? null;
            if (!empty($icons) && !empty($lineData['raw_value']) && isset($icons[$lineData['raw_value']])) {
                $lineData['icon'] = $icons[$lineData['raw_value']];
            }
            $this->items[] = $lineData;
        }

        foreach ($config['actions'] as $action) {
            $actionData = [
                'action' => null,
                'action_params' => [],
                'icon' => null,
                'class' => 'btn-secondary',
                'title' => null,
            ];
            $condition = $action['condition'] ?? null;
            if (!is_null($condition)) {
                if (is_callable($condition)) {
                    $shouldIncludeAction = call_user_func_array($condition, [$data]);
                } else {
                    $shouldIncludeAction = boolval($condition);
                }
                if (!$shouldIncludeAction) {
                    continue;
                }
            }

            if (isset($action['label'])) {
                if (is_callable($action['label'])) {
                    $actionData['title'] = call_user_func_array($action['label'], [ $data ]);
                } else {
                    $actionData['title'] = $action['label'];
                }
            }
            if (isset($action['class'])) {
                if (is_callable($action['class'])) {
                    $actionData['class'] = call_user_func_array($action['class'], [ $data ]);
                } else {
                    $actionData['class'] = $action['class'];
                }
            } else {
                $actionData['class'] = 'btn-secondary';
            }
            if (isset($action['icon'])) {
                if (is_callable($action['icon'])) {
                    $actionData['icon'] = call_user_func_array($action['icon'], [ $data ]);
                } else {
                    $actionData['icon'] = $action['icon'];
                }
            }
            if (isset($action['action'])) {
                if (is_callable($action['action'])) {
                    $actionData['action'] = call_user_func_array($action['action'], [ $data ]);
                } else {
                    $actionData['action'] = $action['action'];
                }
                $actionData['action_params'] = [];
                $actionParams = $action['action_params'] ?? [];
                foreach ($actionParams as $paramKey => $paramValue) {
                    if (is_callable($paramValue)) {
                        $paramValue = call_user_func_array($paramValue, [ $data ]);
                    }
                    $actionData['action_params'][$paramKey] = $paramValue;
                }
            }

            $this->actions[] = $actionData;
        }
    }

    /**
     * @return array
     */
    abstract public function config(): array;
}
