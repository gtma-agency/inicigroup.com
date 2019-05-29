<?php

namespace App;

use Sober\Controller\Controller;

class archiveStaff extends Controller
{
    use PageHeader;

    public function pageHeader()
    {
        return $this->page_header_output(get_field('staff', 'options'));
    }

}
