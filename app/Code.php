<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
	protected $fillable = [
		'code_key',
		'code_value', // default 0
		'length', // 00000 defautl 5
		'glue', // default (-)
		'increment', // default 1
	];

	// example A-0000000
	//

	// mutator
	// public function setCodeValueAttribute($code_value)
	// {
	// 	// $value = $this->code_value ?? 0;
	// 	$this->attributes['code_value'] = $code_value + $this->increment;
	// }

	public function generate($isSaved = true)
	{
		$length = ($this->length - 1) >= 0 ? ($this->length - 1) : 0;
		$pre = str_repeat('0', $length);
		$this->attributes['code_value'] += $this->increment;
		$code = substr("{$pre}{$this->code_value}", -$this->length, $this->length);

		if($isSaved) {
			$this->save();
		}

		return "{$this->code_key}{$this->glue}{$code}";
	}

	public function template()
	{
		return $this->generate(false);
	}
}
