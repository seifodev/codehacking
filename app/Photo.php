<?php

namespace App;

/* */
use App\Http\Requests\UsersRequest;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public static $destinationPath = 'images';
    protected $fillable = ['path'];

    public function user()
    {
        return $this->hasOne('App\User');
    }


    /**
     * Upload Photo if exists and store photo data into database
     * @param object $request
     * @return Photo|bool
     */
    public static function upload($request)
    {
        if($request->hasFile('photo') && $request->file('photo')->isValid())
        {
            $photoName = date('Y-m-d') . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(static::$destinationPath, $photoName);

            return static::create(['path' => $photoName]);

        }

        return false;
    }

    /**
     * delete photo file if exists before deleting from database
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        $photoFilePath = public_path() . DIRECTORY_SEPARATOR . static::$destinationPath . DIRECTORY_SEPARATOR . $this->path;
        if(file_exists($photoFilePath))
        {
            @unlink($photoFilePath);
        }
        return parent::delete();

    }



    /**
     *
     */
    public function photoPath()
    {
        return '/' . static::$destinationPath . '/' . $this->path;
    }
}
