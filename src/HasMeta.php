<?php

namespace LeeMason\Metable;

trait HasMeta
{
    /**
     * Returns the foreign key for the meta model either by provided property or dynamically settings use the class name formatted through the snake_case function.
     *
     * @return string
     */
    private function getMetaForeignKey()
    {
        if (isset($this->metaForeignKey)) {
            return $this->metaForeignKey;
        }
        $class = snake_case(last(explode('\\', static::class)));

        return $class.'_id';
    }

    /**
     * Sets the meta relationship on the model.
     *
     * @return mixed
     */
    public function meta()
    {
        return $this->hasMany($this->metaModel, $this->getMetaForeignKey());
    }

    /**
     * Helper function to return 1 meta model if key is set, or returns the full results if not.
     *
     * @param bool|false $key
     * @return bool
     */
    public function getMeta($key = false, $model = false)
    {
        if ($key === false) {
            return $this->meta()->get();
        }
        if ($meta = $this->meta()->whereKey($key)->first()) {
            return ($model == false) ? $meta->value : $meta;
        }

        return false;
    }

    /**
     * Helper method to shorten the check if exists / create if not / associate / save methods of related meta.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function addMeta($key, $value)
    {
        $meta = call_user_func_array("{$this->metaModel}::firstOrNew", [['key' => $key, $this->getMetaForeignKey() => $this->getKey()]]);
        $meta->value = $value;

        return $this->meta()->save($meta);
    }

    /**
     * Helper method to update a related meta model. This calls addMeta behind the scenes.
     *
     * @uses addMeta
     * @param $key
     * @param $value
     * @return mixed
     */
    public function updateMeta($key, $value)
    {
        return $this->addMeta($key, $value);
    }

    /**
     * Helper method to delete related meta model.
     *
     * @param $key
     * @return bool
     */
    public function deleteMeta($key)
    {
        return (bool) $this->meta()->whereKey($key)->delete();
    }

    /**
     * Helper method which allows for mass creation/updates to related meta models by simply supplying a key,value array.
     *
     * @param array $meta
     */
    public function fillMeta(array $meta)
    {
        $metaModels = [];

        foreach ($meta as $key => $value) {
            $m = call_user_func_array("{$this->metaModel}::firstOrNew", [['key' => $key, $this->getMetaForeignKey() => $this->getKey()]]);
            $m->value = $value;
            $metaModels[] = $m;
        }

        $this->meta()->saveMany($metaModels);
    }
}
