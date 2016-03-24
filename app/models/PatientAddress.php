<?php



class PatientAddress extends Eloquent {

	
	protected $primaryKey = "patient_id";

	protected $table = 'patient_address';

	public $timestamps = false;

	public $fillable = ['patient_id'];


}
