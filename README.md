# acf6-plugin-boilerplate-blocks
A boilerplate structure for creating a plugin using ACF6 and block.json

With ACF 6.1+ the ability to have CPT's saved as json settings is exciting, my goal here is to build some ways to add plugins to add CPTs to existing sites prior to moving the code into themes.

When building from scratch the default settings should save the .json files in teh /acf-json folder.    However when that is done I recommend you either change the acf-json.php file to explicitly save each of the json files by their key/id.    One thing to note this will leave the option to change the fields in the ACF admin menu.  If you don't want that option you can then export the .json to php code in the admin and save the configuration in the /includes/field-groups, options-pages, post-types and taxonomies folder. 


## Getting started
This project uses npm and gulp for compilation. To get started, follow these steps:

1. Install the required dependencies by running `npm install` in the project directory.
2. Once the dependencies are installed, run `gulp watch` to compile individual CSS files for each block.

After completing these steps, you will be ready to use the plugin.
### Update acf6-plugin.php
You'll need to update this file, look for acf_plugin and rename as needed. 


### Update uninstall.php
After determining your CPT name, field groups, taxonomies if you want to clear out the data from the database when uninstalled you need to update the following in the uninstall.php

1. Update the function calls for your CPT name
2. Update the function calls for your taxonomy name
3. Update the function calls for your ACF field group key

