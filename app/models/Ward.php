<?php


class Ward extends Eloquent {

	protected $table = 'ward';

	protected $primaryKey = 'ward';

	public $timestamps = false;


	public function scopeActive($query)
	{
		return $query->where('active','=','Y');
	}
	public function scopeHospcode($query, $hospcode)
	{
		return $query->where('hospcode','=', $hospcode);
	}
}
