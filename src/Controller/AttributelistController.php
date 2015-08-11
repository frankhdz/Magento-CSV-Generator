<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Csvupload Controller
 *
 * @property \App\Model\Table\CsvuploadTable $Csvupload
 */
class AttributelistController extends AppController
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
