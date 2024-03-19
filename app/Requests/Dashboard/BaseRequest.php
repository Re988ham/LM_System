<?php


namespace App\Requests\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class BaseRequest
{
    protected $_request;

    private $status = true;

    private $errors = [];

    abstract public function rules(): array;

    /**
     * @throws Exception
     */
    public function __construct(Request $request = null)
    {
        if (!is_null($request)) {
            $this->_request = $request;
            $rules = $this->rules();
            $validator = Validator::make($this->_request->all(), $rules);

            if ($validator->fails()) {
                $this->status = false;
                $this->errors = $validator->errors()->all();
            }
        }
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function request()
    {
        return $this->_request;
    }
}
