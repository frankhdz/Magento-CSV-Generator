<?php 
	echo $this->Form->create(null, [
    'url' => ['controller' => 'Magecsv', 'action' => 'uniquecoloroptions'],
    'type' => 'file'
]);


	echo $this->Form->input('csv_file', ['type' => 'file', 'required'=> true]);
	
	echo $this->Form->input('ColorColumn', ['type' => 'text','value'=>'Default']);

	
	
	echo $this->Form->input('Submit', ['type' => 'submit','formnovalidate' => true]);

 ?>