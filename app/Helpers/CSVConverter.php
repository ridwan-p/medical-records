<?php
namespace App\Helpers;

/**
 * csv export
 */
class CSVConverter
{

	protected $filename = '';

	protected $header = [];

	protected $data = [];

	/**
	 * @param string filename
	 */
	public function __construct($filename)
	{
		$this->setFilename($filename);
	}

	public function setFilename($filename)
	{
		$this->filename = $filename;
	}

	public function setHeader(array $header)
	{
		$this->header = $header;
	}

	public function getHeader()
	{
		return $this->header;
	}

	public function getFilename()
	{
		return $this->filename;
	}

	public function getData()
	{
		return $this->data;
	}

	public function execute()
	{
		$csv = $this->calculate();

		$this->setData($csv);

		return $this;
	}

	protected function calculate()
	{
		$csv = array_map('str_getcsv', file($this->getFilename()));

	    array_walk($csv, function(&$a) use ($csv) {
	      $a = array_combine($csv[0], $a);
	    });

	    $this->setHeader($csv[0]);

	    array_shift($csv); # remove column header

	    return $csv;
	}

	protected function setData( $data )
	{
		$this->data = $data;
	}
}