<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersDB extends Model
{
    use HasFactory;

    public function setFirstname($value)
    {
        $this->setAttribute("firstname", $value);
    }

    public function getFirstname()
    {
        return $this->getAttribute("firstname");
    }

    public function setSecondname($value)
    {
        $this->setAttribute("secondname", $value);
    }

    public function getSecondname()
    {
        return $this->getAttribute("secondname");
    }

    public function setSurname($value)
    {
        $this->setAttribute("surname", $value);
    }

    public function getSurname()
    {
        return $this->getAttribute("surname");
    }

    public function setId($value)
    {
        $this->exists = true;
        $this->setAttribute("id", $value);
    }

    public function getId()
    {
        return $this->getAttribute("id");
    }


}
