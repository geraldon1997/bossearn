<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Earning;
use App\Models\News as ModelsNews;
use App\Models\Point;
use App\Models\User;

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

        $date = time() + (60 * 60 * 24);
        $this->postData['time'] = $date;
        
        $news = ModelsNews::addNews($this->postData);

        if ($news) {
            return $this->view('addnews', ['news' => 'post created successfully']);
        }
        return $this->view('addnews', ['data' => $this->postData, 'error' => 'post was not created']);
    }

    

    public function read($id)
    {
        $newsid = $id[0];
        unset($id[0]);
        if (isset($id[1])) {
            $userid = $id[1];

            $userexists = User::is_user_exists($userid);

            if ($userexists) {
                $subid = User::subscriptionId($userid);
                $previouspoint = Earning::find(Earning::$table, 'user_id', $userid)[0]['bpoint'];
                $point = Point::point('subscription_id', $subid)[0]['visitor_points'];
                $newpoint = $previouspoint + $point;

                Earning::updateEarning('bpoint', $newpoint, $userid);
            }
        }

        $news = ModelsNews::find(ModelsNews::$newstable, 'id', $newsid)[0];

        return $this->view('readnews', $news);
    }

    public function edit($id)
    {
        $id = implode('', $id);
        $news = ModelsNews::find(ModelsNews::$newstable, 'id', $id)[0];
        return $this->view('editnews', $news);
    }

    public function update($id)
    {
        $id = implode('', $id);
        $image = $this->processImage();

        $title = $this->postData['title'];
        $body = $this->postData['body'];

        if (empty($image)) {
            $update = ModelsNews::update(ModelsNews::$newstable, "title = '$title', body = '$body' ", 'id', $id);
            if ($update) {
                return $this->view('addnews', ['news' => 'post updated successfully']);
            }
            return $this->view('addnews', ['error' => 'post was not updated']);
        }

        $update = ModelsNews::update(ModelsNews::$newstable, "title = '$title', body = '$body', image = '$image' ", 'id', $id);
        if ($update) {
            return $this->view('addnews', ['news' => 'post updated successfully']);
        }
        return $this->view('addnews', ['error' => 'post was not updated']);
    }

    public function delete()
    {
        $id = $this->postData['pid'];

        ModelsNews::delete(ModelsNews::$newstable, 'id', $id);

        header('location:'.PREVIOUS_PAGE);
        return;
    }
}
