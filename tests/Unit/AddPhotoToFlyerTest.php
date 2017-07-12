<?php

namespace App;

use App\AddPhotoToFlyer;
use Mockery as m;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tests\TestCase;

class AddPhotoToFlyerTest extends TestCase
{
    public function test_itProcessesAformToAddAphotoToAflyer()
    {
        $flyer = factory(Flyer::class)->create();

        $file = m::mock(UploadedFile::class, [
            'getClientOriginalName' => 'foo',
            'getClientOriginalExtension' => 'jpg'
        ]);

        $file->shouldReceive('move')
            ->once()
            ->with('images/photos', 'nowfoo.jpg');

        $thumbnail = m::mock(Thumbnail::class);

        $thumbnail->shouldReceive('make')
            ->once()
            ->with('images/photos/nowfoo.jpg', 'images/photos/tn-nowfoo.jpg');
        
        (new AddPhotoToFlyer($flyer, $file, $thumbnail))->save();

        $this->assertCount(1, $flyer->photos);

    }

    
}

function time()
    {
        return 'now';
    }
function sha1($path) { return $path; }
