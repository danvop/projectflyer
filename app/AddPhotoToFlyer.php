<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToFlyer
{
    /**
     * The Flyer instance
     * 
     * @var Flyer
     */
    protected $flyer;

    /**
     * The UploadedFile instance
     * @var UploadedFile
     */
    protected $file;

    /**
     * Create a new AddPhotoToFlyer form object
     * @param Flyer          $flyer
     * @param UploadedFile   $file
     * @param Thumbnail|null $thumbnail
     */
    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }

    /**
     * Process the form
     * @return void
     */
    public function save()
    {
        // Attache the photo to the flyer
        $photo = $this->flyer->addPhoto($this->makePhoto());
        
        // move the photo to the images folder
        $this->file->move($photo->baseDir(), $photo->name);
        
        // generate a thumbnail
        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }

    /**
     * Make a new photo instance
     * 
     * @return Photo
     */
    protected function makePhoto()
    {
        return new Photo(['name' => $this->makeFileName()]);
    }

    /**
     * Make a file name, based on the uploaded file
     * @return [type] [description]
     */
    protected function makeFileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }
}
