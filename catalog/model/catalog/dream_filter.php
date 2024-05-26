<?php
class ModelCatalogDreamFilter extends Model {
	
	private $_ionCube;

	/**
	 * ModelCatalogDreamFilter constructor.
	 * @param $registry
	 */
	public function __construct($registry) {
		$this->registry = $registry;
		$this->_ionCube = extension_loaded('ionCube Loader');
		if($this->_ionCube) {
			$this->load->model('extension/dream_filter');
		} else {
			$this->load->model('catalog/product');
		}
	}

	/**
	 * @param $setting
	 * @param $request
	 * @return array
	 */
	public function prepareFilters($setting, $request) {
		if(isset($request['path'])) {
			if(!$this->checkCategory($request['path'], $setting)) {
				return array();
			}
		}
		if($this->_ionCube) {
			return $this->model_extension_dream_filter->prepareFilters($setting, $request);
		}
		return array(
			'errors' => array($this->language->get('error_ioncube'))
		);
	}

	/**
	 * @param $filter_data
	 * @return mixed
	 */
	public function getTotalProducts($filter_data) {
		if($this->_ionCube) {
			$total = $this->model_extension_dream_filter->getTotalProducts($filter_data);
			if($total !== false) {
				return $total;
			}
		}
		return $this->model_catalog_product->getTotalProducts($filter_data);
	}

	/**
	 * @param $filter_data
	 * @return mixed
	 */
	public function getProducts($filter_data) {
		if($this->_ionCube) {
			$products = $this->model_extension_dream_filter->getProducts($filter_data);
			if($products !== false) {
				return $products;
			}
		}
		return $this->model_catalog_product->getProducts($filter_data);
	}
	
	/**
	 * @param $filter_data
	 * @return mixed
	 */
	public function getTotalProductSpecials($filter_data) {
		$filter_data['special'] = true;
		return $this->getTotalProducts($filter_data);
	}

	/**
	 * @param $filter_data
	 * @return mixed
	 */
	public function getProductSpecials($filter_data) {
		$filter_data['special'] = true;
		return $this->getProducts($filter_data);
	}

	/**
	 * @param $request
	 * @param $module_id
	 * @return array
	 */
	public function getFiltersJSON($request, $module_id) {
		if($this->_ionCube) {
			$filters_json = $this->model_extension_dream_filter->getFiltersJSON($request, $module_id);
			if($filters_json !== false) {
				return $filters_json;
			}
		}
		return array();
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

	/**
	 * @param $path
	 * @return bool
	 */
	private function checkCategory($path, $setting) {
		$parts = explode('_', (string)$path);
		$category_id = (int)end($parts);
		if(!empty($setting['settings']['categories'])) {
			if(!empty($setting['settings']['categories_child'])) {
				$collisions = array_intersect($parts, $setting['settings']['categories']);
				if(empty($collisions)) {
					return false;
				}
			} else {
				if(!in_array($category_id, $setting['settings']['categories'])) {
					return false;
				}
			}
		}
		if(!empty($setting['settings']['excategories'])) {
			if(!empty($setting['settings']['excategories_child'])) {
				$collisions = array_intersect($parts, $setting['settings']['excategories']);
				if(!empty($collisions)) {
					return false;
				}
			} else {
				if(in_array($category_id, $setting['settings']['excategories'])) {
					return false;
				}
			}
		}
		return true;
	}
}
