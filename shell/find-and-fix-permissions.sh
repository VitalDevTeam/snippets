# Find all files [f] or directories [d] where the permissions are NOT your value
# and then set them to your value.
find . -type [f/d] ! -perm [octal] -print0 | xargs -0 chmod [octal]

# Example 1 Find all files that do NOT have permissions set to 644 and do so:
find . -type f ! -perm 644 -print0 | xargs -0 chmod 644

# Example 2 Find all directories that do NOT have permissions set to 755 and do so:
find . -type d ! -perm 755 -print0 | xargs -0 chmod 755

# Quick one-liner
find . -type d ! -perm 755 -print0 | xargs -0 chmod 755;find . -type f ! -perm 644 -print0 | xargs -0 chmod 644;