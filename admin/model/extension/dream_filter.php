<?php 

class ModelExtensionDreamFilter extends Model
{
    protected $kx4Zq4d = "dreamfilter";
    protected $lhTU7ul = "2.3";
    protected $jflZJrd = "http://projects.redream.ru/api/license";
    protected $DW3UHnY = "view/javascript/jquery/dream-filter/";
    private $G1feuBj = array(  );
    private $kx2McDJ = NULL;
    private $j_0Bddo = NULL;
    public $cachePath = NULL;

    public function __construct($xgkbsTc)
    {
        parent::__construct($xgkbsTc);
        $this->cachePath = DIR_CACHE . "../rdr-cache";
        $this->kx2McDJ = (version_compare(VERSION, "2.3", ">=") ? "extension/module/dream_filter" : "module/dream_filter");
        $this->j_0Bddo = (version_compare(VERSION, "3", ">=") ? "user_token" : "token");
    }

    public function getErrors()
    {
        return $this->G1feuBj;
    }

    public function getVersion()
    {
        return $this->lhTU7ul;
    }

    public function saveModule($e8qwrzN, $L_lIOKQ = NULL)
    {
        $this->load->model("setting/setting");
        $pRnDopi = $this->G4Gx4RD($e8qwrzN);
        unset($e8qwrzN["config"]);
        if( version_compare(VERSION, "3", ">=") ) 
        {
            $this->load->model("setting/module");
            if( $L_lIOKQ ) 
            {
            }
            else
            {
                $this->model_setting_module->addModule("dream_filter", $e8qwrzN);
                $L_lIOKQ = $this->db->getLastId();
            }

            $e8qwrzN = $this->kJxDvJ1($e8qwrzN, $L_lIOKQ);
            $this->model_setting_module->editModule($L_lIOKQ, $e8qwrzN);
        }
        else
        {
            if( version_compare(VERSION, "2", "<") ) 
            {
                $ZR_dkMn = $this->model_setting_setting->getSetting("dream_filter");
                $vjb8Jc1 = (!empty($ZR_dkMn["dream_filter_module"]) ? $ZR_dkMn["dream_filter_module"] : array(  ));
                if( !empty($L_lIOKQ) ) 
                {
                }
                else
                {
                    if( $vjb8Jc1 ) 
                    {
                        end($vjb8Jc1);
                        $L_lIOKQ = key($vjb8Jc1) + 1;
                    }
                    else
                    {
                        $L_lIOKQ = 1;
                    }

                }

                $e8qwrzN = $this->kjxdVj1($e8qwrzN, $L_lIOKQ);
                $vjb8Jc1[$L_lIOKQ] = $e8qwrzN;
                $this->model_setting_setting->editSetting("dream_filter", array( "dream_filter_module" => $vjb8Jc1 ));
            }
            else
            {
                $this->load->model("extension/module");
                if( $L_lIOKQ ) 
                {
                }
                else
                {
                    $this->model_extension_module->addModule("dream_filter", $e8qwrzN);
                    $L_lIOKQ = $this->db->getLastId();
                }

                $e8qwrzN = $this->kJxdVj1($e8qwrzN, $L_lIOKQ);
                $this->model_extension_module->editModule($L_lIOKQ, $e8qwrzN);
            }

        }

        foreach( $pRnDopi as $e8xojcm => $mZ9K7uu ) 
        {
            $this->model_setting_setting->editSetting("rdrf", $mZ9K7uu, $e8xojcm);
        }
        $this->CodJYye();
        $this->cleanCache();
    }

