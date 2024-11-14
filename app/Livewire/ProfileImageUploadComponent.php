<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfileImageUploadComponent extends Component
{
    public $inputName;
    public $currentImage;
    public $label;

    public function __construct($inputName, $currentImage = null, $label = null)
    {
        $this->inputName = $inputName;
        $this->currentImage = $currentImage;
        $this->label = $label ?? 'Profile Image';
    }

    public function render()
    {
        return view('components.profile-image-upload');
    }
}
