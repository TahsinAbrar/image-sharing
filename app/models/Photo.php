<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 10/26/2014
 * Time: 9:25 AM
 */

class Photo extends Eloquent {
    protected $table = 'photos';
    protected $fillable = array('title','image');
    //rules of the image upload form
    public static $upload_rules = array(
        'title' => 'required|min:3',
        'image' => 'required|image'
    );
} 