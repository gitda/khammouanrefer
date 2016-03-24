<?php



class PatientHn extends Eloquent {

	use UuidForKey;
	
	protected $primaryKey = "refer_uuid";

	protected $table = 'patient_hn';

	public $timestamps = false;


	public $fillable = ['hospcode','patient_id'];




}
