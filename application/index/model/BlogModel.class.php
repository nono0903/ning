<?php 
namespace Home\Model;
use Think\Model\RelationModel;
class BlogModel extends RelationModel{

	protected $_link = array(
		'content'=>array(
			'mapping_type' => self::HAS_ONE,
			'class_name' => 'content',
			'foreign_key' =>'blog_id',
			'condition' =>'blog_id',
			'as_fields' =>'content'

			
		),

		'comment'=>array(
			'mapping_type'=>self::HAS_MANY,
			'class_name' =>'Comment',
			'foreign_key' =>'blog_id',
			'condition' =>'blog_id',
			'as_fields' =>'message',
		),

		'tag'=>array(
			'mapping_type'=>self::HAS_MANY,
			'class_name' =>'Tag',
			'foreign_key' =>'blog_id',
			'condition' =>'blog_id',
			'as_fields' =>'tagname',

		),
	);

}