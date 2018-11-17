<?php

namespace NguyenTranChung\Metable\Metable;

trait MetableTrait
{
    protected $deleteKeys = [];
    protected $metaDatas = [];

    /**
     * @var array
     */
    protected $dataTypes = ['boolean', 'integer', 'double', 'string', 'array', 'object'];

    public static function bootMetableTrait()
    {
        static::saved(function ($entity) {
            $entity->updateOrCreateMetas();
            $entity->deleteMetas();
        });

        static::deleting(function (Metable $entity) {
            $entity->deleteAllMetas();
        });
    }

    /**
     * Set the polymorphic relation.
     *
     * @return mixed
     */
    public function metas()
    {
        return $this->morphMany(config('metable.meta_model'), 'model');
    }

    public function updateOrCreateMetas()
    {
        if (count($this->metaDatas)) {
            foreach ($this->metaDatas as $value) {
                $this->metas()->updateOrCreate($value[0], $value[1]);
            }
        }
    }

    public function deleteMetas()
    {
        if (count($this->deleteKeys)) {
            $this->metas()->whereIn('key', $this->deleteKeys)->delete();
        }
    }

    public function deleteAllMetas()
    {
        $this->metas()->delete();
    }

    public function setMeta($key, $value = null, $delete = false)
    {
        $type = gettype($key);
        switch ($type) {
            case 'string':
                $this->setMetaSingle($key, $value, $delete);
                break;
            case 'array':
                $this->setMetaArray($key);
                break;
            default:
                # code...
                break;
        }
    }

    public function unsetMeta($keys)
    {
        $type = gettype($keys);
        switch ($type) {
            case 'string':
                $this->setMetaSingle($keys, null, true);
                break;
            case 'array':
                foreach ($keys as $key) {
                    $this->setMetaSingle($key, null, true);
                }
                break;
        }
    }

    public function setMetaSingle($key, $value = null, $delete = false)
    {
        if ($delete) {
            $this->deleteKeys[] = $key;
        } else {
            $this->metaDatas[] = [
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => gettype($value),
                ],
            ];
        }
    }

    public function setMetaArray($metas)
    {
        if (is_array($metas)) {
            foreach ($metas as $key => $value) {
                $this->setMeta($key, $value);
            }
        }
    }

    public function getMeta($key = null)
    {
        if (is_null($key)) {
            return $this->metas;
        }

        if (is_string($key)) {
            return $this->metas->firstWhere('key', $key);
        }

        if (is_array($key)) {
            return $this->metas->whereIn('key', $key);
        }
    }

    public function getMetaValue($key)
    {
        return $this->getMeta($key)->value;
    }

    public function getFirstMeta()
    {
        return $this->metas->first();
    }
}
