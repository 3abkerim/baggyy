# Install dependencies
install:
    composer install
    bun install
    just migrate-cicd
    just dev

# Run Symfony server
run:
    symfony serve

# Run Symfony server on all devices
serve-all:
    symfony serve -d --allow-all-ip

# Stop Symfony server
stop:
    symfony server:stop

# Restart Symfony server
restart:
    just stop
    just serve

# Run tests
test:
    vendor/bin/phpunit

# Clear cache
cc:
    bin/console cache:clear
    composer clear-cache

# Stop dev server processes & remove generated directories when switching branch
cleanup:
	just stop
	rm -rf node_modules public/build tools/php-cs-fixer/vendor tools/rector/vendor tools/twig-cs-fixer/vendor var vendor

# -----------------
# LINTERS (Individual)
# -----------------

# PHP Code Style Fixer
fix-php-cs:
    vendor/bin/php-cs-fixer fix

# PHPStan (Static Analysis)
fix-phpstan:
    vendor/bin/phpstan analyse src/

# Rector (Code Refactoring)
fix-rector:
    vendor/bin/rector process src/

# Prettier (JS, CSS, SCSS Formatting)
fix-assets:
    bun run format:assets

# Twig Fixer
fix-twig:
    vendor/bin/twig-cs-fixer lint --fix templates

# -----------------
# GLOBAL FIX (Calls all linters)
# -----------------
fix:
    just fix-php-cs
    just fix-rector
    just fix-assets
    just fix-phpstan
    just fix-twig
    just test

# -----------------
# Database Migrations
# -----------------

migrate-cicd:
    bin/console doctrine:migrations:migrate --no-interaction

migration:
    php bin/console doctrine:migrations:diff

migrate:
    php bin/console doctrine:migrations:migrate

bdd-dump:
    bin/console doctrine:schema:validate -vvv

# -----------------
# Symfony Controllers
# -----------------

controller:
    bin/console make:controller

entity:
    bin/console make:entity

form:
    bin/console make:form

# -----------------
# Webpack
# -----------------

watch:
    bun run encore dev --watch

bunwatch:
    bun --watch run encore dev

dev:
    bun run encore dev

build:
    bun run encore production