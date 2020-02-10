<?php
class NHP_Options_upload extends NHP_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0
	*/
	function __construct($field = array(), $value ='', $parent = ''){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
	}//function
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since NHP_Options 1.0
	*/
	function render(){
		
		$class = (isset($this->field['class']))?$this->field['class']:'regular-text';
                
                $image = ' button">'.__('Upload image', 'nhp-opts');
                $display = 'none'; // display state ot the "Remove image" button
      
                // old - $image_attributes = wp_get_attachment_image_src( $this->value, 'full ): // $image_attributes[0] - image URL // $image_attributes[1] - image width // $image_attributes[2] - image height
                
                if( $this->value != false ) {
                        $image = '"><img src="' . $this->value . '" style="max-width:95%;display:block;" />';
                        $display = 'inline-block';
                } 

                $desc = (isset($this->field['desc']) && !empty($this->field['desc']))?'<br/><br/><span class="description">'.$this->field['desc'].'</span>':'';

                echo '<div>
                        <a href="#" class="nhp-opts-upload' . $image . '</a>
                        <input type="hidden" name="'.$this->args['opt_name'].'['.$this->field['id'].']" id="'.$this->args['opt_name'].'['.$this->field['id'].']" value="' . $this->value . '" class="'.$class.'" />
                        <a href="#" class="nhp-opts-upload-remove" style="display:inline-block;display:' . $display . '">'.__('Remove Upload', 'nhp-opts').'</a>
                </div>'. $desc;
		
	}//function	
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since NHP_Options 1.0
	*/
	function enqueue(){
            
                if ( ! did_action( 'wp_enqueue_media' ) ) {
                        wp_enqueue_media();
                }
		
		wp_enqueue_script(
			'nhp-opts-field-upload-js', 
			//NHP_OPTIONS_URL.'fields/upload/field_upload.js', 
            CHILD_DIR.'/inc/options/options/fields/upload/field_upload.js',
			array('jquery'),
			'',
			true
		);
        
//		wp_localize_script('nhp-opts-field-upload-js', 'nhp_upload', array('url' => get_template_directory_uri().'/inc/options/options/fields/upload/blank.png'));
		
	}//function
	
}//class
?>
