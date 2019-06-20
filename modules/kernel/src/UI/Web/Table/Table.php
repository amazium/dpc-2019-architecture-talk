<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-04}
 */

namespace Amazium\Kernel\UI\Web\Table;

abstract class Table
{
    /**
     * @var array
     */
    private $rows;

    /**
     * @var array
     */
    private $headers;

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
    public function headers(): array
    {
        return $this->headers ?? [];
    }

    /**
     * @return array
     */
    public function rows(): array
    {
        return $this->rows ?? [];
    }

    protected function init(array $data)
    {
        $config = $this->config();

        // process headers
        foreach ($config['columns'] as $column) {
            $header = $column['header'];
            $this->headers[] = $header;
        }

        foreach ($data as $set) {
            $row = [
                'columns' => [],
                'buttons' => [],
            ];
            $columnData = [];
            foreach ($config['columns'] as $column) {
                $key = $column['key'] ?? null;
                $value = $column['value'] ?? null;
                $cellData = [];
                $rawData = null;
                if (!empty($key)) {
                    $rawData = $cellData['raw'] = $set[$key] ?? null;
                }
                if (!empty($value)) {
                    if (is_callable($value)) {
                        $cellData['value'] = call_user_func_array($value, [ $set ]);
                    } else {
                        $cellData['value'] = $value;
                    }
                }
                $icons = $column['icons'] ?? null;
                if (!empty($icons) && !empty($rawData) && isset($icons[$rawData])) {
                    $cellData['icon'] = $icons[$rawData];
                }
                $action = $column['action'] ?? null;
                if (!empty($action)) {
                    if (is_callable($action)) {
                        $cellData['action'] = call_user_func_array($action, [ $set ]);
                    } else {
                        $cellData['action'] = $action;
                    }
                    $actionParams = $column['action_params'] ?? [];
                    $cellData['action_params'] = $cellData['action_get_params'] = [];
                    foreach ($actionParams as $paramKey => $paramValue) {
                        if (is_callable($paramValue)) {
                            $paramValue = call_user_func_array($paramValue, [ $set ]);
                        }
                        $cellData['action_params'][$paramKey] = $paramValue;
                    }
                    $actionGetParams = $column['action_get_params'] ?? [];
                    foreach ($actionGetParams as $paramKey => $paramValue) {
                        if (is_callable($paramValue)) {
                            $paramValue = call_user_func_array($paramValue, [ $set ]);
                        }
                        $cellData['action_get_params'][$paramKey] = $paramValue;
                    }
                }
                $class = $column['class'] ?? null;
                if (is_callable($class)) {
                    $cellData['class'] = call_user_func_array($class, [ $set ]);
                } else {
                    $cellData['class'] = $class;
                }
                if ($cellData['icon'] ?? false) {
                    $cellData['class'] = trim(($cellData['class'] ?? '') . ' text-center');
                }
                $columnData[] = $cellData;
            }
            $row['columns'] = $columnData;
            foreach ($config['buttons'] as $button) {
                $rowButton = [];
                $includeButton = true;
                if (isset($button['condition'])) {
                    if (is_callable($button['condition'])) {
                        $includeButton = call_user_func_array($button['condition'], [ $set ]);
                    } else {
                        $includeButton = boolval($button['condition']);
                    }
                }
                if (!$includeButton) {
                    continue;
                }
                if (isset($button['id'])) {
                    if (is_callable($button['id'])) {
                        $rowButton['id'] = call_user_func_array($button['id'], [ $set ]);
                    } else {
                        $rowButton['id'] = $button['id'];
                    }
                }
                if (isset($button['label'])) {
                    if (is_callable($button['label'])) {
                        $rowButton['label'] = call_user_func_array($button['label'], [ $set ]);
                    } else {
                        $rowButton['label'] = $button['label'];
                    }
                }
                if (isset($button['class'])) {
                    if (is_callable($button['class'])) {
                        $rowButton['class'] = call_user_func_array($button['class'], [ $set ]);
                    } else {
                        $rowButton['class'] = $button['class'];
                    }
                } else {
                    $rowButton['class'] = 'btn-secondary';
                }
                if (isset($button['icon'])) {
                    if (is_callable($button['icon'])) {
                        $rowButton['icon'] = call_user_func_array($button['icon'], [ $set ]);
                    } else {
                        $rowButton['icon'] = $button['icon'];
                    }
                }
                if (isset($button['action'])) {
                    if (is_callable($button['action'])) {
                        $rowButton['action'] = call_user_func_array($button['action'], [$set]);
                    } else {
                        $rowButton['action'] = $button['action'];
                    }
                    $rowButton['action_params'] = $rowButton['action_get_params'] = [];
                    $actionParams = $button['action_params'] ?? [];
                    foreach ($actionParams as $paramKey => $paramValue) {
                        if (is_callable($paramValue)) {
                            $paramValue = call_user_func_array($paramValue, [$set]);
                        }
                        $rowButton['action_params'][$paramKey] = $paramValue;
                    }

                    $actionGetParams = $button['action_get_params'] ?? [];
                    foreach ($actionGetParams as $paramKey => $paramValue) {
                        if (is_callable($paramValue)) {
                            $paramValue = call_user_func_array($paramValue, [ $set ]);
                        }
                        $rowButton['action_get_params'][$paramKey] = $paramValue;
                    }
                }
                $row['buttons'][] = $rowButton;
            }
            $this->rows[] = $row;
        }
    }

    /**
     * @return string
     */
    abstract public function id(): string;

    /**
     * @return array
     */
    abstract public function config(): array;
}
