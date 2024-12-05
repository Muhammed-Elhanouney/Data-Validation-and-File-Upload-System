<?php

trait File
{
    public function checkFile($file)
    {
        if ($this->checkError() && $this->checkExt() && $this->checkSize()) {
            $path = __DIR__ . '/up/';
            if (!is_dir($path)) {
                mkdir($path);
            }
            $checkExten = pathinfo(static::get('full_path'), PATHINFO_EXTENSION);
            $newName =  md5(uniqid(static::get('name')));
            $moved = move_uploaded_file(static::get('tmp_name'), $path . '_img_' . $newName . '.' . $checkExten);
            if ($moved) {
                return 'your file uploded success';
            }
        }

        // insert into db
    }

    public function checkError()
    {
        if (static::get('error') == 4) {
            $this->errors['img'] = 'you must upload an image';
            return false;
        } else {
            return true;
        }
    }

    public function checkExt()
    {
        $extensions = ['jpg', 'gif', 'png'];
        $ext = pathinfo(static::get('name'), PATHINFO_EXTENSION);

        if (!in_array($ext, $extensions)) {
            $this->errors['img'] = 'wrong file extension';
            return false;
        } else {
            return true;
        }
    }

    public function checkSize()
    {
        if (static::get('size') > 2000000) {
            $this->errors['img'] = 'file size is too big';
            return false;
        } else {
            return true;
        }
    }

    public static function get($val): string
    {
        return static::$files['img'][$val];
    }
}
