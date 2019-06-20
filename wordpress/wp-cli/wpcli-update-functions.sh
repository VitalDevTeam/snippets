# Updates all WordPress plugins and commits them individually in Git
function wp-update-plugins() {
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
        echo 'Updating WooCommerce data...';
        wp wc update
    fi
}

# Updates WordPress core and commits the update in Git
function wp-update-core() {

    if ! [[ -z $(git status -s) ]]; then
        echo "Your Git repo is dirty. Commit or stash your current changes and run this command again."
        return 0
    fi

	echo "Checking WordPress version..."
	update=$(wp core check-update --field=version --format=count --allow-root)
	if [[ -z $update ]]; then
        CURRENT=`wp core version`
		echo "WordPress is at the latest version ($CURRENT)"
		return 0
	fi

	echo "Updating WordPress..."
    PREVIOUS=`wp core version`
    wp core update
    wp core update-db

	echo "Committing update in Git..."
    UPDATED=`wp core version`
    git add --all
    git commit -m "Updates WordPress from $PREVIOUS to $UPDATED"
}
