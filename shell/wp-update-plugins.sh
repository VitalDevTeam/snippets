#! /bin/bash

# Find available updates for WordPress plugins via WP-CLI, then upgrade theme one at a time.
# After each upgrade, commit the changed files to Git.
#
# Requires that WP-CLI be installed and in your path: http://wp-cli.org/
#
# Currently, it will only work when run from the root of the WordPress installation, and has
# a hard-coded path for wp-content/plugins.
#
# Forgive the *awful* bash scripting, it could certainly use work :)

function wp-update-plugins () {
	UPDATES=`wp plugin list --update=available --fields=name,title,update_version --format=csv`
	i=1

	while IFS="," read -r slug name version
	do
		# Output from `wp plugin list` includes headers - this will skip them
		test $i -eq 1 && ((i=i+1)) && continue

		echo "Updating $name to $version..."

		wp plugin update $slug &&
		    git add -A wp-content/plugins/$slug &&
		    git commit -m "Updates $name to $version"
	done <<< "$UPDATES"

    if $(wp cli has-command wc) ; then
        echo 'Updating WooCommerce data…';
        wp wc update
    fi
}
