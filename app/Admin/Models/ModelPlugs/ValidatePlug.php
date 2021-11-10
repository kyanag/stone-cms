<?php


namespace App\Admin\Models\ModelPlugs;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Trait ValidatePlug
 * @package App\Admin\Models\ModelPlugs
 * @mixin Model
 */
trait ValidatePlug
{

    /**
     * 待校验的输入数据
     * @var array
     */
    protected $inputs = [];

    public function withInputs(array $inputs)
    {
        $this->inputs = $inputs;
        return $this;
    }

    /**
     * @return array
     */
    public function getInputs()
    {
        return $this->inputs ?: [];
    }

    public function getRules()
    {
        return [];
    }

    /**
     * 提交 inputs 到 模型的 attributes
     * @return self
     */
    public function commit(){
        $this->fill($this->makeValidator()->validate());
        return $this;
    }

    protected function makeValidator(){
        return Validator::make($this->inputs, $this->getRules());
    }
}
