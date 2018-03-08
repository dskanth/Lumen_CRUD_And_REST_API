<?php

/*
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
*/
namespace App;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model {

	protected $table = 'worklog';
	
	//protected $timestamps = true;

	protected $fillable = ['username', 'noted', 'notes'];

}
