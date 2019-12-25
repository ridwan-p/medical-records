<?php
namespace App\Repositories;

use App\Code as Model;

/**
 * code
 */
class Code
{
	// mendapatkan code pertama berdasarkan value jika tidak ada buat
	// updata increment value
	//
	public static function generate($code_key, $isSaved = true)
	{
		$code = self::create($code_key);
		
		return $code->generate($isSaved);
	}

	public static function template($code_key)
	{
		$code = self::create($code_key);

		return $code->template();
	}

	public static function create($code_key)
	{
		return Model::firstOrCreate(
			['code_key' => $code_key ],
			['code_value' => 0, 'length' => 5, 'glue' => '-', 'increment' => 1]
		);
	}
}