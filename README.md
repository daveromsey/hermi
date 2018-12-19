# Hermi

Hermi is a starter theme that incorporates Zurb Foundation.


# Updating Foundation

1. Update package.json so that the desired version of foundation and it's dependencies are specified. This theme is based off of the Zurb WebApp Template https://github.com/zurb/foundation-zurb-template/blob/master/package.json

2. Run "npm update" from the command line.

3. Update theme's copy of Foundation's _settings.scss:
		Copy
			hermi/node_modules/foundation-sites/scss/settings/_settings.scss
				to 
			hermi/assets/source/scss/settings/foundation/_settings.scss
			
4. Update style.scss.
		Copy functionality from foundation-everything() from
			hermi\node_modules/foundation-sites/scss/foundation.scss		
				to
			hermi\assets\source\scss\style.scss

5. Run navigate to /hermi/ and run "gulp --production" to rebuild the theme.
	
