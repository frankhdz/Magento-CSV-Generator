<div class="container-fluid"><?php 
	echo $this->Form->create(null, [
    'url' => ['controller' => 'Magecsv', 'action' => 'main'],
    'type' => 'file'
]);

	echo '<div class="row-12">';
	echo '<div class="col-md-4">';
	echo '<h3>File/Attribute Set</h3>';
	echo $this->Form->input('csv_file', ['type' => 'file', 'required'=> true]);
	
	echo $this->Form->input('AttributeSet', ['type' => 'text','value'=>'ie. Color Select or Default']);

	echo $this->Form->label('appendattribute','Append a column attribute value to product name');
	echo $this->Form->input('appendattribute', array(
        'type' => 'radio',
        
        'legend' => true,
        'class' => 'radio-btn',
       
        'options' => array(
            0 => 'No',
            1 => 'Yes', 
           
        ),
      'value' => '0'
    ));

	echo $this->Form->input('appendattributecol', ['type' => 'text','value'=>'16','label'=>"Append Column (Numeric Value. Default 16)"]);

	echo $this->Form->label('disableoutput','Disable file output');
	echo $this->Form->input('disableoutput', array(
        'type' => 'radio',
        
        'legend' => true,
        'class' => 'radio-btn',
       
        'options' => array(
            0 => 'No',
            1 => 'Yes', 
           
        ),
      'value' => '0'
    ));
	
	echo '</div>';
	echo '</div>';

	

	echo '<div class="row-12">';
	echo '<div class="col-md-4">';
	echo '<h3>Color Column Options</h3>';
	echo $this->Form->label('usecolor','Use Color Column');
	echo $this->Form->input('usecolor', array(
        'type' => 'radio',
        
        'legend' => true,
        'class' => 'radio-btn',
       
        'options' => array(
            0 => 'No',
            1 => 'Yes', 
           
        ),
      'value' => '1'
    ));


    echo '<h3>Image Gallery Label Column</h3>';
	echo $this->Form->label('useswatch','Create Swatches');
	echo $this->Form->input('useswatch', array(
        'type' => 'radio',
        
        'legend' => true,
        'class' => 'radio-btn',
       
        'options' => array(
            0 => 'No',
            1 => 'Yes', 
           
        ),
      'value' => '1'
    ));
	echo $this->Form->label('imagegallerylabelcolumn','Column Id(used for swatches)');
	echo $this->Form->input('imagegallerylabelcolumn', ['type' => 'text','value'=>'9','label'=>"Label Column (Numeric Value. Default 9)"]);

	

	echo $this->Form->input('ColorColumn', ['type' => 'text','value'=>'10','label'=>'Color Column (Default is 10)']);
	echo '</div>';
	echo '</div>';

	echo '<div class="row-12">';
	echo '<div class="col-md-4">';
	echo '<h3>Super Attribute Set Options</h3>';
	echo $this->Form->label('usesuperattribute','Use Super Attribute');
	echo $this->Form->input('usesuperattribute', array(
        'type' => 'radio',
        
        'legend' => true,
        'class' => 'radio-btn',
       
        'options' => array(
            0 => 'No',
            1 => 'Yes', 
           
        ),
      'value' => '1'
    ));

	echo $this->Form->input('SuperAttributeName', ['type' => 'text','value'=>'color or size','label'=>"Super Attribute Name (Text Value)"]);

	echo $this->Form->input('SuperAttribute', ['type' => 'text','value'=>'8','label'=>'Super Attribute Column (Numeric Value. Default is 8)']);
	
	echo $this->Form->input('TargetSuperAttributeValueColumn', ['type' => 'text','value'=>'9','label'=>'Super Attribute Value Column (Numeric Value. Default is 9)']);
	echo '</div>';
	echo '</div>';

	echo '<div class="row-12">';
	echo '<div class="col-md-4">';
	echo '<h3>Add Columns</h3>';
	echo $this->Form->label('useadditionalcol','Use Additional Columns?');
	echo $this->Form->input('useadditionalcols', array(
        'type' => 'radio',
        
        'legend' => true,
        'class' => 'radio-btn',
       
        'options' => array(
            0 => 'No',
            1 => 'Yes', 
           
        ),
      'value' => '0'
    ));
	echo $this->Form->input('AdditionalColumns', ['type' => 'text','label'=>'Additional Clumn Names (Separate by commas)']);

	echo '</div>';
	echo '</div>';

	echo $this->Form->input('Submit', ['type' => 'submit','formnovalidate' => true]);

 ?>
</div>
<h3>Sample CSV use</h3>
<div class="row-12">
	<div class="col-md-12">
		Use with a single color super attribute
	</div>
	<div class="col-md-12">
		
		<a href="img/csvsample.jpg" target="blank"><img style="width: 100%; height: auto" src="img/csvsample.jpg"></a>
	</div>
</div>
<div class="row-12">
	<div class="col-md-12">
		Use with a size and color
	</div>
	<div class="col-md-12">
		
		<a href="img/csvsample2.jpg" target="blank"><img style="width: 100%; height: auto" src="img/csvsample2.jpg"></a>
	</div>
</div>
