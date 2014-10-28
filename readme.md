## Image Upload with Laravel

An image upload website built wih laravel framework.

Instructions:
----------

* **First:** Create a Migration file for table 'photos'

*Command:*
```php
php artisan migrate:make create_photos_table
```


* In this project, we need to use **Intervention/image** package
* Just add
```
"intervention/image": "dev-master"
```
 in the ``required`` field.

Then update the composer:
```php
composer update intervention/image
```


Here, after installing the package, when you'll try to access the package, at that time you maybe get an error message.

 To fix this error, we need to change **php.ini** file and uncomment ``;extension=php_fileinfo.dll`` in the *php.ini* file.

* Then add the providers and aliases for image configuration in the ``app/config/app.php``.

Add this in the ``provider`` :

```php
'Intervention\Image\ImageServiceProvider'
```


Also add this in the ``aliases`` :
```php
'Image' => 'Intervention\Image\Facades\Image',
```

* Create a layout page and create a form to upload the image in the database.

* To upload an image to the server, we need to specify the path. In the ``app/config/image.php`` configuration file, we specify that,
```php
'upload_folder' => '/uploads/',
```

 That means our files will be uploaded to ``'uploads'`` folder that resides in the public directory.

But when we are uploading the file, we have to specify the full path like this:
```php
$upload = Image::make($image)
    ->resize(Config::get('image.thumb_width'),Config::get('image.thumb_height'))
    ->save(public_path().Config::get('image.upload_folder').$fullname);
```

Here, we have to add ``public_path()`` before the ``Config::get('image.upload_folder')``

And also with this code, we can resize the image first and then uploaded the image.



----
Thanks,

Visit my website: [http://tahsinabrar.com](http://tahsinabrar.com)





