<?php
use Carbon\Carbon;

class ValidatorPlus extends Illuminate\Validation\Validator {


	/**
	 * Validate that an attribute is a date time. See DateTime
	 * for more details.
	 *
	 * @param  string $attribute
	 * @param  mixed  $value
	 * @param  array  $parameters
	 * @return boolean
	 */
	protected function validateDatetime($attribute, $value, $parameters)
	{
		try {
			Carbon::parse($value, Config::get('app.timezone'));
			return TRUE;
		}
		catch (\Exception $e) {
			return FALSE;
		}
	}

	/**
	 * Handle dynamic calls to class methods and add support for array value.
	 * Example: numeric_array
	 *
	 * @param  string $method
	 * @param  array  $parameters
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		$suffix = 'Array';
		$va_length = 'validateArray';
		if (ends_with($method, $suffix) && count($method) > $va_length) {
			$method = substr($method, 0, 0 - strlen($suffix));
			$values = $parameters[1];
			$success = TRUE;

			foreach ($values as $value) {
				$parameters[1] = $value;
				$success &= call_user_func_array(array($this, $method), $parameters);
			}

			return $success;
		}
		else {
			return parent::__call($method, $parameters);
		}
	}

	/**
	 * Override the default message getter to include array value validation
	 * message.
	 *
	 * @param  string $attribute
	 * @param  string $rule
	 * @return string
	 */
	protected function getMessage($attribute, $rule)
	{
		if (substr($rule, -6) === '_array') {
			$rule = substr($rule, 0, -6);
		}

		return parent::getMessage($attribute, $rule);
	}
}
