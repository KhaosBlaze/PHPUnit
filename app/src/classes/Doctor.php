<?php

namespace Classes;

use Classes\AbstractPerson;

class Doctor extends AbstractPerson
{
    protected function getTitle()
    {
        return 'Dr.';
    }
}