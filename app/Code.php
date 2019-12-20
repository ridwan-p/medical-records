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

	public function generate($isSaved = true)
	{
		$pre = str_repeat('0', ($this->length - 1));
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
