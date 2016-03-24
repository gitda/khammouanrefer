<?php



class Refer extends Eloquent {

	use UuidForKey;
	
	protected $primaryKey = "refer_uuid";

	protected $table = 'refer';

	public $timestamps = false;

	public $fillable = ['refer_uuid'];


}
