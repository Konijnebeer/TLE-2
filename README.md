# TLE-2

This is a schoolproject for the client [Natuurmonumenten](https://www.natuurmonumenten.nl/)
via [iO](https://www.iodigital.com/nl)

## Setup

1. Clone the repository.
2. Open your terminal and run `composer run setup`. 
3. Ensure that *Laravel Herd* sees your project and is secure.
4. Run `npm run dev`.
5. Go to `tle-2.test`.

## Concept

The app was created to engage and inform a younger audience about current themes related to climate and nature.

## ERD & Wireframes

[Figma](https://www.figma.com/design/yTp2zN4YumlJ1DPWo0WqoX/TLE-2?node-id=0-1&t=g3tiqPHoMxn2j74G-1)
[DrawSQL](https://drawsql.app/teams/hoogeschool-rotterdam/diagrams/natuurmonumenten/embed)

## Code Rules & Conventions

[How to work with GitHub in PhpStorm](https://www.jetbrains.com/help/phpstorm/work-with-github-pull-requests.html)

[laravel Best Practises & Conventions](https://github.com/alexeymezenin/laravel-best-practices)

### Rules

- Write clear commit messages.
- Use feature branches.
    - Make sure to use `feature/story-#` as naming conventions.
- Use Pull Requests.
    - You can link an **issue** with `Closes: #issue-number` in the PR description.
- When you create a Model you do this with the `php artisan make:model Model --all`
    - This will automatically give you a migration, factory, seeder and controller.
- Review each other's code on Pull Requests.
- Keep the codebase clean and remove unused code.
- Document important parts of the codebase.
- Whenever you want to change the Database Schema you **always** do this via a new migration.
- [Enums are php Enums because of this (we don't use strings during checks but the Enum).](https://medium.com/@zulfikarditya/using-php-enums-in-laravel-12-a-comprehensive-guide-af75689f88e8)

## Code snippets & Commands

```pwsh
# Run setup
composer run setup

# Run Vite dev server
npm run dev

# Run Vite Build
npm run build
```

When reviewing, you can add comments within a Pull Request
and directly suggest changes with the following snippets:

\`\`\`suggestion

Your suggestion for this code line

\```
