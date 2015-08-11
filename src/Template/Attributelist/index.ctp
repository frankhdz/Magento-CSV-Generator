<?php 
	echo $this->Form->create(null, [
    'url' => ['controller' => 'Magecsv', 'action' => 'uniqueoption'],
    'type' => 'file'
]);


	echo $this->Form->input('csv_file', ['type' => 'file', 'required'=> true]);
	
	echo $this->Form->input('AttributeColumn', ['type' => 'text','value'=>'Default']);

	echo $this->Form->input('AttributeName', ['type' => 'text','value'=>'Default']);
	
	echo $this->Form->input('Submit', ['type' => 'submit','formnovalidate' => true]);

 ?>