<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{

     use SoftDeletes;

    protected $fillable = [
        'concern', 'title', 'name', 'image', 'start_date', 'location',
        'body', 'body_2', 'body_3', 'body_4', 'extra', 'features',
        'img_paths', 'video_path', 'img_path', 'url', 'sort_order',
        'meta_title', 'meta_description', 'meta_keywords', 'status'
    ];

    protected $casts = [
        'extra' => 'array',
        'img_paths' => 'array',
    ];

    // ১. মেইন ইমেজ ইউআরএল (Main Featured Image)
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : asset('images/default-project.jpg');
    }

    // ২. মাল্টিপল গ্যালারি ইমেজ ইউআরএল (Multiple Images Array)
    public function getGalleryUrlsAttribute()
    {
        $urls = [];
        if ($this->img_paths && is_array($this->img_paths)) {
            foreach ($this->img_paths as $path) {
                $urls[] = Storage::url($path);
            }
        }
        return $urls;
    }

    // ৩. ভিডিও ইউআরএল (Video Path URL)
    public function getVideoUrlAttribute()
    {
        return $this->video_path ? Storage::url($this->video_path) : null;
    }

    // ৪. পিডিএফ বা ফাইল ইউআরএল (Project PDF)
    public function getFileUrlAttribute()
    {
        return $this->img_path ? Storage::url($this->img_path) : null;
    }

    const CONCERNS = [
        'bhaiya_housing'      => 'Bhaiya Housing',
        'bhaiya_hotel_resort' => 'Bhaiya Hotel & Resort',
        'right_aid_hospital'  => 'Right Aid Hospital',
    ];
}
