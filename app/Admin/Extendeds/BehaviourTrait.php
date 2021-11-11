<?php


namespace App\Admin\Extendeds;


use App\Admin\Exceptions\BehaviourNotFoundException;

/**
 * Notice: 行为和事件，个人理解为行为是同步，事件是异步
 *
 * Trait BehaviourTrait
 * @package App\Admin\Extendeds
 */
trait BehaviourTrait
{

    protected $behaviours = [];


    public function onBehaviour($name, $callable)
    {
        $this->behaviours[$name] = $callable;
    }

    /**
     * @param $name
     * @param mixed ...$args
     * @return mixed
     * @throws BehaviourNotFoundException
     */
    public function triggerBehaviour($name, ...$args)
    {
        if(isset($this->behaviours[$name])){
            return call_user_func_array($this->behaviours[$name], $args);
        }
        throw new BehaviourNotFoundException($this, $name);
    }

    public function hasBehaviour($name)
    {
        return isset($this->behaviours[$name]);
    }

}