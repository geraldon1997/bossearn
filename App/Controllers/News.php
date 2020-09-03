<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\News as ModelsNews;

class News extends Controller
{
    public function create()
    {
        if (empty($this->postData['newstypeid'])) {
            $this->error = 'type of post cannot be empty';
        }

        $this->postData = $this->postData + ['image' => $this->processImage()];
        

        if (!empty($this->error)) {
            return $this->view('addnews', ['error' => $this->error]);
        }

        $news = ModelsNews::addNews($this->postData);
        
        
        if ($news) {
            return $this->view('addnews', ['news' => 'post created successfully']);
        }
        return $this->view('addnews', ['data' => $this->postData, 'news' => 'post was not created']);
        
    }

    public function processImage()
    {
        $name = $this->fileData['name'];
        $tmpname = $this->fileData['tmp_name'];
        $type = $this->fileData['type'];
        $error = $this->fileData['error'];
        $size = $this->fileData['size'];

        if (empty($this->fileData)) {
            return '';
        }

        $path = 'App/Assets/Images/Posts/';
        $path = $path.basename($name);

        $upload = move_uploaded_file($tmpname, $path);

        if ($upload) {
            return $path;
        }

        return '';
    }

    public function viewNews()
    {
        //
    }

    public function editNews()
    {
        //
    }
}