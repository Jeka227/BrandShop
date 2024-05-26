<?php
/**
 * reDream http://redream.ru
 */

class ModelCatalogDreamFilter extends Model {

	private $_ionCube;

	/**
	 * ModelCatalogDreamFilter constructor.
	 * @param $registry
	 */
	public function __construct($registry) {
        parent::__construct($registry);
		$this->_ionCube = (extension_loaded('ionCube Loader') && version_compare(ioncube_loader_version(), '5', '>='));
		if($this->_ionCube) {
			$this->load->model('extension/dream_filter');
		}
	}

	/**
	 * @return int|bool
	 */
	public function cleanCache() {
		if($this->_ionCube) {
			return $this->model_extension_dream_filter->cleanCache();
		}
		return false;
	}
}