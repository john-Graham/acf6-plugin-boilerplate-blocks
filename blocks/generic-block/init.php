<?php
    add_action( 'enqueue_block_editor_assets', function(){
        wp_register_script( 'block-generic-block', get_template_directory_uri() . '/script.js', array(''), null, true );
    });
    // need to add editor script.