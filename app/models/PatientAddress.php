<?php



class PatientAddress extends Eloquent {


	use UuidForKey;
	
	protected $primaryKey = "refer_uuid";

	protected $table = 'patient_address';

	public $timestamps = false;




}
