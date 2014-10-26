<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 10/26/2014
 * Time: 9:25 AM
 */

class Image extends Eloquent {
    protected $table = 'photos';
    protected $fillable = array('title','image');
} 