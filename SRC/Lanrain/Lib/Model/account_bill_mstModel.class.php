<?php 
class account_bill_mstModel extends RelationModel{
    protected $_link = array(
            'Profile'=>array(
            	'mapping_type'  => HAS_ONE,
                'class_name'    => 'wecha_shop',
            	'foreign_key'   => 'tokenTall',
             ),
         );
}
?>