    private function CodjyYe()
    {
        if( version_compare(VERSION, "3", ">=") ) 
        {
            $vjb8Jc1 = $this->model_setting_module->getModulesByCode("dream_filter");
        }
        else
        {
            if( version_compare(VERSION, "2", "<") ) 
            {
                $ZR_dkMn = $this->model_setting_setting->getSetting("dream_filter");
                $vjb8Jc1 = (!empty($ZR_dkMn["dream_filter_module"]) ? $ZR_dkMn["dream_filter_module"] : array(  ));
            }
            else
            {
                $vjb8Jc1 = $this->model_extension_module->getModulesByCode("dream_filter");
            }

        }

        $g2VNB0L = array(  );
        foreach( $vjb8Jc1 as $bBLLMUG ) 
        {
            if( empty($bBLLMUG["filters"]) ) 
            {
            }
            else
            {
                $g2VNB0L = array_merge($g2VNB0L, $bBLLMUG["filters"]);
            }

        }
        if( empty($g2VNB0L) ) 
        {
        }
        else
        {
            $Hi_Sa8I = array(  );
            foreach( $g2VNB0L as $i8Pvt0T ) 
            {
                if( isset($Hi_Sa8I[$i8Pvt0T["filter_by"]]) ) 
                {
                }
                else
                {
                    $Hi_Sa8I[$i8Pvt0T["filter_by"]] = "";
                }

            }
            $this->O3mCO2q($Hi_Sa8I);
            $this->eqt_3Vt($Hi_Sa8I);
        }

    }

