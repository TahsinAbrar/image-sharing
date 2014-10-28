<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 10/26/2014
 * Time: 11:29 AM
 */

class ImageController extends BaseController {
    public function getIndex(){
        return View::make('board.index');
    }

    public function postIndex(){
        //Let's validate the form first with the rules which are set at the model
        $data = Input::all();
        $rules = Photo::$upload_rules;

        $validation = Validator::make($data, $rules);
        //If the validation fails, we redirect the user to the index page, with the error messages
        if($validation->fails()){
            return Redirect::to('/')
                ->withInput()
                ->withErrors($validation);
        }
        else {
            //If the validation passes, we upload the image to the database and process it
            $image = Input::file('image');

            //This is the original uploaded client name of the image

            $file =  $image->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);

            //We should salt and make an url-friendly version of the filename
            //(In ideal application, you should check the filename to be unique)

            $fullname = Str::slug(Str::random(8).$filename).'.'.$image->getClientOriginalExtension();

            // Now upload the image by resizing it.
            $upload = Image::make($image)
                        ->resize(Config::get('image.thumb_width'),Config::get('image.thumb_height'))
                        ->save(public_path().Config::get('image.upload_folder').$fullname);
            //Image::make($image)->resize(300, 200)->save('foo.jpg'); -- simple/easy upload

            if($upload){
                //image is now uploaded, we first need to add column to the database
                $photo = array(
                    'title' => Input::get('title'),
                    'image' => $fullname
                );
                $insert_id = Photo::create($photo)->id; // using Eloquent ORM get the last insert id

                // Using Fluent ORM, timestamps are not automatically updated.
/*                $insert_id = DB::table('photos')->insertGetId(
                     array(
                          'title' => Input::get('title'),
                          'image' => $fullname
                     )
                  );
*/

                //Now we redirect to the image's permalink
                return Redirect::to(URL::to('snatch/'.$insert_id))->with('success','Your image is uploaded successfully');
            }
            else {
                //image cannot be uploaded
                return Redirect::to('/')
                    ->withInput()
                    ->withError('Sorry, the image could not be uploaded, please try again later');
            }
        }
        return View::make('board.index');
    }

    public function getSnatch($id){
        // Let's try to find the image from database first
        $image = Photo::find($id);

        // If found, we load the view and pass the image info as parameter
        if($image){
          return View::make('board.permalink')->with('image',$image);
        }
        else {
            // else we redirect to main page with error message
            return Redirect::to('/')->with('error','Image Not Found');
        }
    }

    public function getAll(){
        //Let's first take all images with a pagination feature
        $all_images = DB::table('photos')->orderBy('id','desc')->paginate(6);

        //Then let's load the view with found data and pass the variable to the view
        return View::make('board.all_images')->with('images',$all_images);
    }

    public function getDelete($id){
        $image = Photo::find($id);
        if($image){
            //First, let's delete the images from FTP
            File::delete(public_path().Config::get('image.upload_folder').$image->image);
            //Now let's delete the value from database
            $image->delete();
            return Redirect::to('/')->with('success', 'Succesfully deleted the image');
        }
        else {
            //Image not found, so we will redirect to the index page with an error message flash data.
            return Redirect::to('/')->with('error', 'No image with given ID found.');
        }
    }
} 