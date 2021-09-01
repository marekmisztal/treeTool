# MINT PHP Programmer Task 1

The exercise is to write a program which is adding name property into each leaf of given tree
structure from `tree.json` file with name from `list.json` file. You should correlate
structures through `category_id` from `list.json` and `Id` in `tree.json`.

# Requirements
1. Linux/MacOS (not tested on Windows)
2. Docker-compose

# Usage
1. Run command `git clone git@github.com:marekmisztal/treeTool.git` to download exercise code
2. Enter project folder
3. In `docker` copy/move .env.dist to .env and change what you need in .env (set USER_ID to your UID)
4. Run `./start`, You should be inside `treetool_apache` container
5. Run `composer install`
6. Create tree in JSON format and save to `var/files/tree.json` (example: `tests/_data/tree.json`)
7. Create category info in JSON format and save to `var/files/list.json` (example: `tests/_data/list.json`)
8. Run command `php bin/console tree:fill`
9. The new tree with category names will be saved in `var/files/result.json`
10. Tests can be run by command `php bin/phpunit`

Good luck!