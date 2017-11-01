How to release a new AdminThemeBundle version
======================================

1. Create the tag and sign it. Example: `git tag -s v1.23.4` (the tag version is
   always prefixed with `v`, but remove it for the tag comment: `1.23.4`).
5. Push the tag to GitHub. Example: `git push origin v1.23.4`
6. Prepare the changelog of the new version with the custom `changelog` Git
   command. Example: `git changelog v1.23.4` (the version passed to the command
   is the previous version used as a reference to list the changes).
7. Go to https://github.com/avanzu/AdminThemeBundle/releases and click
   on `Draft a new release`. Select the tag pushed before and paste the
   changelog contents.

Resources
---------

The custom `changelog` Git command used to generate the version changelog can
be defined as a global Git alias:

    $ git config --global alias.changelog "!f() { git log $1...$2 --pretty=format:'[%h] %s' --reverse; } ; f"
