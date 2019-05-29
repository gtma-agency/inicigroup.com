<?php

namespace App;

use Sober\Controller\Controller;

class archiveProject extends Controller
{
    use PageHeader;

    public function pageHeader()
    {
        return $this->page_header_output(get_field('projects', 'options'));
    }
}
