<?php

namespace App\Classes;

class CreateBlogBodyRequest {
    public $userId;
    public $title;
    public $content;
    public $hideComments;
    public $availableAt;

    // setters
    function  set_userId($userId) {
        $this->userId = $userId;
    }
    function  set_title($title) {
        $this->title = $title;
    }
    function  set_content($content) {
        $this->content = $content;
    }
    function  set_hideComments($hideComments) {
        $this->hideComments = $hideComments;
    }
    function  set_availableAt($availableAt) {
        $this->availableAt = $availableAt;
    }

    //getters
    function  get_userId() {
        return $this->userId;
    }
    function  get_title() {
        return $this->title;
    }
    function  get_content() {
        return $this->content;
    }
    function  get_hideComments() {
        return $this->hideComments;
    }
    function  get_availableAt() {
        return $this->availableAt;
    }
}
