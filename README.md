# Tree Canada Wordpress Custom Plugin

## (including carbon calculator)

### options menu
1. There is a link on the admin menu called Tree Canada Settings
2. This is where you can customize a variety of calculator settings.
3. You can change the text on things like the title and description
4. you can also edit lists for transportation classes, energy types, etc.
5. for now, the lists are comma separated simple text fields. in the future we can certainly make this dynamic fields but for now keep it simple.
6. This will also be where the editable number value fields will be for the admin.


### Shortcodes
1. To display the calculator anywhere on your site, add the short code [treecanada_carbon_calculator]
2. For right now all the attributes are edited globally in the options menu.
3. In the future we can expand on this to support over-ride attributes if needed but that does not feel like a natural scope of this project.
4. We can also add more shortcodes to this plugin for other features.

### The Carbon Calculator
- the calculator is invoked with a shortcode.
- you can configure it via the options menu.
- the ui and dynamic fields are powered by bootstrap, font awesome and jquery.
- the values of the editable variables are pulled from the admin options page and stored on page load.
- all calculations will happen client side using javascript objects and methods.
- the markup is separated into a view file in src/Views/Shortcodes/ for simplified front end edits
- the styles are compiled from sass using gulp. there is also an additional css style sheet for quick and simple edits in css/ folder.
- all of the javascript files are located in js/ folder
