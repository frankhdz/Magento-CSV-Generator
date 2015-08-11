<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Csvupload Controller
 *
 * @property \App\Model\Table\CsvuploadTable $Csvupload
 */
class ColorController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        
         $this->set('fileupload', "formupload");
         $this->render();
    }

    
}
