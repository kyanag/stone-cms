<?php


namespace App\Admin\Supports;


use App\Admin\Exceptions\AdminException;

class ResourceManager implements \ArrayAccess
{

    protected $metas = [];

    /**
     * @param $id
     * @param $model
     * @return ResourceMeta
     */
    public function add($id, $model, $name = null)
    {
        $resource = new ResourceMeta($id, $model, $id ?: $name);
        return $this->addResourceMeta($resource);
    }

    /**
     * @param ResourceMeta $resource_meta
     * @return ResourceMeta
     */
    public function addResourceMeta(ResourceMeta $resource_meta)
    {
        $id = $resource_meta->getId();
        $this->metas[$id] = $resource_meta;
        $this->metas[$resource_meta->getModel()] = $resource_meta;

        return $resource_meta;
    }

    public function getRoutes()
    {
        return collect($this->metas)->map(function(ResourceMeta $meta){
            return $meta->toRoute();
        });
    }

    public function getResourceMeta($id_or_model)
    {
        return $this->metas[$id_or_model];
    }

    public function getResourceMetas()
    {
        return $this->metas;
    }

    public function offsetExists($offset)
    {
        return isset($this->metas[$offset]);
    }

    public function offsetGet($offset)
    {
        if(isset($this->metas[$offset])){
            return $this->metas[$offset];
        }else{
            throw new AdminException(AdminException::RESOURCE_NOT_FOUND);
        }
    }

    public function offsetSet($offset, $value)
    {
        //pass
    }

    public function offsetUnset($offset)
    {
        //pass
    }
}
