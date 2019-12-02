<?php
namespace App\Utils;

trait MetadataChild {

	/**
	 * data model
	 * [
	 * 	'meta_key1' => 'meta_value1',
	 * 	'meta_key2' => 'meta_value2',
	 * 	'meta_key3' => 'meta_value3',
	 * ]
	 * @var array
	 */
	protected $metavalue = [];

	protected $metaclass;

	public function getMetaData()
    {
	    $metadata = [];

    	$data = $this->meta()
	        ->whereIn('meta_key', array_keys($this->metavalue))
	        ->get();

	    foreach ($data as $item) {
	    	$metadata[$item->meta_key] = $item->meta_value;
	    }
	    return $metadata;
    }


	public function meta()
    {
    	$relationClass = $this->metaclass ?? get_class().Meta::class;
    	return $this->hasMany($relationClass);
    }

    public function storeMeta(array $items)
    {
    	$vm = &$this;

        $models = collect($items)->map(function($item, $key) use ( $vm ) {
        	$model = $vm->meta()->getModel();
        	$model->fill(['meta_key' => $key, 'meta_value' => $item]);
        	return $model;
        });

        $this->meta()->saveMany($models);
    }

}