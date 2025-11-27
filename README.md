# TLE-2

Dit school project is voor de opdracht gever [Natuurmonumenten](https://www.natuurmonumenten.nl/)
via [iO](https://www.iodigital.com/nl)

## Setup

1. Clone de repository.
2. Open je terminal en run `composer run setup`.
3. Zorg dat *Laravel Herd* je project ziet en secure is.
4. Run `npm run dev`.
5. Ga naar `tle-2.test`.

## Concept

De applicatie is gemaakt om een jongere doelgroep te actieveren en informeren met huidige themas die spellen rond
klimaat en natuur.

## ERD & Wireframes

[Figma](https://www.figma.com/design/yTp2zN4YumlJ1DPWo0WqoX/TLE-2?node-id=0-1&t=g3tiqPHoMxn2j74G-1)
[DrawSQL](https://drawsql.app/teams/hoogeschool-rotterdam/diagrams/natuurmonumenten/embed)

## Code Rules & Conventions

[Hoe werk je met GitHub in PhpStorm](https://www.jetbrains.com/help/phpstorm/work-with-github-pull-requests.html)

[laravel Best Practises & Conventions](https://github.com/alexeymezenin/laravel-best-practices)

### Rules

- Schrijf duidelijke commit messages.
- Maak gebruik van feature branches.
- Maak gebruik van Pull Requests.
- Als je een Model maakt doe je dat met de `php artisan make:model Model --all`
    - Hierdoor krijg je automatisch een migration, factory, seeder en controller erbij.
- Review elkaars code bij Pull Requests.
- Houd de codebase schoon en verwijder ongebruikte code.
- Documenteer belangrijke delen van de codebase.

## Code snippets & Commands

```pwsh
# Run setup
composer run setup

# Run Vite dev server
npm run dev

# Run Vite Build
npm run build
```
