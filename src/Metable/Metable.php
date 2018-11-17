<?php

namespace NguyenTranChung\Metable\Metable;

interface Metable
{
    public function metas();
    public function updateOrCreateMetas();
    public function deleteMetas();
    public function deleteAllMetas();
    public function setMeta($key, $value = null, $delete = false);
    public function unsetMeta($keys);
    public function setMetaSingle($key, $value = null, $delete = false);
    public function setMetaArray($metas);
    public function getMeta($key = null);
    public function getMetaValue($key);
    public function getFirstMeta();
}
