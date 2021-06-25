<?php


namespace App\Admin\Exceptions;


use Throwable;

class BehaviourNotFoundException extends \Exception
{

    protected $targetObject;

    protected $behaviourName;


    public function __construct($targetObject, $behaviourName, $code = 0, Throwable $previous = null)
    {
        $this->targetObject = $targetObject;
        $this->behaviourName = $behaviourName;

        $targetClass = get_class($targetObject);
        $message = "对象 {$targetClass} 没有注册 [{$behaviourName}] 行为!";
        parent::__construct($message, $code, $previous);
    }


    public function getTargetObject(){
        return $this->targetObject;
    }

    public function getBehaviourName(){
        return $this->behaviourName;
    }
}