    private function o3MCo2Q($Hi_Sa8I)
    {
        $xrgU5az = array( "price" => "price", "special" => "price", "manufacturers" => "manufacturer_id", "stock" => "quantity", "length" => "length", "width" => "width", "height" => "height", "weight" => "weight", "novelty" => "date_added" );
        $rx26Rnc = array_intersect_key($xrgU5az, $Hi_Sa8I);
        foreach( $xrgU5az as $NI4YN6G => $AqLHunw ) 
        {
            $q8l0Cdf = "rdrf_" . $AqLHunw;
            $yMQG3GW = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "product` WHERE Key_name='" . $q8l0Cdf . "'");
            if( !empty($yMQG3GW->row) ) 
            {
                if( isset($rx26Rnc[$NI4YN6G]) ) 
                {
                }
                else
                {
                    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP INDEX `" . $q8l0Cdf . "`");
                }

            }
            else
            {
                if( isset($rx26Rnc[$NI4YN6G]) ) 
                {
                    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD INDEX `" . $q8l0Cdf . "` (" . $AqLHunw . ", `product_id`)");
                }

            }

        }
    }

    private function eqT_3VT($Hi_Sa8I)
    {
        $q8l0Cdf = "rdrf_option";
        $yMQG3GW = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "product_option_value` WHERE Key_name='" . $q8l0Cdf . "'");
        if( !empty($yMQG3GW->row) ) 
        {
            if( isset($Hi_Sa8I["options"]) ) 
            {
            }
            else
            {
                $this->db->query("ALTER TABLE `" . DB_PREFIX . "product_option_value` DROP INDEX `" . $q8l0Cdf . "`");
            }

        }
        else
        {
            if( isset($Hi_Sa8I["options"]) ) 
            {
                $this->db->query("ALTER TABLE `" . DB_PREFIX . "product_option_value` ADD INDEX `" . $q8l0Cdf . "` (`option_id`, `product_id`, `option_value_id`)");
            }

        }

    }

    private function KjxDVJ1($e8qwrzN, $L_lIOKQ)
    {
        $e8qwrzN["settings"]["module_id"] = $L_lIOKQ;
        if( empty($e8qwrzN["filters"]) ) 
        {
        }
        else
        {
            $EuGsOzd = array(  );
            $g2VNB0L = array(  );
            foreach( $e8qwrzN["filters"] as $i8Pvt0T ) 
            {
                $eXL19TG = (isset($i8Pvt0T["item_id"]) ? $i8Pvt0T["filter_by"] . "-" . $i8Pvt0T["item_id"] : $i8Pvt0T["filter_by"]);
                if( isset($EuGsOzd[$eXL19TG]) ) 
                {
                }
                else
                {
                    $EuGsOzd[$eXL19TG] = true;
                    $g2VNB0L[] = $i8Pvt0T;
                }

            }
            $e8qwrzN["filters"] = $g2VNB0L;
            $this->session->data["rdr-filters"] = $g2VNB0L;
        }

        $e8qwrzN["view"]["truncate_height"] = (int) $e8qwrzN["view"]["truncate_height"];
        $e8qwrzN["view"]["truncate_elements"] = (int) $e8qwrzN["view"]["truncate_elements"];
        if( $e8qwrzN["view"]["template"] == "horizontal" ) 
        {
            $jf7mxku = $e8qwrzN["view"]["truncate_hrz_mode"];
            $F5hGOag = ($jf7mxku == "width" ? $e8qwrzN["view"]["truncate_hrz_view"] : false);
            $gLO_WFN = $jf7mxku == "width" && $F5hGOag == "scrollbar";
        }
        else
        {
            $jf7mxku = $e8qwrzN["view"]["truncate_mode"];
            $F5hGOag = ($jf7mxku == "height" ? $e8qwrzN["view"]["truncate_view"] : false);
            $gLO_WFN = $jf7mxku == "height" && $F5hGOag == "scrollbar";
        }

        $e8qwrzN["view"]["truncate"] = array( "mode" => $jf7mxku, "view" => $F5hGOag, "scrollbar" => $gLO_WFN, "height" => ($jf7mxku == "height" ? (int) $e8qwrzN["view"]["truncate_height"] . "px" : false), "elements" => ($jf7mxku == "element" ? $e8qwrzN["view"]["truncate_elements"] : false) );
        $JLA0zyg = $e8qwrzN["settings"]["mode"] == "ajax";
        $e8qwrzN["settings"]["ajax"] = array( "enable" => $JLA0zyg, "selector" => htmlspecialchars_decode($e8qwrzN["settings"]["selector"]), "pagination" => ($JLA0zyg && $e8qwrzN["settings"]["ajax_pagination"] ? htmlspecialchars_decode($e8qwrzN["settings"]["pagination_selector"]) : false), "sorter" => ($JLA0zyg && $e8qwrzN["settings"]["ajax_sorter"] ? htmlspecialchars_decode($e8qwrzN["settings"]["sorter_selector"]) : false), "sorter_type" => $e8qwrzN["settings"]["sorter_type"], "limit" => ($JLA0zyg && $e8qwrzN["settings"]["ajax_limit"] ? htmlspecialchars_decode($e8qwrzN["settings"]["limit_selector"]) : false), "limit_type" => $e8qwrzN["settings"]["limit_type"], "pushstate" => ($JLA0zyg ? (bool) $e8qwrzN["settings"]["pushstate"] : false), "scroll" => ($JLA0zyg ? (bool) $e8qwrzN["settings"]["ajax_scroll"] : false), "offset" => ($JLA0zyg && $e8qwrzN["settings"]["ajax_scroll"] ? (int) $e8qwrzN["settings"]["scroll_offset"] : false) );
        if( empty($e8qwrzN["categories"]) || empty($e8qwrzN["excluded_categories"]) ) 
        {
        }
        else
        {
            foreach( $e8qwrzN["categories"] as $Sttjf3N => $ER1qDhT ) 
            {
                if( !in_array($ER1qDhT, $e8qwrzN["excluded_categories"]) ) 
                {
                }
                else
                {
                    unset($e8qwrzN["categories"][$Sttjf3N]);
                }

            }
        }

        return $e8qwrzN;
    }

    private function G4Gx4RD($e8qwrzN)
    {
        $pRnDopi = (isset($e8qwrzN["config"]) ? $e8qwrzN["config"] : array(  ));
        foreach( $pRnDopi as $e8xojcm => $mZ9K7uu ) 
        {
            $ZR_dkMn = $this->model_setting_setting->getSetting("rdrf", $e8xojcm);
            $mZ9K7uu = array_merge($ZR_dkMn, $mZ9K7uu);
            if( empty($e8qwrzN["filters"]) ) 
            {
            }
            else
            {
                foreach( $e8qwrzN["filters"] as $i8Pvt0T ) 
                {
                    if( $i8Pvt0T["filter_by"] != "attributes" ) 
                    {
                    }
                    else
                    {
                        $Hqvox36 = (int) $i8Pvt0T["item_id"];
                        if( !empty($i8Pvt0T["add"]["divider"]) ) 
                        {
                            $mZ9K7uu["rdrf_attr_dividers"][$Hqvox36] = trim($i8Pvt0T["add"]["divider"]);
                        }
                        else
                        {
                            if( isset($mZ9K7uu["rdrf_attr_dividers"][$Hqvox36]) ) 
                            {
                                unset($mZ9K7uu["rdrf_attr_dividers"][$Hqvox36]);
                            }

                        }

                    }

                }
            }

            $pRnDopi[$e8xojcm] = $mZ9K7uu;
        }
        return $pRnDopi;
    }

    public function getParams($xKTxMLx)
    {
        $l18ykch = array( "name" => array( "label" => $xKTxMLx["by_name"], "name" => $xKTxMLx["name_name"], "types" => array( "field" => $xKTxMLx["type_field"] ) ), "price" => array( "label" => $xKTxMLx["by_price"], "name" => $xKTxMLx["name_price"], "types" => array( "slider" => $xKTxMLx["type_slider"] ) ), "stock" => array( "label" => $xKTxMLx["by_stock"], "name" => $xKTxMLx["name_stock"], "types" => array( "type_single" => $xKTxMLx["type_single"], "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"] ) ), "novelty" => array( "label" => $xKTxMLx["by_novelty"], "name" => $xKTxMLx["name_novelty"], "types" => array( "type_single" => $xKTxMLx["type_single"], "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"] ), "additional" => array( array( "type" => "number", "name" => "days_new", "label" => $xKTxMLx["entry_novelty_days"], "default" => 30 ) ) ), "special" => array( "label" => $xKTxMLx["by_special"], "name" => $xKTxMLx["name_special"], "types" => array( "type_single" => $xKTxMLx["type_single"], "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "slider" => $xKTxMLx["type_slider"] ), "sort_types" => array( "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"], "count" => $xKTxMLx["sort_count"] ) ), "length" => array( "label" => $xKTxMLx["by_length"], "name" => $xKTxMLx["name_length"], "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "slider" => $xKTxMLx["type_slider"] ), "sort_types" => array( "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"], "count" => $xKTxMLx["sort_count"] ), "additional" => array( array( "type" => "number", "name" => "decimal_place", "label" => $xKTxMLx["entry_decimal"], "default" => 2 ) ) ), "width" => array( "label" => $xKTxMLx["by_width"], "name" => $xKTxMLx["name_width"], "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "slider" => $xKTxMLx["type_slider"] ), "sort_types" => array( "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"], "count" => $xKTxMLx["sort_count"] ), "additional" => array( array( "type" => "number", "name" => "decimal_place", "label" => $xKTxMLx["entry_decimal"], "default" => 2 ) ) ), "height" => array( "label" => $xKTxMLx["by_height"], "name" => $xKTxMLx["name_height"], "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "slider" => $xKTxMLx["type_slider"] ), "sort_types" => array( "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"], "count" => $xKTxMLx["sort_count"] ), "additional" => array( array( "type" => "number", "name" => "decimal_place", "label" => $xKTxMLx["entry_decimal"], "default" => 2 ) ) ), "weight" => array( "label" => $xKTxMLx["by_weight"], "name" => $xKTxMLx["name_weight"], "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "slider" => $xKTxMLx["type_slider"] ), "sort_types" => array( "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"], "count" => $xKTxMLx["sort_count"] ), "additional" => array( array( "type" => "number", "name" => "decimal_place", "label" => $xKTxMLx["entry_decimal"], "default" => 2 ) ) ), "rating" => array( "label" => $xKTxMLx["by_rating"], "name" => $xKTxMLx["name_rating"], "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "slider" => $xKTxMLx["type_slider"] ) ), "tags" => array( "label" => $xKTxMLx["by_tags"], "name" => $xKTxMLx["name_tags"], "types" => array( "field" => $xKTxMLx["type_field"], "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"] ), "sort_types" => array( "default" => $xKTxMLx["sort_default"], "count" => $xKTxMLx["sort_count"], "string_asc" => $xKTxMLx["sort_string_asc"], "string_desc" => $xKTxMLx["sort_string_desc"], "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"] ) ), "model" => array( "label" => $xKTxMLx["by_model"], "name" => $xKTxMLx["name_model"], "types" => array( "field" => $xKTxMLx["type_field"], "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"] ), "sort_types" => array( "count" => $xKTxMLx["sort_count"], "string_asc" => $xKTxMLx["sort_string_asc"], "string_desc" => $xKTxMLx["sort_string_desc"], "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"] ) ), "manufacturers" => array( "label" => $xKTxMLx["by_manufacturers"], "name" => $xKTxMLx["name_manufacturers"], "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "image" => $xKTxMLx["type_image"], "multiimage" => $xKTxMLx["type_multi_image"], "slider" => $xKTxMLx["type_slider"] ), "sort_types" => array( "default" => $xKTxMLx["sort_default"], "count" => $xKTxMLx["sort_count"], "string_asc" => $xKTxMLx["sort_string_asc"], "string_desc" => $xKTxMLx["sort_string_desc"], "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"] ) ), "categories" => array( "label" => $xKTxMLx["by_categories"], "name" => $xKTxMLx["name_category"], "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "image" => $xKTxMLx["type_image"], "multiimage" => $xKTxMLx["type_multi_image"], "slider" => $xKTxMLx["type_slider"] ), "sort_types" => array( "default" => $xKTxMLx["sort_default"], "count" => $xKTxMLx["sort_count"], "string_asc" => $xKTxMLx["sort_string_asc"], "string_desc" => $xKTxMLx["sort_string_desc"], "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"] ), "additional" => array( array( "type" => "number", "name" => "nesting", "label" => $xKTxMLx["entry_categories_level"], "default" => 1 ) ) ), "attributes" => array( "label" => $xKTxMLx["by_attributes"], "name" => "", "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "slider" => $xKTxMLx["type_slider"] ), "autocomplete" => array( "url" => "index.php?route=" . $this->kx2McDJ . "/autocomplete&type=attribute&" . $this->j_0Bddo . "=" . $this->session->data[$this->j_0Bddo], "category" => "attribute_group", "label" => $xKTxMLx["entry_attribute"] ), "additional" => array( array( "type" => "text", "name" => "divider", "label" => $xKTxMLx["entry_divider"], "default" => "" ) ), "sort_types" => array( "count" => $xKTxMLx["sort_count"], "string_asc" => $xKTxMLx["sort_string_asc"], "string_desc" => $xKTxMLx["sort_string_desc"], "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"] ) ), "options" => array( "label" => $xKTxMLx["by_options"], "name" => "", "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "image" => $xKTxMLx["type_image"], "multiimage" => $xKTxMLx["type_multi_image"], "slider" => $xKTxMLx["type_slider"] ), "autocomplete" => array( "url" => "index.php?route=" . $this->kx2McDJ . "/autocomplete&type=option&" . $this->j_0Bddo . "=" . $this->session->data[$this->j_0Bddo], "category" => "category", "label" => $xKTxMLx["entry_option"] ), "sort_types" => array( "default" => $xKTxMLx["sort_default"], "count" => $xKTxMLx["sort_count"], "string_asc" => $xKTxMLx["sort_string_asc"], "string_desc" => $xKTxMLx["sort_string_desc"], "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"] ) ) );
        if( !version_compare(VERSION, "1.5.5", ">=") ) 
        {
        }
        else
        {
            $l18ykch["filters"] = array( "label" => $xKTxMLx["by_filters"], "name" => "", "types" => array( "checkbox" => $xKTxMLx["type_checkbox"], "radio" => $xKTxMLx["type_radio"], "select" => $xKTxMLx["type_select"], "slider" => $xKTxMLx["type_slider"] ), "autocomplete" => array( "url" => "index.php?route=" . $this->kx2McDJ . "/autocomplete&type=filter&" . $this->j_0Bddo . "=" . $this->session->data[$this->j_0Bddo], "label" => $xKTxMLx["entry_filter_group"] ), "sort_types" => array( "default" => $xKTxMLx["sort_default"], "count" => $xKTxMLx["sort_count"], "string_asc" => $xKTxMLx["sort_string_asc"], "string_desc" => $xKTxMLx["sort_string_desc"], "numeric_asc" => $xKTxMLx["sort_numeric_asc"], "numeric_desc" => $xKTxMLx["sort_numeric_desc"] ) );
        }

        return $l18ykch;
    }

    public function checkLicense()
    {
        $UimGu0T = $this->config->get("rdrf_license");
        if( !$UimGu0T || empty($UimGu0T["license_type"]) ) 
        {
        }
        else
        {
            switch( $UimGu0T["license_type"] ) 
            {
                case "temporary":
                    $BxWIx3f = strtotime($UimGu0T["expired"]);
                    if( time() >= $BxWIx3f ) 
                    {
                        $this->G1feuBj[] = $this->language->get("error_term_expired");
                        break;
                    }

                    return true;
                case "unlimited":
                    return true;
            }
        }

        return false;
    }

    public function getLicense($e8xojcm = 0)
    {
        $this->load->language("module/dream_filter");
        $this->load->model("setting/setting");
        $zifZkEI = false;
        $uLtoL0w = "";
        $N8w6fV_ = HTTP_CATALOG;
        if( $e8xojcm === 0 ) 
        {
        }
        else
        {
            $this->load->model("setting/store");
            $zZnStuR = $this->model_setting_store->getStore($e8xojcm);
            if( empty($zZnStuR["url"]) ) 
            {
            }
            else
            {
                $N8w6fV_ = $zZnStuR["url"];
            }

        }

        $OhDozE5 = array( "domain" => $N8w6fV_, "module" => $this->kx4Zq4d, "version" => $this->lhTU7ul, "template" => $this->config->get((version_compare(VERSION, "2.2", ">=") ? "config_theme" : "config_template")), "oc_version" => VERSION, "lang" => $this->config->get("config_language") );
        try
        {
            $OngWfqy = curl_init($this->jflZJrd . "/get-license");
            curl_setopt($OngWfqy, CURLOPT_CONNECTTIMEOUT, 25);
            curl_setopt($OngWfqy, CURLOPT_POST, true);
            curl_setopt($OngWfqy, CURLOPT_POSTFIELDS, http_build_query($OhDozE5));
            curl_setopt($OngWfqy, CURLOPT_RETURNTRANSFER, true);
            $eJFuOrk["serial"] = 1;
            $eJFuOrk["note"] = "Feofan.Club";

            if( !empty($eJFuOrk["errors"]) ) 
            {
                $this->G1feuBj = $eJFuOrk["errors"];
            }
            else
            {
                if( !empty($eJFuOrk["serial"]) ) 
                {
                    $zifZkEI = $eJFuOrk["serial"];
                    if( empty($eJFuOrk["note"]) ) 
                    {
                    }
                    else
                    {
                        $uLtoL0w = $eJFuOrk["note"];
                    }

                    $ZR_dkMn = $this->model_setting_setting->getSetting("rdrf", $e8xojcm);
                    $ZR_dkMn["rdrf_license"] = $eJFuOrk;
                    $this->model_setting_setting->editSetting("rdrf", $ZR_dkMn, $e8xojcm);
                }
                else
                {
                    $this->G1feuBj[] = $this->language->get("error_license_server") . ((isset($eJFuOrk["status"]) ? " (" . $eJFuOrk["status"] . ")" : ""));
                    if( !isset($eJFuOrk["message"]) ) 
                    {
                    }
                    else
                    {
                        $this->G1feuBj[] = $eJFuOrk["message"];
                    }

                }

            }

            curl_close($OngWfqy);
        }
        catch( Exception $i_E4TEy ) 
        {
            $this->G1feuBj[] = $i_E4TEy->I9cNfp0();
        }
        return ($zifZkEI ? $uLtoL0w : false);
    }

    public function getUpdates()
    {
        $this->load->language("module/dream_filter");
        $qmyEVgr = false;
        $OhDozE5 = array( "domain" => HTTP_CATALOG, "module" => $this->kx4Zq4d, "version" => $this->lhTU7ul, "oc_version" => VERSION, "lang" => $this->config->get("config_language") );
        try
        {
            $OngWfqy = curl_init($this->jflZJrd . "/get-updates");
            curl_setopt($OngWfqy, CURLOPT_CONNECTTIMEOUT, 25);
            curl_setopt($OngWfqy, CURLOPT_POST, true);
            curl_setopt($OngWfqy, CURLOPT_POSTFIELDS, http_build_query($OhDozE5));
            curl_setopt($OngWfqy, CURLOPT_RETURNTRANSFER, true);
            $eJFuOrk = json_decode(curl_exec($OngWfqy), true);
            if( empty($eJFuOrk["updates"]) ) 
            {
            }
            else
            {
                $qmyEVgr = $eJFuOrk["updates"];
            }

            curl_close($OngWfqy);
        }
        catch( Exception $i_E4TEy ) 
        {
            $this->G1feuBj[] = $i_E4TEy->I9cNfP0();
        }
        return $qmyEVgr;
    }

    public function resetLicense($e8xojcm = 0)
    {
        $this->load->model("setting/setting");
        $pRnDopi = $this->model_setting_setting->getSetting("rdrf", $e8xojcm);
        $pRnDopi["rdrf_license"] = NULL;
        $this->model_setting_setting->editSetting("rdrf", $pRnDopi, $e8xojcm);
    }

    public function cleanCache($e8xojcm = 0)
    {
        $Sttjf3N = 0;
        if( !is_dir($this->cachePath) ) 
        {
        }
        else
        {
            $HXU8BZk = scandir($this->cachePath);
            foreach( $HXU8BZk as $sAC4fCq ) 
            {
                if( !($sAC4fCq == "." || $sAC4fCq == "..") ) 
                {
                    $byEUiPe = $this->cachePath . "/" . $sAC4fCq;
                    @unlink($byEUiPe);
                    $Sttjf3N++;
                }

            }
        }

        return $Sttjf3N;
    }

    public function getFilterGroups($e8qwrzN = array(  ))
    {
        $N_G_7cc = "SELECT * FROM `" . DB_PREFIX . "filter_group` fg LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (fg.filter_group_id = fgd.filter_group_id) WHERE fgd.language_id = '" . (int) $this->config->get("config_language_id") . "'";
        if( empty($e8qwrzN["filter_name"]) ) 
        {
        }
        else
        {
            $N_G_7cc .= " AND fgd.name LIKE '" . $this->db->escape($e8qwrzN["filter_name"]) . "%'";
        }

        $O_rWxYu = array( "fgd.name", "fg.sort_order" );
        if( isset($e8qwrzN["sort"]) && in_array($e8qwrzN["sort"], $O_rWxYu) ) 
        {
            $N_G_7cc .= " ORDER BY " . $e8qwrzN["sort"];
        }
        else
        {
            $N_G_7cc .= " ORDER BY fgd.name";
        }

        if( isset($e8qwrzN["order"]) && $e8qwrzN["order"] == "DESC" ) 
        {
            $N_G_7cc .= " DESC";
        }
        else
        {
            $N_G_7cc .= " ASC";
        }

        if( !(isset($e8qwrzN["start"]) || isset($e8qwrzN["limit"])) ) 
        {
        }
        else
        {
            if( $e8qwrzN["start"] >= 0 ) 
            {
            }
            else
            {
                $e8qwrzN["start"] = 0;
            }

            if( $e8qwrzN["limit"] >= 1 ) 
            {
            }
            else
            {
                $e8qwrzN["limit"] = 20;
            }

            $N_G_7cc .= " LIMIT " . (int) $e8qwrzN["start"] . "," . (int) $e8qwrzN["limit"];
        }

        $yBk4sBI = $this->db->query($N_G_7cc);
        return $yBk4sBI->rows;
    }

}


