<?php


class Doctor extends Eloquent {

	protected $table = 'doctor';

	protected $primaryKey = 'code';

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
