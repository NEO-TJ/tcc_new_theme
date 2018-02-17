<?php
class Helper_m extends CI_Model {
    // Property
    public $count;


    // *************************************************** Helper ************************************************
    // ________________________________________________ String Tool ______________________________________________
    public function IsNullOrEmptyString($strValue){
        return (!isset($strValue) || trim($strValue)==='');
    }
    // _________________________________________________ Array Tool ______________________________________________
    // +++ Convert Serialize Array To Pair Array +++++++++++++++++++++++++
    public function myJsonDecode($serializeArray) {
        $result = array_combine(array_column($serializeArray, 'name'), array_column($serializeArray, 'value'));

        return $result;
    }
    // +++ Check post ajax value from array to array +++++++++++++++++++++
	public function getPostArrayHelper($arrayData) {
		return (((count($arrayData) == 1) && ($arrayData[0] == '')) ? $arrayData = [] : $arrayData);
	}



    // ________________________________________________ Random string ____________________________________________
    public function random_str($length, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }



    // _______________________________________________ ICC Card Master ___________________________________________
    public function CreateJoinTableIccCardMaster() {
        $sqlStr = " LEFT JOIN " . $this->cleanupType_d->tableName . " AS ct"
                . " ON c." . $this->iccCard_d->colFkCleanupType
                . "=ct." . $this->cleanupType_d->colId

                . " LEFT JOIN " . $this->distanceUnit_d->tableName . " AS du"
                . " ON c." . $this->iccCard_d->colFkDistanceUnit
                . "=du." . $this->distanceUnit_d->colId

                . " LEFT JOIN " . $this->weightUnit_d->tableName . " AS wu"
                . " ON c." . $this->iccCard_d->colFkWeightUnit
                . "=wu." . $this->weightUnit_d->colId;

        return $sqlStr;
    }


    // __________________________________________________ Criteria _______________________________________________
    public function CreateCriteriaIn($columnName, $rDataIN, $criteria, $criteriaPrefix) {
        if(count($rDataIN) > 0) {
            $criteria = $criteria . ' && ' . $columnName . ' IN (';
    	 
            for($i=0 ; $i < count($rDataIN) ; $i++) {
                $criteria = $criteria . $rDataIN[$i] . ',';
            }
            $criteria = substr($criteria, 0, strlen($criteria) - 1);
            $criteria = $criteria . ')';
        
            if(strlen($criteria) > 4) {
                $criteria = substr($criteria, 4, strlen($criteria) - 4);
        
                $criteria = $criteriaPrefix . $criteria;
            }
        }
    	
        return $criteria;
    }

    public function GenSqlCriteriaIn($columnName, $rDataIN, $criteriaPrefix) {
        $criteria = "";
        if(count($rDataIN) > 0) {
            $criteria = $columnName . ' IN (';
            
            for($i=0 ; $i < count($rDataIN) ; $i++) {
                $criteria .= $rDataIN[$i] . ',';
            }
            $criteria = substr($criteria, 0, strlen($criteria) - 1);
            $criteria = $criteria . ')';
        }
        $criteria = ($this->IsNullOrEmptyString($criteria) ? "" : ($criteriaPrefix . $criteria));

    	return $criteria;
	}


    // ____________________________________________________ Where ________________________________________________
    public function CreateSqlWhere($criteria, $sqlWhere){
		if(($sqlWhere != null) ||  ($sqlWhere != '')) {
			if($criteria == '')	{
				$criteria = ' WHERE '.$sqlWhere;
			} else {
				$criteria = $criteria.' AND '.$sqlWhere;
			}
		}

        return $criteria;
    }

    public function CreateCriteriaWhere($criteria, $colName, $opertor, $value) {
		if(($value != null) || ($value > 0) ||  ($value != '')) {
            $sqlWhere = $colName . $opertor . $value;

			if($criteria == '')	{
				$criteria = ' WHERE '. $sqlWhere;
			} else {
				$criteria = $criteria.' AND '.$sqlWhere;
			}
		}

        return $criteria;
    }
}
?>
