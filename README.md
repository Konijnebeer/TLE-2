# 🕵️ Detective Green
A web-app that encourages first-year middle school students to take real action for nature!

:mag: Check out the live version: https://team2.hr-cmgt-tle2-laravel.nl

<details>
    <summary>Table of Contents</summary>
    <ol>
        <li><a href="#information_source-about-this-project">About this project</a></li>
        <li><a href="#sparkles-functionality">Functionality</a></li>
        <li>
            <a href="#rocket-getting-started">Getting started</a>
            <ol>
                <li><a href="#requirements">Requirements</a></li>
                <li><a href="#installation">Installation</a></li>
            </ol>
        </li>
        <li>
            <a href="#hammer_and_wrench-how-does-it-work">How does it work?</a>
            <ol>
                <li><a href="#build-with">Build with</a></li>
                <li><a href="#entity-relationship-diagram">Entity Relationship Diagram</a></li>
                <li><a href="#usage">Usage</a></li>
            </ol>
        </li>
        <li><a href="#flying_saucer-deployment">Deployment</a></li>
    </ol>
</details>

[![BryanBooij](https://img.shields.io/badge/-BryanBooij-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/BryanBooij)
[![Konijnebeer](https://img.shields.io/badge/-Konijnebeer-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/Konijnebeer)
[![lisa-mao](https://img.shields.io/badge/-lisa--mao-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/lisa-mao)
[![Noirxa](https://img.shields.io/badge/-Noirxa-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/Noirxa)
[![Semmetje11lolly](https://img.shields.io/badge/-Semmetje11lolly-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/Semmetje11lolly)



## :information_source: About this project
Detective Green is the web-app to get first-year middle school students excited about nature again! By collaborating with your class on various quests, they'll truly feel like their actions are making an impact!

This project was commissioned by and created in collaboration with Natuurmonumenten and iO. Natuurmonumenten struggles to reach young people between the ages of 12 and 21. Detective Green ensures that Natuurmonumenten can raise awareness of nature by encouraging green behavior and the making an impact on nature through a curriculum for middle schools.



## :sparkles: Functionality
Detective Green is packed with cool features to easily integrate the web-app into your current curriculum!
### Quests
- Complete a variety of Quests, together with your class or at home!
- Discover unique types of Quests, from impact-making to multiple-choice questions!
- Receive rewards for completing Quests!
### Rewards
- Get points for completing Quests!
- Improve your own digital Nature Reserve by cleaning it and adding more plants and biodiversity!
### Leaderboard
- Climb the global leaderboard by collecting more points with your class!
- Become the best Green Detective!
### Management for Teachers
- Easily create new classes!
- Generate class-codes for your students to join your class!
- Manage members of your class by assigning roles like Student, Teacher or Guest!



## :rocket: Getting started
If you want to run the project locally, use the following steps.
### Requirements
- PHP 8.2+
- Composer
- Node.js & NPM
- SQLite
- (If on Windows) Laravel Herd
### Installation
1. Clone the repository
```sh
git clone https://github.com/Konijnebeer/TLE-2.git detective-green
cd detective-green
```
2. Setup dependencies, environment, database and front-end assets
```sh
composer run setup
```
3. Setup local test server
```sh
npm run dev
```
- If you're using Windows:
    - Make sure the project is in the Laravel Herd sites directory and SSL is enabled for it
    - View the web-app by going to https://detective-green.test
- If you're not on Windows:
    ```sh
    php artisan serve
    ```
    View the web-app by going to http://localhost:8000



## :hammer_and_wrench: How does it work?
Detective Green has a rich documentation of it's codebase!
### Build with
Detective Green is build using the following technologies:
- [![Laravel][Laravel.com]][Laravel-url]
    - [![Blade][Blade.com]][Blade-url]
    - [![Laravel Breeze][Breeze.com]][Breeze-url]
- [![Tailwind CSS][TailwindCSS.com]][TailwindCSS-url]
- [![JavaScript][JavaScript.com]][JavaScript-url]
- [![SQLite][SQLite.com]][SQLite-url]
### Entity Relationship Diagram
Detective Green's Database logic is as follows:
```mermaid
erDiagram
    USERS {
        BIGINT id PK
        VARCHAR name
        VARCHAR email
        VARCHAR role
        TIMESTAMP email_verified_at
        VARCHAR password
        BOOLEAN onboarding_completed
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    PASSWORD_RESET_TOKENS {
        VARCHAR email PK
        VARCHAR token
        TIMESTAMP created_at
    }

    SESSIONS {
        VARCHAR id PK
        BIGINT user_id FK
        VARCHAR ip_address
        TEXT user_agent
        LONGTEXT payload
        INT last_activity
    }

    GROUPS {
        BIGINT id PK
        VARCHAR name
        TEXT description
        VARCHAR code
        DATETIME code_expires_at
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    GROUP_USER {
        BIGINT user_id FK
        BIGINT group_id FK
        VARCHAR role
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    NATURE_PARKS {
        BIGINT id PK
        BIGINT group_id FK
        INT state
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    QUESTS {
        BIGINT id PK
        VARCHAR name
        TEXT description
        INT difficulty_level
        VARCHAR category
        BOOLEAN is_active
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    PARTS {
        BIGINT id PK
        BIGINT quest_id FK
        INT order_index
        VARCHAR name
        TEXT description
        VARCHAR media_url
        VARCHAR success_condition
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    NATURE_PARK_PART {
        BIGINT nature_park_id FK
        BIGINT part_id FK
        VARCHAR status
        TIMESTAMP completed_at
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    %% Relationships
    USERS ||--o{ GROUP_USER : "member"
    GROUPS ||--o{ GROUP_USER : "has_member"

    GROUPS ||--o{ NATURE_PARKS : "owns"
    NATURE_PARKS ||--o{ NATURE_PARK_PART : "includes"
    PARTS ||--o{ NATURE_PARK_PART : "mapped_to"

    QUESTS ||--o{ PARTS : "contains"

    USERS ||--o{ SESSIONS : "has_sessions"

    %% Logical relation (no DB FK in migrations)
    USERS ||..|| PASSWORD_RESET_TOKENS : "email -> email (logical)"
```
### Usage
Detective Green has a lot of classes, functions and other code! This chapter dives into the most important ones to understand how the codebase works!
#### Classses
- `NatureParkController` is reponsible for showing the Nature Reserve on the homepage and all logic related to completing Quests.
- `GroupController` is responsible for the connection between groups & users, managing invite codes and managing users in the group.
#### Functions
- `slideshow()` in `NatureParkController` is responsible for showing the correct 'state' of the Nature Reserve based on how many points you have collected as a group.
- `questShow()` in `NatureParkController` is responsible for showing the 'Why?' (Why are you doing this Quest, what is the impact this will have?) part of a Quest.
- `questPart()` in `NatureParkController` is responsible for showing all other parts of a Quest, like the multiple choice questions or timers.
- `codeGenerate()` in `GroupController` is responsible for generating a new code that teachers can share with their class to join the group.
- `task_timer.js` is responsible for keeping the 'Next' button disabled in a Quest where you need to do something for a certain amount of time if the time has not yet passed.
#### Nice to knows
- When a user has never completed a Quest before, it's `onboarding_completed` field in the `users` table is `false` (0). If a user completes any Quest, this field will be set to `true` (1). When `onboarding_complete` is `false`, a popup will be displayed on the homescreen to prompt users to complete their first Quest.
- When a user leaves all their groups, they won't be able to complete Quests anymore. When trying to go to the Quests-page, the user will be prompted to join a class using a class-code.
- When joining a group, you will always become a Guest of that group. A member that has (at least) the Teacher role will need to manually review each user and update their role to Student. This is to prevent the class-code being leaked and random people being able to mess with the group.

## :flying_saucer: Deployment
Detective Green has been deployed on a VPS provided by Rotterdam University of Applied Sciences that is running Ubuntu 24.04 with Nginx. [These](https://github.com/HR-CMGT/PRG05-2025-2026/blob/main/deployment-tle/README.md) instructions where used to deploy the project.



[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[TailwindCSS.com]: https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white
[TailwindCSS-url]: https://tailwindcss.com
[JavaScript.com]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black
[JavaScript-url]: https://developer.mozilla.org/en-US/docs/Web/JavaScript
[SQLite.com]: https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white
[SQLite-url]: https://www.sqlite.org
[Blade.com]: https://img.shields.io/badge/Blade-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Blade-url]: https://laravel.com/docs/blade
[Breeze.com]: https://img.shields.io/badge/Breeze-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Breeze-url]: https://laravel.com/docs/starter-kits#laravel-breeze
